<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;


class ProfileController extends Controller
{
    public function getUser(Request $request)
    {
        $user = User::where('username', $request->username)->first();

        if ($user) {
            return response()->json($user);
        }

        return response()->json([
            'status' => 'false',
            'message' => 'User not found',
        ], 500);
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'fullName' => "required|max:30",
            'username' => 'required|min:5|max:25|regex:/^[A-Za-z0-9]+(?:[ _-][A-Za-z0-9]+)*$/|unique:users,username,' . Auth::user()->id,
            'email' => 'required|email|unique:users,email,' . Auth::user()->id,
            'bio' => 'nullable|max:255',
        ]);

        $user = User::whereId(Auth::user()->id)->first()->update([
            'fullName' => $request->fullName,
            'username' => $request->username,
            'email' => $request->email,
            'bio' => $request->bio,
        ]) ?? abort(404, 'User Not found');

        if ($user) {
            return response()->json([
                'status' => 'ok',
                'message' => 'Profile successuflly updated',
            ], 200);
        }
        return response()->json([
            'status' => 'false',
            'message' => "Profile didn't updated",
        ], 500);
    }

    public function updateProfilePhoto(Request $request)
    {
        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'required|file|mimes:jpg,png,jpeg,bmp|max:1024',
            ]);

            $key = '';
            $keys = array_merge(range('a', 'z'), range('A', 'Z'), range('0', '9'));
            for ($i = 0; $i <= 25; $i++) {
                $key .= $keys[array_rand($keys)];
            }
            $imageName = 'http://localhost:8000/uploads/' . $key . $request->image->getClientOriginalName();
            $request->image->move(public_path('uploads'), $imageName);
            $user = User::whereId(Auth::user()->id)->first()->update([
                'profilePhoto' => $imageName,
            ]) ?? abort(404,'User not found');

            if($user){
                return response()->json([
                    'status'=>'ok',
                    'url'=>$imageName,
                ],200);
            }
        }
        User::whereId(Auth::user()->id)->first()->update([
            'profilePhoto'=>'https://i.pinimg.com/736x/8b/16/7a/8b167af653c2399dd93b952a48740620.jpg',
        ]);
        return response()->json([
            'status'=>'ok',
            'url'=>Auth::user()->profilePhoto,
        ],200);

    }
}
