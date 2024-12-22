<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class UserController extends Controller
{
    public function index()
    {

        $data = User::all();
        return response()->json([
            'status' => 'success',
            'message' => 'Schools retrieved successfully',
            'data' => $data->load('school')
        ]);

    }

    public function linkToSchool(Request $request, User $User)
    {
        $request->validate([
            'school_id' => 'nullable|exists:schools,id'
        ]);

        $User->school_id = $request->school_id;
        $User->save();
        return response()->json([
            'status' => 'success',
            'message' => 'Schools retrieved successfully',
            'data' => $User->load('school')
        ], 201);

    }

    public function store(Request $request)
    {
        $request->validate([
            'fullname' => 'required|string|min:3|max:100|regex:/^[a-zA-Z \'\\\\]+$/',
            'username' => 'required|string|alpha_dash|min:3|max:50|unique:users,username',
            'school_id' => 'nullable|exists:schools,id',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $data = User::create($request->all());
        return response()->json([
            'status' => 'success',
            'message' => 'User created successfully',
            'data' => $data
        ], 201);

    }

    public function show(User $User)
    {

        return response()->json([
            'status' => 'success',
            'message' => 'User retrieved successfully',
            'data' => $User->load('school')
        ]);

    }

    public function showByToken(Request $request)
    {
        $user = $request->user();

        if (!$user) {
            throw new UnauthorizedHttpException('Bearer', 'User not authenticated');
        }

        return response()->json([
            'status' => 'success',
            'message' => 'User retrieved successfully',
            'data' => $user
        ]);
    }

    public function update(Request $request, User $User)
    {
        $request->validate([
            'fullname' => 'required|string|min:3|max:100|regex:/^[a-zA-Z \'\\\\]+$/',
            'username' => 'required|string|alpha_dash|min:3|max:50|unique:users,username',
            'school_id' => 'nullable|exists:schools,id',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);
        $User->update($request->all());
        return response()->json([
            'status' => 'success',
            'message' => 'User updated successfully',
            'data' => $User
        ]);

    }

    public function destroy(User $User)
    {
        $User->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'User deleted successfully'
        ]);

    }
}
