<?php

namespace App\Http\Controllers;

use App\Models\AttendanceLateTypeSchool;
use Illuminate\Http\Request;

class AttendanceLateTypeSchoolController extends Controller
{

    public function index()
    {

        $data = AttendanceLateTypeSchool::with(['school', 'attendanceLateType'])->get();
        return response()->json([
            'status' => 'success',
            'message' => 'Attendance Late Type Schools retrieved successfully',
            'data' => $data
        ]);

    }


    public function store(Request $request)
    {
        $request->validate([
            'school_id' => 'required|exists:schools,id',
            'attendance_late_type_id' => 'required|exists:attendance_late_types,id',
        ]);


        $data = AttendanceLateTypeSchool::create($request->all());
        $data->load(['school', 'attendanceLateType']);
        return response()->json([
            'status' => 'success',
            'message' => 'Attendance Late Type School created successfully',
            'data' => $data
        ],201);

    }

    public function show(AttendanceLateTypeSchool $attendanceLateTypeSchool)
    {
        $attendanceLateTypeSchool->load(['school', 'attendanceLateType']);
        return response()->json([
            'status' => 'success',
            'message' => 'Attendance Late Type School retrieved successfully',
            'data' => $attendanceLateTypeSchool
        ]);
    }

    public function update(Request $request, AttendanceLateTypeSchool $attendanceLateTypeSchool)
    {
        $request->validate([
            'school_id' => 'sometimes|exists:schools,id',
            'attendance_late_type_id' => 'sometimes|exists:attendance_late_types,id',
        ]);


        $attendanceLateTypeSchool->update($request->all());
        $attendanceLateTypeSchool->load(['school', 'attendanceLateType']);
        return response()->json([
            'status' => 'success',
            'message' => 'Attendance Late Type School updated successfully',
            'data' => $attendanceLateTypeSchool
        ]);

    }


    public function destroy(AttendanceLateTypeSchool $attendanceLateTypeSchool)
    {

        $attendanceLateTypeSchool->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Attendance Late Type School deleted successfully'
        ]);

    }
}
