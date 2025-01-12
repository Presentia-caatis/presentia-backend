<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\AbsencePermitType;

class AbsencePermitTypeController extends Controller
{
    public function index()
    {

        $data = AbsencePermitType::all();
        return response()->json([
            'status' => 'success',
            'message' => 'Absence permit types retrieved successfully',
            'data' => $data
        ]);

    }

    public function store(Request $request)
    {
        $request->validate([
            'permit_name' => 'required|string',
            'is_active' => 'required|boolean'
        ]);


        $data = AbsencePermitType::create($request->all());
        return response()->json([
            'status' => 'success',
            'message' => 'Absence permit type created successfully',
            'data' => $data
        ], 201);
    }

    public function show(AbsencePermitType $absencePermitType)
    {
        return response()->json([
            'status' => 'success',
            'message' => 'Absence permit type retrieved successfully',
            'data' => $absencePermitType
        ]);
    }

    public function update(Request $request, AbsencePermitType $absencePermitType)
    {
        $request->validate([
            'permit_name' => 'required|string',
            'is_active' => 'required|boolean'
        ]);

        $absencePermitType->update($request->all());
        return response()->json([
            'status' => 'success',
            'message' => 'Absence permit type updated successfully',
            'data' => $absencePermitType
        ]);

    }

    public function destroy(AbsencePermitType $absencePermitType)
    {

        $absencePermitType->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Absence permit type deleted successfully'
        ]);

    }
}
