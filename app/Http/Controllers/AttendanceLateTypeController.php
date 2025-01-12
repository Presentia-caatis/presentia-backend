<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\AttendanceLateType;

class AttendanceLateTypeController extends Controller
{
    public function index()
    {

        $data = AttendanceLateType::all();
        return response()->json([
            'status' => 'success',
            'message' => 'Attendance late types retrieved successfully',
            'data' => $data
        ]);

    }

    public function store(Request $request)
    {
        $request->validate([
            'type_name' => 'required|string',
            'description' => 'required|string',
            'is_active' => 'required|boolean',
            'school_id' => 'required|exists:schools,id',
        ],201);


        $data = AttendanceLateType::create($request->all());
        return response()->json([
            'status' => 'success',
            'message' => 'Attendance late type created successfully',
            'data' => $data
        ]);

    }

    public function show(AttendanceLateType $attendanceLateType)
    {

        return response()->json([
            'status' => 'success',
            'message' => 'Attendance late type retrieved successfully',
            'data' => $attendanceLateType
        ]);

    }

    public function update(Request $request, AttendanceLateType $attendanceLateType)
    {
        $request->validate([
            'type_name' => 'required|string',
            'description' => 'required|string',
            'is_active' => 'required|boolean',
            'school_id' => 'required|exists:schools,id',
        ]);

        $attendanceLateType->update($request->all());
        return response()->json([
            'status' => 'success',
            'message' => 'Attendance late type updated successfully',
            'data' => $attendanceLateType
        ]);

    }

    public function destroy(AttendanceLateType $attendanceLateType)
    {

        $attendanceLateType->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Attendance late type deleted successfully'
        ]);

    }
}
