<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\User\ContactInfo;
use App\Http\Controllers\Controller;

class ManageUserVerificationController extends Controller
{
    public function index($userId)
    {
        $user = User::findOrFail($userId);
        $verifications = ContactInfo::where('user_id', $userId)
            ->latest()
            ->get();

        return view('admin.user.bill.index', compact('verifications', 'user'));
    }

    public function show($userId, $id)
    {
        $user = User::findOrFail($userId);
        $verification = ContactInfo::where('user_id', $userId)
            ->findOrFail($id);

        return view('admin.user.bill.show', compact('verification', 'user'));
    }

    public function approve(Request $request, $userId, $id)
    {
        try {
            $verification = ContactInfo::where('user_id', $userId)
                ->where('status', 'pending')
                ->findOrFail($id);

            $verification->update([
                'verified_at' => now()
            ]);

            // Update user verification status
            $user = User::find($userId);
            $user->update(['address_verification' => true]);

            return response()->json([
                'status' => 'success',
                'message' => 'Identity verification approved successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error approving verification: ' . $e->getMessage()
            ], 500);
        }
    }

    public function reject(Request $request, $userId, $id)
    {
        try {
            $verification = ContactInfo::where('user_id', $userId)
                ->where('status', 'pending')
                ->findOrFail($id);

            $verification->update([
                'status' => 'rejected',
                'admin_id' => auth()->id(),
                'verified_at' => now()
            ]);

            // Update user verification status
            $user = User::find($userId);
            $user->update(['address_verification' => false]);

            return response()->json([
                'status' => 'success',
                'message' => 'Identity verification rejected successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error rejecting verification: ' . $e->getMessage()
            ], 500);
        }
    }


    public function destroy($userId, $id)
    {
        try {
            $verification = ContactInfo::where('user_id', $userId)
                ->findOrFail($id);

            $verification->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Identity verification deleted successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error deleting verification: ' . $e->getMessage()
            ], 500);
        }
    }
}
