<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\User\Deposit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DepositController extends Controller
{
    public function index()
    {
        $deposits = Deposit::with('user')->latest()->get();
        return view('admin.deposits.index', compact('deposits'));
    }

    public function approve($id)
    {
        try {
            $deposit = Deposit::findOrFail($id);

            if ($deposit->status != 'pending') {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Deposit has already been processed'
                ], 400);
            }

            $deposit->update(['status' => 'approved']);

            // Credit only the trading account
            $user = User::findOrFail($deposit->user_id);
            $user->tradingBalance()->increment('amount', $deposit->amount);

            return response()->json([
                'status' => 'success',
                'message' => 'Deposit approved and trading balance credited successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error approving deposit: ' . $e->getMessage()
            ], 500);
        }
    }


    // public function approve($id)
    // {
    //     try {
    //         $deposit = Deposit::findOrFail($id);

    //         if ($deposit->status != 'pending') {
    //             return response()->json([
    //                 'status' => 'error',
    //                 'message' => 'Deposit has already been processed'
    //             ], 400);
    //         }

    //         $deposit->update(['status' => 'approved']);

    //         // Credit user's account based on account type
    //         $user = User::findOrFail($deposit->user_id);

    //         switch ($deposit->account_type) {
    //             case 'holding':
    //                 $user->holdingBalance()->increment('amount', $deposit->amount);
    //                 break; 
    //             case 'trading':
    //                 $user->tradingBalance()->increment('amount', $deposit->amount);
    //                 break;
    //             case 'mining': // Note: Make sure this matches your actual account type spelling
    //                 $user->miningBalance()->increment('amount', $deposit->amount);
    //                 break;
    //             case 'staking':
    //                 $user->stakingBalance()->increment('amount', $deposit->amount);
    //                 break;
    //             default:
    //                 throw new \Exception("Unknown account type: {$deposit->account_type}");
    //         }

    //         return response()->json([
    //             'status' => 'success',
    //             'message' => 'Deposit approved successfully!'
    //         ]);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'status' => 'error',
    //             'message' => 'Error approving deposit: ' . $e->getMessage()
    //         ], 500);
    //     }
    // }

    public function reject($id)
    {
        try {
            $deposit = Deposit::findOrFail($id);

            if ($deposit->status != 'pending') {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Deposit has already been processed'
                ], 400);
            }

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
