<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Attendance;

class AttendanceController extends Controller
{
    public function index()
    {

        $data = Attendance::with('student', 'attendanceLateType')->get();
        return response()->json([
            'status' => 'success',
            'message' => 'Attendances retrieved successfully',
            'data' => $data
        ]);

    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'attendance_late_type_id' => 'required|exists:attendance_late_types,id',
            'check_in_time' => 'required|date',
            'check_out_time' => 'nullable|date',
        ]);


        $data = Attendance::create($request->all());
        return response()->json([
            'status' => 'success',
            'message' => 'Attendance created successfully',
            'data' => $data
        ],201);

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

