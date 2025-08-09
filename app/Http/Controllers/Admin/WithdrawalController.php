<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\User\Withdrawal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\WithdrawalApproved;
use App\Mail\WithdrawalRejected;
use Illuminate\Support\Facades\Mail;

class WithdrawalController extends Controller
{
    public function index(Request $request)
    {
        $withdrawals = Withdrawal::with('user')
            ->when($request->status, function ($query) use ($request) {
                return $query->where('status', $request->status);
            })
            ->latest()
            ->paginate(10000000); // Adjust pagination count as needed

        return view('admin.withdrawals.index', compact('withdrawals'));
    }

    public function approve($id)
    {
        try {
            $withdrawal = Withdrawal::findOrFail($id);

            if ($withdrawal->status != 'pending') {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Withdrawal has already been processed'
                ], 400);
            }

            // Update withdrawal status
            $withdrawal->update(['status' => 'approved']);

            // Send approval email
            $user = User::find($withdrawal->user_id);
            Mail::to($user->email)->send(new WithdrawalApproved($withdrawal));

            return response()->json([
                'status' => 'success',
                'message' => 'Withdrawal approved successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error approving withdrawal: ' . $e->getMessage()
            ], 500);
        }
    }

    public function reject($id)
    {
        try {
            $withdrawal = Withdrawal::findOrFail($id);

            if ($withdrawal->status != 'pending') {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Withdrawal has already been processed'
                ], 400);
            }

            // Update withdrawal status
            $withdrawal->update(['status' => 'rejected']);

            // Send rejection email
            $user = User::find($withdrawal->user_id);
            Mail::to($user->email)->send(new WithdrawalRejected($withdrawal));

            return response()->json([
                'status' => 'success',
                'message' => 'Withdrawal rejected and amount refunded!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error rejecting withdrawal: ' . $e->getMessage()
            ], 500);
        }
    }
}