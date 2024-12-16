<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Attendance;
use App\Models\Student;
use App\Models\AttendanceLateType;
use App\Models\School;
use App\Models\ClassGroup;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

class AttendanceTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        
        $user = User::factory()->create();
        $response = $this->postJson('/login', [
            'email' => $user->email,
            'password' => '123',  
        ]);

        // Simpan token ke dalam properti
        $this->token = $response->json('token');

        // Menyimpan token di header untuk semua request berikutnya
        $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->token,
        ]);

        $this->school = School::factory()->create();
        $this->classGroup = ClassGroup::factory()->create(['school_id' => $this->school->id]);
        $this->student = Student::factory()->create(['school_id' => $this->school->id]);
        $this->attendanceLateType = AttendanceLateType::factory()->create();
    }

    /** @test */
    public function it_can_retrieve_all_attendances()
    {
        // Seed some attendance data
        Attendance::factory()->count(5)->create(['student_id' => $this->student->id]);

        $response = $this->getJson('/api/attendance');

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'message',
                     'data' => [
                         '*' => ['id', 'student_id', 'attendance_late_type_id', 'check_in_time', 'check_out_time']
                     ]
                 ]);
    }

    /** @test */
    public function it_can_create_an_attendance_record()
    {
        $data = [
            'student_id' => $this->student->id,
            'attendance_late_type_id' => $this->attendanceLateType->id,
            'check_in_time' => now()->toDateTimeString(),
            'check_out_time' => now()->addHours(8)->toDateTimeString(),
        ];

        $response = $this->postJson('/api/attendance', $data);

        $response->assertStatus(201)
                 ->assertJson([
                     'status' => 'success',
                     'message' => 'Attendance created successfully',
                 ])
                 ->assertJsonStructure([
                     'status',
                     'message',
                     'data' => ['id', 'student_id', 'attendance_late_type_id', 'check_in_time', 'check_out_time']
                 ]);

        $this->assertDatabaseHas('attendances', $data);
    }

    /** @test */
    public function it_fails_to_create_attendance_with_invalid_data()
    {
        $data = [
            'student_id' => 9999,
            'attendance_late_type_id' => 9999, 
            'check_in_time' => 'invalid_date',
            'check_out_time' => 'another_invalid_date',
        ];

        $response = $this->postJson('/api/attendance', $data);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['student_id', 'attendance_late_type_id', 'check_in_time', 'check_out_time']);
    }

    /** @test */
    public function it_can_retrieve_a_single_attendance_record()
    {
        $attendance = Attendance::factory()->create([
            'student_id' => $this->student->id,
            'attendance_late_type_id' => $this->attendanceLateType->id,
        ]);

        $response = $this->getJson("/api/attendance/{$attendance->id}");

        $response->assertStatus(200)
                 ->assertJson([
                     'status' => 'success',
                     'message' => 'Attendance retrieved successfully',
                    'data' => [
                    'id' => $attendance->id,
                    'student_id' => $this->student->id,
                    'attendance_late_type_id' => $this->attendanceLateType->id,
                    'check_in_time' => $attendance->check_in_time->format('Y-m-d H:i:s'),
                    'check_out_time' => $attendance->check_out_time->format('Y-m-d H:i:s'),
                    'created_at' => $attendance->created_at->format('Y-m-d\TH:i:s.u\Z'), 
                    'updated_at' => $attendance->updated_at->format('Y-m-d\TH:i:s.u\Z'),
                    ]
                 ]);

    }

    /** @test */
    public function it_can_update_an_attendance_record()
    {
        $attendance = Attendance::factory()->create([
            'student_id' => $this->student->id,
            'attendance_late_type_id' => $this->attendanceLateType->id,
        ]);

        $updatedData = [
            'check_out_time' => now()->addHours(8)->toDateTimeString(),
        ];

        $response = $this->putJson("/api/attendance/{$attendance->id}", $updatedData);

        $response->assertStatus(200)
                 ->assertJson([
                     'status' => 'success',
                     'message' => 'Attendance updated successfully',
                     'data' => [
                     'id' => $attendance->id,
                     'student_id' => $this->student->id,
                     'attendance_late_type_id' => $this->attendanceLateType->id,
                     'check_in_time' => $attendance->check_in_time->format('Y-m-d H:i:s'),
                     'check_out_time' => \Carbon\Carbon::parse($updatedData['check_out_time'])->format('Y-m-d H:i:s'),
                     'created_at' => $attendance->created_at->format('Y-m-d\TH:i:s.u\Z'), 
                     'updated_at' => $attendance->updated_at->format('Y-m-d\TH:i:s.u\Z'),
                     ]
                 ]);

        $this->assertDatabaseHas('attendances', array_merge(['id' => $attendance->id], $updatedData));
    }

    /** @test */
    public function it_can_delete_an_attendance_record()
    {
        $attendance = Attendance::factory()->create([
            'student_id' => $this->student->id,
            'attendance_late_type_id' => $this->attendanceLateType->id,
        ]);

        $response = $this->deleteJson("/api/attendance/{$attendance->id}");

        $response->assertStatus(200)
                 ->assertJson([
                     'status' => 'success',
                     'message' => 'Attendance deleted successfully'
                 ]);

        $this->assertDatabaseMissing('attendances', ['id' => $attendance->id]);
        $this->assertDatabaseCount('attendances', 0);
    }

    /** @test */
    public function it_checks_attendance_data_is_linked_to_a_student()
    {
        $student = Student::factory()->create();
        $attendance = Attendance::factory()->create(['student_id' => $student->id]);

        $retrievedAttendance = Attendance::with('student')->find($attendance->id);

        $this->assertNotNull($retrievedAttendance->student, "Attendance should be linked to a student.");
        $this->assertEquals($student->id, $retrievedAttendance->student->id, "The attendance's student ID should match the created student ID.");
    }

}
