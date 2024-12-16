<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Student;

class StudentController extends Controller
{
    public function index()
    {

        $data = Student::with(['classGroup', 'school'])->get(); 
        return response()->json([
            'status' => 'success',
            'message' => 'Students retrieved successfully',
            'data' => $data
        ]);

    }

    public function store(Request $request)
    {
        $request->validate([
            'school_id' => 'required|exists:schools,id',
            'class_group_id' => 'nullable|exists:class_groups,id',
            'nis' => 'required|string',
            'nisn' => 'required|string',
            'student_name' => 'required|string',
            'gender' => 'required|in:male,female',
        ]);


        $data = Student::create($request->all());
        $data->load(['classGroup', 'school']);
        return response()->json([
            'status' => 'success',
            'message' => 'Student created successfully',
            'data' => $data
        ],201);

    }

    public function show(Student $student)
    {
        $student->load(['classGroup', 'school']);
        return response()->json([
            'status' => 'success',
            'message' => 'Student retrieved successfully',
            'data' => $student
        ]);

    }

    public function update(Request $request, Student $student)
    {   
        $request->validate([
            'school_id' => 'required|exists:schools,id',
            'class_group_id' => 'nullable|exists:class_groups,id',
            'nis' => 'required|string',
            'nisn' => 'required|string',
            'student_name' => 'required|string',
            'gender' => 'required|in:male,female',
        ]);

        $student->update($request->all());
        $student->load(['classGroup', 'school']);
    
        return response()->json([
            'status' => 'success',
            'message' => 'Student updated successfully',
            'data' => $student
        ]);

    }

    public function destroy(Student $student)
    {

        $student->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Student deleted successfully'
        ]);

    }
}
