<?php

namespace App\Http\Controllers\User;

use App\Models\User\Deposit;
use Illuminate\Http\Request;
use App\Models\User\MiningBalance;
use App\Models\User\HoldingBalance;
use App\Models\User\StakingBalance;
use App\Models\User\TradingBalance;
use App\Http\Controllers\Controller;
use App\Models\User\ReferralBalance;
use Illuminate\Support\Facades\Auth;

class DepositController extends Controller
{
    public function index()
    {
        $deposits = Deposit::where('user_id', auth()->id())
            ->latest()
            ->paginate(10); // Adjust pagination as needed

        return view('user.deposit.home', compact('deposits'));
    }

    public function buyCrypto()
    {
        // Adjust pagination as needed

        return view('user.deposit.buy_crypto');
    }

    public function stepOne()
    {

        $user = Auth::user();

        return view('user.deposit.fund_one', [
            'tradingBalance' => TradingBalance::where('user_id', $user->id)->sum('amount') ?? 0,
            'miningBalance' => MiningBalance::where('user_id', $user->id)->sum('amount') ?? 0,
            'stakingBalance' => StakingBalance::where('user_id', $user->id)->sum('amount') ?? 0,

        ]);
    }

    public function stepOneSubmit(Request $request)
    {
        // Get authenticated user
        $user = Auth::user();

        // Validate the request
        $validatedData = $request->validate([
            'amount' => 'required|numeric|min:1000', // Minimum deposit of 10
            'account' => 'required|string|in:holding,trading,mining,staking' // Match your select options
        ]);

        // Create the deposit record
        $deposit = Deposit::create([
            'user_id' => $user->id,
            'amount' => $validatedData['amount'],
            'account_type' => $validatedData['account'],
            'status' => 'pending'
        ]);

        // Store deposit data in session
        session([
            'deposit_id' => $deposit->id,
            'deposit_amount' => $deposit->amount,
            'deposit_account_type' => $deposit->account_type
        ]);

        // Get balances
        $holdingBalance = HoldingBalance::where('user_id', $user->id)->sum('amount') ?? 0;
        $stakingBalance = StakingBalance::where('user_id', $user->id)->sum('amount') ?? 0;
        $tradingBalance = TradingBalance::where('user_id', $user->id)->sum('amount') ?? 0;
        $referralBalance = ReferralBalance::where('user_id', $user->id)->sum('amount') ?? 0;

        $data = [
            'holdingBalance' => $holdingBalance,
            'stakingBalance' => $stakingBalance,
            'tradingBalance' => $tradingBalance,
            'referralBalance' => $referralBalance,
            'totalBalance' => $holdingBalance + $stakingBalance + $tradingBalance + $referralBalance
        ];

        // Return JSON response
        return response()->json([
            'success' => true,
            'message' => 'Deposit request submitted successfully!',
            'deposit' => [
                'id' => $deposit->id,
                'amount' => $deposit->amount,
                'account_type' => $deposit->account_type,
                'status' => $deposit->status
            ],
            'balances' => $data, // Renamed from 'data' to be more descriptive
        ]);
    }
    public function stepTwo(Request $request)
    {
        // Retrieve data from query parameters
        // $amount = $request->query('amount');
        // $account = $request->query('account_type');
        // Get individual session values
        $depositId = session('deposit_id');
        $amount = session('deposit_amount');
        $account = session('deposit_account_type');

        // Pass data to the view
        return view('user.deposit.fund_two', [
            'amount' => $amount,
            'account' => $account,
        ]);
    }

    public function stepTwoSubmit(Request $request)
    {
        // Validate input
        $request->validate([
            'amount' => 'required|numeric|min:1',
            'account' => 'required|in:trading,holding,staking',
        ]);

        // Process the data (e.g., save to database)
        $amount = $request->input('amount');
        $account = $request->input('account');

        // Return JSON response
        return response()->json([
            'success' => true,
            'message' => 'Form submitted successfully!',
            'amount' => $amount,
            'account' => $account,
        ]);
    }


    public function stepThree(Request $request)
    {
        // Retrieve data from query parameters
        $amount = $request->query('amount');
        $account = $request->query('account');

        // Pass data to the view
        return view('user.deposit.fund_three', [
            'amount' => $amount,
            'account' => $account,
        ]);
    }

    public function stepThreeSubmit(Request $request)
    {
        // Validate input
        $request->validate([
            'amount' => 'required|numeric|min:1',
            'account' => 'required|in:trading,holding,staking',
        ]);

        // Process the data (e.g., save to database)
        $amount = $request->input('amount');
        $account = $request->input('account');

        // Return JSON response
        return response()->json([
            'success' => true,
            'message' => 'Form submitted successfully!',
            'amount' => $amount,
            'account' => $account,
        ]);
    }


    public function payment(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:10',
            'payment_method' => 'required|in:BTC,ETH,XRP,SOL,USDT,DOGE,LTC,ADA',
            'crypto_amount' => 'required|numeric|gt:0',
            //'account' => 'required|exists:users,id,user_id,' . auth()->id(),
            'currency' => 'required|string|max:3'
        ]);

        try {


            return response()->json([
                'success' => true,
                'message' => 'Deposit initiated successfully',
                'redirect_url' => route('pay.crypto', [
                    'txn_id' => 'txn_id',
                    'crypto' => $request->payment_method,
                    'amount' => $request->crypto_amount,
                    'address' => 'tysyysu'
                ])
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to process deposit: ' . $e->getMessage()
            ], 500);
        }
    }

    public function payCrypto(Request $request)
    {

        // Retrieve data from query parameters
        $txn_id = $request->query('txn_id');
        $crypto = $request->query('crypto');
        $amount = $request->query('amount');

        // Fetch wallet details from database based on cryptocurrency type
        $wallet = \App\Models\WalletOption::where('coin_code', $crypto)->first();

        if (!$wallet) {
            return redirect()->back()->with('error', 'Wallet for this cryptocurrency is not available');
        }

        // Pass all data to the view
        return view('user.deposit.pay_crypto', [
            'txn_id' => $txn_id,
            'crypto' => $crypto,
            'crypto_amount' => $amount,
            'wallet_address' => $wallet->wallet_address,
            'payment_method' => $crypto,
            'coin_name' => $wallet->coin_name,
            'network_type' => $wallet->network_type
        ]);
    }
}
