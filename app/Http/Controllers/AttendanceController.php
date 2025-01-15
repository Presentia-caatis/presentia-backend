<?php

namespace App\Http\Controllers;

use App\Models\AttendanceLateType;
use App\Models\AttendanceWindow;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Models\Attendance;

class AttendanceController extends Controller
{
    public function index()
    {

        $data = Attendance::with('student', 'attendanceLateType')->orderBy('check_in_time')->get();
        return response()->json([
            'status' => 'success',
            'message' => 'Attendances retrieved successfully',
            'data' => $data
        ]);

    }


    public function store(Request $request)
    {
        $request->validate([
            'data' => 'required|array',
            'data.*.id' => 'required|string',
            'data.*.date' => 'required|date',
        ]);

        $firstDate = $request->input('data.0.date');
        $formattedFirstDate = Carbon::parse($firstDate)->format('Y-m-d');

        $attendanceWindow = AttendanceWindow::whereDate('date', $formattedFirstDate)
            ->first();


        $attendanceLateTypes = AttendanceLateType::where('school_id', $request->user()->school->id)->get();

        $checkInStart = Carbon::parse($attendanceWindow->check_in_start_time);
        $checkInEnd = Carbon::parse($attendanceWindow->check_in_end_time);
        $checkOutStart = Carbon::parse($attendanceWindow->check_out_start_time);
        $checkOutEnd = Carbon::parse($attendanceWindow->check_out_end_time);

        

        foreach ($request->input('data') as $student) {
            $studentId = $student['id'];
            $studentDate = Carbon::parse($student['date']);

            foreach ($attendanceLateTypes as $atc) {

                // \Log::info("Student ID: $studentId, Student Date: $studentDate");
                // \Log::info("Check-in Start: $checkInStart, Check-in End: " . $checkInEnd->addMinutes($atc->late_duration));
                // \Log::info("Check-out Start: $checkOutStart, Check-out End: " . $checkOutEnd->addMinutes($atc->late_duration));
                
                if ($studentDate->between($checkInStart, $checkInEnd->addMinutes($atc->late_duration))) {
                    Attendance::updateOrCreate([
                        'id' => $studentDate . '-' . $studentId,
                        'student_id' => $studentId,
                        'attendance_late_type_id' => $atc->id,
                        'attendance_window_id' => $attendanceWindow->id,
                        'check_in_time' => $studentDate
                    ]);
                    break;
                } else if ($studentDate->between($checkOutStart, $checkOutEnd->addMinutes($atc->late_duration))) {
                    Attendance::updateOrCreate([
                        'id' => $studentDate . '-' . $studentId,
                        'student_id' => $studentId,
                        'attendance_late_type_id' => $atc->id,
                        'attendance_window_id' => $attendanceWindow->id,
                        'check_out_time' => $studentDate
                    ]);
                    break;
                }
            }


        }

        return response()->json([
            'status' => 'success',
            'message' => 'Attendance created successfully',
        ], 201);

    }

    public function show(Attendance $attendance)
    {

        return response()->json([
            'status' => 'success',
            'message' => 'Attendance retrieved successfully',
            'data' => $attendance
        ]);

    }

    public function update(Request $request, Attendance $attendance)
    {

        $attendance->update($request->all());
        return response()->json([
            'status' => 'success',
            'message' => 'Attendance updated successfully',
            'data' => $attendance
        ]);

    }

    public function destroy(Attendance $attendance)
    {

        $attendance->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Attendance deleted successfully'
        ]);

    }
}

