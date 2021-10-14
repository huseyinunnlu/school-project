<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    public function get(Request $request)
    {
        if ($request->type) {
            $data = User::where('fullName', 'LIKE', '%' . $request->search . '%')->where('type', $request->type)->orderBy('created_at', $request->sort)->paginate($request->count);
        } else {
            $data = User::where('fullName', 'LIKE', $request->search)->orderBy('created_at', $request->sort)->paginate($request->count);
        }
        return response()->json($data);
    }

    public function store(Request $request)
    {
        if (Auth::user()->type == 1) {
            $request->validate([
                'fullName' => "required|max:30",
                'username' => 'required|min:5|max:25|unique:users,username',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|confirmed',
                'bio' => 'nullable|max:255',
                'accType' => 'required',
            ]);

            $user = User::create([
                'fullName' => $request->fullName,
                'username' => $request->username,
                'password' => $request->password,
                'email' => $request->email,
                'bio' => $request->bio,
                'type' => $request->accType,
                'profilePhoto' => 'https://i.pinimg.com/736x/8b/16/7a/8b167af653c2399dd93b952a48740620.jpg',
            ]);

            if ($user) {
                return response()->json([
                    'status' => 'ok',
                    'message' => 'User successfuly added',
                    'user' => $user,
                ], 200);
            }
            return response()->json([
                'status' => 'false',
                'message' => "User didn't added",
            ], 500);
        }
        return response()->json([
            'status' => 'false',
            'message' => "You're not admin.",
        ], 500);
    }

    public function delete($id)
    {
        if (Auth::user()->type == 1) {
            $user = User::whereId($id)->delete() ?? abort(404, 'User not found');
            if ($user) {
                return response()->json([
                    'status' => 'ok',
                    'message' => 'User successfuly deleted',
                ], 200);
            }
            return response()->json([
                'status' => 'false',
                'message' => "User didn't deleted",
            ], 500);
        }

        return response()->json([
            'status' => 'false',
            'message' => "You're not admin.",
        ], 500);
    }

    public function getUser($id)
    {
        if (Auth::user()->type == 1) {
            $data = User::whereId($id)->first();
            if ($data) {
                return response()->json([
                    'status' => 'ok',
                    'data' => $data,
                ], 200);
            }
            return response()->json([
                'status' => 'false',
                'message' => "User not found",
            ], 500);
        }
        return response()->json([
            'status' => 'false',
            'message' => "You're not admin.",
        ], 500);
    }

    public function update(Request $request)
    {
        if (Auth::user()->type == 1) {
            if ($request->password) {
                $request->validate([
                    'id' => 'required',
                    'fullName' => "required|max:30",
                    'username' => 'required|min:5|max:25|unique:users,username,' . Auth::user()->id,
                    'email' => 'required|email|unique:users,email,' . Auth::user()->id,
                    'password' => 'required',
                    'bio' => 'nullable|max:255',
                    'type' => 'required',
                ]);
                $user = User::whereId($request->id)->first()->update([
                    'fullName' => $request->fullName,
                    'username' => $request->username,
                    'password' => $request->password,
                    'email' => $request->email,
                    'bio' => $request->bio,
                    'type' => $request->type,
                ]);
            } else {
                $request->validate([
                    'id' => 'required',
                    'fullName' => "required|max:30",
                    'username' => 'required|min:5|max:25|unique:users,username,' . Auth::user()->id,
                    'email' => 'required|email|unique:users,email,' . Auth::user()->id,
                    'bio' => 'nullable|max:255',
                    'type' => 'required',
                ]);

                $user = User::whereId($request->id)->first()->update([
                    'fullName' => $request->fullName,
                    'username' => $request->username,
                    'email' => $request->email,
                    'bio' => $request->bio,
                    'type' => $request->type,
                ]);
            }
            if ($user) {
                return response()->json([
                    'status' => 'ok',
                    'message' => 'User successfully updated',
                ], 200);
            }
            return response()->json([
                'status' => 'false',
                'message' => "User didn't updated",
            ], 500);
        }
        return response()->json([
            'status' => 'false',
            'message' => "You're not admin.",
        ], 500);
    }
}
