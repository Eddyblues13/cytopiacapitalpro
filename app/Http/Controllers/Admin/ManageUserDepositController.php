<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\User\Deposit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ManageUserDepositController extends Controller
{
    public function index($userId)
    {
        $user = User::findOrFail($userId);
        $deposits = Deposit::where('user_id', $userId)
            ->latest()
            ->get();

        return view('admin.user.deposit.index', compact('deposits', 'user'));
    }

    public function create($userId)
    {
        $user = User::findOrFail($userId);
        return view('admin.user.deposit.create', compact('user'));
    }

    public function store(Request $request, $userId)
    {
        $validator = Validator::make($request->all(), [
            'amount' => 'required|numeric|min:0.01',
            'account_type' => 'required|in:main,investment,bonus',
            'status' => 'required|in:pending,approved,rejected'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            Deposit::create([
                'user_id' => $userId,
                'amount' => $request->amount,
                'account_type' => $request->account_type,
                'status' => $request->status
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Deposit created successfully!',
                'redirect' => route('admin.users.deposits.index', $userId)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error creating deposit: ' . $e->getMessage()
            ], 500);
        }
    }

    public function edit($userId, $id)
    {
        $user = User::findOrFail($userId);
        $deposit = Deposit::where('user_id', $userId)->findOrFail($id);

        return view('admin.user.deposit.edit', compact('user', 'deposit'));
    }



    public function update(Request $request, $userId, $id)
    {
        $validator = Validator::make($request->all(), [
            'amount' => 'required|numeric|min:0.01',
            'account_type' => 'required|in:holding,trading,mining,staking',
            'status' => 'required|in:pending,approved,rejected'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $deposit = Deposit::where('user_id', $userId)->findOrFail($id);
            $originalStatus = $deposit->status;
            $deposit->update($request->all());

            // Only increment balance if status changed to approved
            // if ($request->status === 'approved' && $originalStatus !== 'approved')
            if ($request->status === 'approved') {
                $user = User::findOrFail($userId);
                $accountType = $request->account_type;
                $amount = $request->amount;

                switch ($accountType) {
                    case 'holding':
                        $user->holdingBalance()->increment('amount', $amount);
                        break;
                    case 'trading':
                        $user->tradingBalance()->increment('amount', $amount);
                        break;
                    case 'mining':
                        // Assuming mining uses the same balance as staking or needs separate handling
                        $user->stakingBalance()->increment('amount', $amount);
                        break;
                    case 'staking':
                        $user->stakingBalance()->increment('amount', $amount);
                        break;
                }
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Deposit updated successfully!',
                'redirect' => route('admin.users.deposits.index', $userId)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error updating deposit: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy($userId, $id)
    {
        try {
            $deposit = Deposit::where('user_id', $userId)->findOrFail($id);
            $deposit->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Deposit deleted successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error deleting deposit: ' . $e->getMessage()
            ], 500);
        }
    }

    public function approve($userId, $id)
    {
        try {
            $deposit = Deposit::where('user_id', $userId)
                ->where('status', 'pending')
                ->findOrFail($id);

            $deposit->update(['status' => 'approved']);

            // Credit user's account based on account type
            $user = User::find($userId);
            if ($deposit->account_type == 'main') {
                $user->balance += $deposit->amount;
            } elseif ($deposit->account_type == 'investment') {
                $user->investment_balance += $deposit->amount;
            }
            $user->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Deposit approved successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error approving deposit: ' . $e->getMessage()
            ], 500);
        }
    }

    public function reject($userId, $id)
    {
        try {
            $deposit = Deposit::where('user_id', $userId)
                ->where('status', 'pending')
                ->findOrFail($id);

            $deposit->update(['status' => 'rejected']);

            return response()->json([
                'status' => 'success',
                'message' => 'Deposit rejected successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error rejecting deposit: ' . $e->getMessage()
            ], 500);
        }
    }
}
