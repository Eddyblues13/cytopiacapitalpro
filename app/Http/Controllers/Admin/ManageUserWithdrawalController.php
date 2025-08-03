<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\User\Withdrawal;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ManageUserWithdrawalController extends Controller
{
    public function index($userId)
    {
        $user = User::findOrFail($userId);
        $withdrawals = Withdrawal::where('user_id', $userId)
            ->latest()
            ->get();

        return view('admin.user.withdrawal.index', compact('withdrawals', 'user'));
    }

    public function create($userId)
    {
        $user = User::findOrFail($userId);
        return view('admin.user.withdrawal.create', compact('user'));
    }

    public function store(Request $request, $userId)
    {
        $validator = Validator::make($request->all(), [
            'amount' => 'required|numeric|min:0.00000001',
            'account_type' => 'required|in:bank,crypto',
            'crypto_currency' => 'required_if:account_type,crypto',
            'wallet_address' => 'required_if:account_type,crypto|nullable',
            'status' => 'required|in:pending,approved,rejected'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            Withdrawal::create([
                'user_id' => $userId,
                'amount' => $request->amount,
                'account_type' => $request->account_type,
                'crypto_currency' => $request->crypto_currency,
                'wallet_address' => $request->wallet_address,
                'status' => $request->status
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Withdrawal created successfully!',
                'redirect' => route('admin.users.withdrawals.index', $userId)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error creating withdrawal: ' . $e->getMessage()
            ], 500);
        }
    }

    public function edit($userId, $id)
    {
        $user = User::findOrFail($userId);
        $withdrawal = Withdrawal::where('user_id', $userId)->findOrFail($id);

        return view('admin.user.withdrawal.edit', compact('user', 'withdrawal'));
    }

    public function update(Request $request, $userId, $id)
    {
        $withdrawal = Withdrawal::where('user_id', $userId)->findOrFail($id);

        $validator = Validator::make($request->all(), [
            'amount' => 'required|numeric|min:0.00000001',
            'account_type' => 'required|in:bank,crypto',
            'crypto_currency' => 'required_if:account_type,crypto',
            'wallet_address' => 'required_if:account_type,crypto|nullable',
            'status' => 'required|in:pending,approved,rejected'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $withdrawal->update($request->all());

            return response()->json([
                'status' => 'success',
                'message' => 'Withdrawal updated successfully!',
                'redirect' => route('admin.users.withdrawals.index', $userId)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error updating withdrawal: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy($userId, $id)
    {
        try {
            $withdrawal = Withdrawal::where('user_id', $userId)->findOrFail($id);
            $withdrawal->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Withdrawal deleted successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error deleting withdrawal: ' . $e->getMessage()
            ], 500);
        }
    }

    public function approve($userId, $id)
    {
        try {
            $withdrawal = Withdrawal::where('user_id', $userId)
                ->where('status', 'pending')
                ->findOrFail($id);

            $withdrawal->update(['status' => 'approved']);

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

    public function reject($userId, $id)
    {
        try {
            $withdrawal = Withdrawal::where('user_id', $userId)
                ->where('status', 'pending')
                ->findOrFail($id);

            // Refund the amount if it's a crypto withdrawal
            if ($withdrawal->account_type === 'crypto') {
                $user = User::find($userId);
                $user->crypto_balance += $withdrawal->amount;
                $user->save();
            }

            $withdrawal->update(['status' => 'rejected']);

            return response()->json([
                'status' => 'success',
                'message' => 'Withdrawal rejected successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error rejecting withdrawal: ' . $e->getMessage()
            ], 500);
        }
    }
}
