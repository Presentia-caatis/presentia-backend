<?php

namespace App\Http\Controllers;

use App\Models\AbsencePermitTypeSchool;
use Illuminate\Http\Request;

class AbsencePermitTypeSchoolController extends Controller
{
    public function index()
    {

        $data = AbsencePermitTypeSchool::with(['school', 'absencePermitType'])->get();
        return response()->json([
            'status' => 'success',
            'message' => 'Absence Permit Type Schools retrieved successfully',
            'data' => $data
        ]);

    }

    public function store(Request $request)
    {
        $request->validate([
            'school_id' => 'required|exists:schools,id',
            'absence_permit_type_id' => 'required|exists:absence_permit_types,id',
        ]);

        $data = AbsencePermitTypeSchool::create($request->all());
        
        return response()->json([
            'status' => 'success',
            'message' => 'Absence Permit Type School created successfully',
            'data' => $data
        ],201);

    }


    public function show(AbsencePermitTypeSchool $absencePermitTypeSchool)
    {

        $data = $absencePermitTypeSchool->load(['school', 'absencePermitType']);
        return response()->json([
            'status' => 'success',
            'message' => 'Absence Permit Type School retrieved successfully',
            'data' => $data
        ]);

    }

    public function update(Request $request, AbsencePermitTypeSchool $absencePermitTypeSchool)
    {
        
        $request->validate([
            'school_id' => 'sometimes|exists:schools,id',
            'absence_permit_type_id' => 'sometimes|exists:absence_permit_types,id',
        ]);


        $absencePermitTypeSchool->update($request->all());
        return response()->json([
            'status' => 'success',
            'message' => 'Absence Permit Type School updated successfully',
            'data' => $absencePermitTypeSchool
        ]);

    }

    public function destroy(AbsencePermitTypeSchool $absencePermitTypeSchool)
    {

        $absencePermitTypeSchool->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Absence Permit Type School deleted successfully'
        ]);

    }
}
