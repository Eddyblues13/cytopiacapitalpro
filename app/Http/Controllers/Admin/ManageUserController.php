<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ManageUserController extends Controller
{
    public function index()
    {
        $users = User::with('referrer')->latest()->get();
        return view('admin.user.index', compact('users'));
    }

    public function create()
    {
        $referrers = User::whereNotNull('referral_code')->get();
        return view('admin.user.create', compact('referrers'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone_number' => 'nullable|string|max:20',
            'country' => 'required|string|max:255',
            'city' => 'nullable|string|max:255',
            'currency' => 'nullable|string|max:3',
            'password' => 'required|string|min:8|confirmed',
            'referred_by' => 'nullable|exists:users,id',
            'user_status' => 'required|in:active,inactive,banned',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $data = $request->except('profile_photo', 'password');
            $data['password'] = Hash::make($request->password);
            $data['referral_code'] = $this->generateReferralCode();

            if ($request->hasFile('profile_photo')) {
                $data['profile_photo'] = $request->file('profile_photo')->store('profile-photos', 'public');
            }

            User::create($data);

            return response()->json([
                'status' => 'success',
                'message' => 'User created successfully!',
                'redirect' => route('admin.users.index')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error creating user: ' . $e->getMessage()
            ], 500);
        }
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $referrers = User::whereNotNull('referral_code')->where('id', '!=', $id)->get();
        return view('admin.user.edit', compact('user', 'referrers'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
            'phone_number' => 'nullable|string|max:20',
            'country' => 'required|string|max:255',
            'city' => 'nullable|string|max:255',
            'currency' => 'nullable|string|max:3',
            'referred_by' => 'nullable|exists:users,id',
            'user_status' => 'required|in:active,inactive,banned',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'email_verification' => 'boolean',
            'id_verification' => 'boolean',
            'address_verification' => 'boolean',
            'signal_strength' => 'required|integer|between:1,100',

        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $data = $request->except('profile_photo', 'password');

            if ($request->filled('password')) {
                $data['password'] = Hash::make($request->password);
            }

            if ($request->hasFile('profile_photo')) {
                // Delete old profile photo if exists
                if ($user->profile_photo) {
                    Storage::disk('public')->delete($user->profile_photo);
                }
                $data['profile_photo'] = $request->file('profile_photo')->store('profile-photos', 'public');
            }

            $user->update($data);

            return response()->json([
                'status' => 'success',
                'message' => 'User updated successfully!',
                'redirect' => route('admin.users.edit', ['user' => $user->id])
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error updating user: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'User deleted successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error deleting user: ' . $e->getMessage()
            ], 500);
        }
    }

    private function generateReferralCode()
    {
        $code = strtoupper(substr(md5(uniqid()), 0, 8));

        // Ensure code is unique
        while (User::where('referral_code', $code)->exists()) {
            $code = strtoupper(substr(md5(uniqid()), 0, 8));
        }

        return $code;
    }


    public function updateStatus(Request $request)
    {
        $user = User::findOrFail($request->user_id);
        $field = $request->field;
        $value = $request->value;

        // Validate the field exists and is boolean
        if (!in_array($field, [
            'top_up_mail',
            'notification_status',
            'network_status',
            'upgrade_status',
            'confirmed_registration_fee',
            'top_up_status',
            'subscription_status'
        ])) {
            return response()->json(['success' => false, 'message' => 'Invalid field']);
        }

        $user->$field = $value;
        $user->save();

        return response()->json(['success' => true]);
    }
}
