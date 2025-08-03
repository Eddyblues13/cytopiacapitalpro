<?php

namespace App\Http\Controllers\User;

use App\Models\User\Profit;
use App\Models\User\Deposit;
use Illuminate\Http\Request;
use App\Models\User\Withdrawal;
use Illuminate\Support\Facades\DB;
use App\Models\User\HoldingBalance;
use App\Models\User\StakingBalance;
use App\Models\User\TradingBalance;
use App\Http\Controllers\Controller;
use App\Models\User\ReferralBalance;
use Illuminate\Support\Facades\Auth;

class WithdrawalController extends Controller
{
    public function index()
    {

        $user = Auth::user();
        // Fetch withdrawals for the authenticated user
        $data['withdrawals'] = Withdrawal::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();

        $data['holdingBalance'] = HoldingBalance::where('user_id', $user->id)->sum('amount') ?? 0;
        $data['stakingBalance'] = StakingBalance::where('user_id', $user->id)->sum('amount') ?? 0;
        $data['tradingBalance'] = TradingBalance::where('user_id', $user->id)->sum('amount') ?? 0;
        $data['referralBalance'] = ReferralBalance::where('user_id', $user->id)->sum('amount') ?? 0;
        $data['depositBalance'] = Deposit::where('user_id', $user->id)
            ->where('status', 'approved') // Only include approved deposits
            ->sum('amount') ?? 0;
        $data['profit'] = Profit::where('user_id', $user->id)->sum('amount') ?? 0;

        $data['totalBalance'] =    $data['holdingBalance'] +  $data['stakingBalance'] +   $data['tradingBalance']  +  $data['referralBalance'] +  $data['depositBalance'] +  $data['profit'];

        return view('user.withdrawal', $data);
    }

    public function cryptoWithdrawal()
    {

        $user = Auth::user();

        $data['holdingBalance'] = HoldingBalance::where('user_id', $user->id)->sum('amount') ?? 0;
        $data['stakingBalance'] = StakingBalance::where('user_id', $user->id)->sum('amount') ?? 0;
        $data['tradingBalance'] = TradingBalance::where('user_id', $user->id)->sum('amount') ?? 0;
        $data['referralBalance'] = ReferralBalance::where('user_id', $user->id)->sum('amount') ?? 0;
        $data['depositBalance'] = Deposit::where('user_id', $user->id)
            ->where('status', 'approved') // Only include approved deposits
            ->sum('amount') ?? 0;
        $data['profit'] = Profit::where('user_id', $user->id)->sum('amount') ?? 0;

        $data['totalBalance'] =    $data['holdingBalance'] +  $data['stakingBalance'] +   $data['tradingBalance']  +  $data['referralBalance'] +  $data['depositBalance'] +  $data['profit'];


        return view('user.crypto_withdrawal', $data);
    }

    public function submit(Request $request)
    {
        // Validate the request
        $request->validate([
            'account' => 'required|string|in:trading,holding,staking,profit,deposit',
            'crypto_currency' => 'required|string|in:btc,usdt,eth',
            'amount' => 'required|numeric|min:0.01',
            'wallet_address' => 'required|string',
        ]);

        $user = Auth::user();
        $amount = $request->input('amount');
        $accountType = $request->input('account');
        $cryptoCurrency = $request->input('crypto_currency');
        $walletAddress = $request->input('wallet_address');

        // Fetch user balances
        $holdingBalance = HoldingBalance::where('user_id', $user->id)->sum('amount') ?? 0;
        $stakingBalance = StakingBalance::where('user_id', $user->id)->sum('amount') ?? 0;
        $tradingBalance = TradingBalance::where('user_id', $user->id)->sum('amount') ?? 0;
        $referralBalance = ReferralBalance::where('user_id', $user->id)->sum('amount') ?? 0;

        $data['depositBalance'] = Deposit::where('user_id', $user->id)
            ->where('status', 'approved') // Only include approved deposits
            ->sum('amount') ?? 0;
        $data['profit'] = Profit::where('user_id', $user->id)->sum('amount') ?? 0;

        // Validate the withdrawal amount
        // switch ($accountType) {
        //     case 'holding':
        //         if ($amount > $holdingBalance) {
        //             return response()->json(['message' => 'Insufficient balance in Holding Account.'], 400);
        //         }
        //         break;
        //     case 'staking':
        //         if ($amount > $stakingBalance) {
        //             return response()->json(['message' => 'Insufficient balance in Staking Account.'], 400);
        //         }
        //         break;
        //     case 'trading':
        //         if ($amount > $tradingBalance) {
        //             return response()->json(['message' => 'Insufficient balance in Trading Account.'], 400);
        //         }
        //     case 'referral':
        //         if ($amount > $tradingBalance) {
        //             return response()->json(['message' => 'Insufficient balance in Referral Account.'], 400);
        //         }
        //     case 'profit':
        //         if ($amount > $tradingBalance) {
        //             return response()->json(['message' => 'Insufficient balance in Profit Account.'], 400);
        //         }
        //     case 'deposit':
        //         if ($amount > $tradingBalance) {
        //             return response()->json(['message' => 'Insufficient balance in Deposit Account.'], 400);
        //         }
        //         break;
        //     default:
        //         return response()->json(['message' => 'Invalid account selected.'], 400);
        // }

        // Start a database transaction
        DB::beginTransaction();

        try {
            // Deduct the amount from the selected account
            switch ($accountType) {
                case 'holding':
                    HoldingBalance::where('user_id', $user->id)->decrement('amount', $amount);
                    break;
                case 'staking':
                    StakingBalance::where('user_id', $user->id)->decrement('amount', $amount);
                    break;
                case 'trading':
                    TradingBalance::where('user_id', $user->id)->decrement('amount', $amount);
                    break;
                case 'referral':
                    referralBalance::where('user_id', $user->id)->decrement('amount', $amount);
                    break;
                case 'profit':
                    Profit::where('user_id', $user->id)->decrement('amount', $amount);
                    break;
                case 'deposit':
                    Deposit::where('user_id', $user->id)->decrement('amount', $amount);
                    break;
            }

            // Create a new withdrawal record
            Withdrawal::create([
                'user_id' => $user->id,
                'account_type' => $accountType,
                'crypto_currency' => $cryptoCurrency,
                'amount' => $amount,
                'wallet_address' => $walletAddress,
                'status' => 'pending', // Default status
            ]);

            // Commit the transaction
            DB::commit();
            // Set a session flag to show the notification
            session()->flash('show_notification', true);
            return response()->json([
                'message' => 'Withdrawal request submitted successfully!',
                'redirect' => route('withdrawal'), // Redirect to the withdrawal page
            ]);
        } catch (\Exception $e) {
            // Rollback the transaction in case of an error
            DB::rollBack();
            return response()->json(['message' => 'An error occurred. Please try again.'], 500);
        }
    }
}
