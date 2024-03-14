<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\ProfilePasswordUpdateRequest;
use App\Http\Requests\Frontend\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function updateProfile(ProfileUpdateRequest $request): RedirectResponse
    {
        // dd($request->all());
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return back()->with([
            'status' => 'profile-updated',
            'message' => "Profile updated successfully",
            'alert-type' => 'success'
        ]);
    }

    public function updatePassword(ProfilePasswordUpdateRequest $request): RedirectResponse
    {
        // $validated = $request->validateWithBag('updatePassword', [
        //     'current_password' => ['required', 'current_password'],
        //     'password' => ['required', Password::defaults(), 'confirmed'],
        // ]);

        $request->user()->update([
            'password' => Hash::make($request->validated()['password']),// => $validated['password']),
        ]);

        return back()->with([
            'status' => 'password-updated',
            'message' => "Profile password updated successfully",
            'alert-type' => 'success'
        ]);
    }
}
