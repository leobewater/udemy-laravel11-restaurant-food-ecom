<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProfilePasswordUpdateRequest;
use App\Http\Requests\Admin\ProfileUpdateRequest;
use App\Traits\FileUploadTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    use FileUploadTrait;

    public function index(): View
    {
        return view('admin.profile.index', []);
    }

    public function updateProfile(ProfileUpdateRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();
        if ($request['avatar']) {
            $validatedData['avatar'] = $this->uploadImage($request, 'avatar');
        }

        $request->user()->fill($validatedData);

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
