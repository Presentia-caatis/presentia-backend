<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\CheckInStatus;

class CheckInStatusController extends Controller
{
    public function index()
    {

        $data = CheckInStatus::all();
        return response()->json([
            'status' => 'success',
            'message' => 'Attendance late types retrieved successfully',
            'data' => $data
        ]);

    }

    /* 
        1. if its on time (check_in_start_time <= check_in_time <= check_in_end_time) and (check_out_start_time <= check_out_time <= check_out_end_time)
        2. if its late (check_in_time > check_in_end_time) and (check_out_time > check_out_end_time)
        2.1 if its late by the rules that has been set to the user
        2.2 if its late by the rules that has been set to the sysytem
        2.2.1 0 minutes late
        2.2.2 check_out_start_time -  check_in_end_time late (all student will be considered as absence)
        3. Edit or Delete existing CheckInStatus
        3.1 if its already assign to student (for check_in_time > 0)
        3.1.1 if the user will update all assign student -> read all connected attandance with the attendaceWindows -> recheck the attendance status
        3.1.1.1 if the new late duration < the old late duration || delete the late duration -> update the user that in recent category
        3.1.1.2 if the new late duration > the old late duration -> update the user that in above category
        3.1.2 else make new CheckInStatus with false status and create a new one.
        3.2 if its not assign to student -> directly edit or delete the CheckInStatus
    */
    public function store(Request $request)
    {
        $request->validate([
            'type_name' => 'required|string',
            'description' => 'required|string',
            'is_active' => 'required|boolean',
            'school_id' => 'required|exists:schools,id',
        ],201);


        $data = CheckInStatus::create($request->all());
        return response()->json([
            'status' => 'success',
            'message' => 'Attendance late type created successfully',
            'data' => $data
        ]);

    }

    public function show(CheckInStatus $CheckInStatus)
    {

        return response()->json([
            'status' => 'success',
            'message' => 'Attendance late type retrieved successfully',
            'data' => $CheckInStatus
        ]);

    }

    public function update(Request $request, CheckInStatus $CheckInStatus)
    {
        $request->validate([
            'type_name' => 'required|string',
            'description' => 'required|string',
            'is_active' => 'required|boolean',
            'school_id' => 'required|exists:schools,id',
        ]);

        $CheckInStatus->update($request->all());
        return response()->json([
            'status' => 'success',
            'message' => 'Attendance late type updated successfully',
            'data' => $CheckInStatus
        ]);

    }

    public function destroy(CheckInStatus $CheckInStatus)
    {

        $CheckInStatus->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Attendance late type deleted successfully'
        ]);
    }
}
