<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Setting;

class SettingsController extends Controller
{
    public function getSettings()
    {
        $data = Setting::first();
        return response()->json([
            'status' => 'ok',
            'data' => $data,
        ]);
    }

    public function update(Request $request)
    {
        $exist = Setting::first();

        $request->validate([
            'title' => 'required|max:100',
            'aboutUs' => 'nullable|max:3000|min:50',
            'contactUs' => 'nullable|max:3000|min:50',
            'privacyPolicy' => 'nullable|max:3000|min:50',
            'copyrightText' => 'nullable|max:300|min:10',
        ]);

        if (!$exist) {
            $data = Setting::create([
                'title' => $request->title,
                'aboutUs' => $request->aboutUs,
                'contactUs' => $request->contactUs,
                'privacyPolicy' => $request->privacyPolicy,
                'copyrightText' => $request->copyrightText,
            ]);
        } else {
            $data = Setting::first()->update([
                'title' => $request->title,
                'aboutUs' => $request->aboutUs,
                'contactUs' => $request->contactUs,
                'privacyPolicy' => $request->privacyPolicy,
                'copyrightText' => $request->copyrightText,
            ]);
        }

        if ($request->hasFile('logo')) {
            $request->validate([
                'logo' => 'required|file|mimes:jpg,png,jpeg,bmp|max:2048',
            ]);
            $key = '';
            $keys = array_merge(range('a', 'z'), range('A', 'Z'), range('0', '9'));
            for ($i = 0; $i <= 25; $i++) {
                $key .= $keys[array_rand($keys)];
            }
            $imageName = 'http://localhost:8000/uploads/settings/' . $key . $request->logo->getClientOriginalName();
            $request->logo->move(public_path('uploads/settings'), $imageName);
            Setting::first()->update([
                'logo'=>$imageName,
            ]);
        }

        if ($request->hasFile('faviconImage')) {
            $request->validate([
                'faviconImage' => 'required|file|mimes:jpg,png,jpeg,bmp|max:1024',
            ]);

            $key = '';
            $keys = array_merge(range('a', 'z'), range('A', 'Z'), range('0', '9'));
            for ($i = 0; $i <= 25; $i++) {
                $key .= $keys[array_rand($keys)];
            }
            $imageName = 'http://localhost:8000/uploads/settings/' . $key . $request->faviconImage->getClientOriginalName();
            $request->faviconImage->move(public_path('uploads/settings'), $imageName);

            Setting::first()->update([
                'faviconImage'=>$imageName,
            ]);
        }

        if ($data) {
            return response()->json([
                'status' => 'ok',
                'message' => 'Settings updated successfully',
            ], 200);
        }
        return response()->json([
            'status' => 'false',
            'message' => "Settings did't updated",
        ], 500);
    }
}
