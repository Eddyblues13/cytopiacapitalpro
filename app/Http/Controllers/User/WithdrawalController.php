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
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\User\ReferralBalance;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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


        $data['user'] = Auth::user();

        $data['holdingBalance'] = HoldingBalance::where('user_id', $user->id)->sum('amount') ?? 0;
        $data['stakingBalance'] = StakingBalance::where('user_id', $user->id)->sum('amount') ?? 0;
        $data['tradingBalance'] = TradingBalance::where('user_id', $user->id)->sum('amount') ?? 0;
        $data['referralBalance'] = ReferralBalance::where('user_id', $user->id)->sum('amount') ?? 0;
        $data['depositBalance'] = Deposit::where('user_id', $user->id)
            ->where('status', 'approved') // Only include approved deposits
            ->sum('amount') ?? 0;
        $data['profit'] = Profit::where('user_id', $user->id)->sum('amount') ?? 0;

        $data['totalBalance'] =
            $data['holdingBalance'] +
            $data['stakingBalance'] +
            $data['tradingBalance'] +
            $data['referralBalance'] +
            $data['profit'];


        return view('user.crypto_withdrawal', $data);
    }
    public function submit(Request $request)
    {
        DB::beginTransaction();

        try {
            // Validate request data
            $validator = $this->validateWithdrawalRequest($request);

            if ($validator->fails()) {
                Log::warning('Withdrawal validation failed', [
                    'user_id' => Auth::id(),
                    'errors' => $validator->errors()->toArray(),
                    'input' => $request->all()
                ]);

                DB::rollBack();
                return response()->json([
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            $user = Auth::user();
            $amount = $request->input('amount');
            $accountType = $request->input('account');

            // Check account balance
            $balance = $this->getAccountBalance($user, $accountType);

            if ($amount > $balance) {
                Log::warning('Insufficient balance', [
                    'user_id' => $user->id,
                    'account_type' => $accountType,
                    'amount' => $amount,
                    'balance' => $balance
                ]);

                DB::rollBack();
                return response()->json([
                    'message' => 'Insufficient balance in selected account',
                    'errors' => ['amount' => ['Insufficient balance in selected account']]
                ], 400);
            }

            // Process withdrawal
            $this->deductFromAccount($user, $accountType, $amount);

            $withdrawal = $this->createWithdrawalRecord($user, $request, $accountType, $amount);

            DB::commit();

            Log::info('Withdrawal successful', [
                'user_id' => $user->id,
                'withdrawal_id' => $withdrawal->id,
                'amount' => $amount
            ]);

            return response()->json([
                'message' => 'Withdrawal request submitted successfully!',
                'redirect' => route('withdrawal'),
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Withdrawal failed: ' . $e->getMessage(), [
                'exception' => $e,
                'request' => $request->all(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'message' => 'An error occurred while processing your withdrawal. Please try again.',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }

    protected function validateWithdrawalRequest(Request $request)
    {
        $rules = [
            'withdrawal_method' => 'required|string|in:crypto,bank',
            'account' => 'required|string|in:holding,staking,trading,profit,deposit,referral',
            'amount' => 'required|numeric|min:0.01',
        ];

        if ($request->withdrawal_method === 'crypto') {
            $rules = array_merge($rules, [
                'crypto_currency' => 'required|string|in:btc,usdt,eth',
                'wallet_address' => [
                    'required',
                    'string',
                    'min:10',
                    'max:255',
                    'regex:/^[a-zA-Z0-9]+$/'
                ],
            ]);
        } else {
            $rules = array_merge($rules, [
                'country' => 'required|string|max:100',
                'bank' => 'required|string|max:100',
                'account_number' => [
                    'required',
                    'string',
                    'max:50',
                    'regex:/^[0-9]+$/'
                ],
                'account_name' => [
                    'required',
                    'string',
                    'max:100',
                    'regex:/^[a-zA-Z\s]+$/'
                ],
                'swift_code' => [
                    'nullable',
                    'string',
                    'max:50',
                    'regex:/^[a-zA-Z0-9]+$/'
                ],
            ]);
        }

        $messages = [
            'wallet_address.regex' => 'Wallet address should contain only alphanumeric characters',
            'account_number.regex' => 'Account number should contain only numbers',
            'account_name.regex' => 'Account name should contain only letters and spaces',
            'swift_code.regex' => 'SWIFT code should contain only alphanumeric characters',
        ];

        return Validator::make($request->all(), $rules, $messages);
    }

    protected function getAccountBalance($user, $accountType)
    {
        $modelMap = [
            'holding' => HoldingBalance::class,
            'staking' => StakingBalance::class,
            'trading' => TradingBalance::class,
            'referral' => ReferralBalance::class,
            'deposit' => Deposit::class,
            'profit' => Profit::class,
        ];

        if (!array_key_exists($accountType, $modelMap)) {
            throw new \Exception("Invalid account type: {$accountType}");
        }

        if ($accountType === 'deposit') {
            return $modelMap[$accountType]::where('user_id', $user->id)
                ->where('status', 'active')
                ->sum('amount') ?? 0;
        }

        return $modelMap[$accountType]::where('user_id', $user->id)
            ->sum('amount') ?? 0;
    }

    protected function deductFromAccount($user, $accountType, $amount)
    {
        $modelMap = [
            'holding' => HoldingBalance::class,
            'staking' => StakingBalance::class,
            'trading' => TradingBalance::class,
            'referral' => ReferralBalance::class,
            'deposit' => Deposit::class,
            'profit' => Profit::class,
        ];

        if (!array_key_exists($accountType, $modelMap)) {
            throw new \Exception("Invalid account type: {$accountType}");
        }

        if ($accountType === 'deposit') {
            $affected = $modelMap[$accountType]::where('user_id', $user->id)
                ->where('status', 'active')
                ->decrement('amount', $amount);
        } else {
            $affected = $modelMap[$accountType]::where('user_id', $user->id)
                ->decrement('amount', $amount);
        }

        if ($affected === 0) {
            throw new \Exception("Failed to deduct from {$accountType} account");
        }
    }

    protected function createWithdrawalRecord($user, $request, $accountType, $amount)
    {
        $withdrawalData = [
            'user_id' => $user->id,
            'account_type' => $accountType,
            'amount' => $amount,
            'currency' => $user->currency,
            'status' => 'pending',
            'withdrawal_method' => $request->withdrawal_method,
            'fee' => $this->calculateWithdrawalFee($amount, $request->withdrawal_method)
        ];

        if ($request->withdrawal_method === 'crypto') {
            $withdrawalData['crypto_currency'] = $request->crypto_currency;
            $withdrawalData['wallet_address'] = $request->wallet_address;
        } else {
            $withdrawalData['bank_details'] = json_encode([
                'country' => $request->country,
                'bank' => $request->bank,
                'account_number' => $request->account_number,
                'account_name' => $request->account_name,
                'swift_code' => $request->swift_code ?? null,
            ]);
        }

        return Withdrawal::create($withdrawalData);
    }

    protected function calculateWithdrawalFee($amount, $method)
    {
        // Implement your fee calculation logic here
        // Example: 1% fee for crypto, 2% for bank transfers
        $feePercentage = $method === 'crypto' ? 0.01 : 0.02;
        return $amount * $feePercentage;
    }


    // public function submit(Request $request)
    // {
    //     // Validate the request
    //     $request->validate([
    //         'account' => 'required|string|in:trading,holding,staking,profit,deposit',
    //         'crypto_currency' => 'required|string|in:btc,usdt,eth',
    //         'amount' => 'required|numeric|min:0.01',
    //         'wallet_address' => 'required|string',
    //     ]);

    //     $user = Auth::user();
    //     $amount = $request->input('amount');
    //     $accountType = $request->input('account');
    //     $cryptoCurrency = $request->input('crypto_currency');
    //     $walletAddress = $request->input('wallet_address');

    //     // Fetch user balances
    //     $holdingBalance = HoldingBalance::where('user_id', $user->id)->sum('amount') ?? 0;
    //     $stakingBalance = StakingBalance::where('user_id', $user->id)->sum('amount') ?? 0;
    //     $tradingBalance = TradingBalance::where('user_id', $user->id)->sum('amount') ?? 0;
    //     $referralBalance = ReferralBalance::where('user_id', $user->id)->sum('amount') ?? 0;

    //     $data['depositBalance'] = Deposit::where('user_id', $user->id)
    //         ->where('status', 'approved') // Only include approved deposits
    //         ->sum('amount') ?? 0;
    //     $data['profit'] = Profit::where('user_id', $user->id)->sum('amount') ?? 0;

    //     // Validate the withdrawal amount
    //     // switch ($accountType) {
    //     //     case 'holding':
    //     //         if ($amount > $holdingBalance) {
    //     //             return response()->json(['message' => 'Insufficient balance in Holding Account.'], 400);
    //     //         }
    //     //         break;
    //     //     case 'staking':
    //     //         if ($amount > $stakingBalance) {
    //     //             return response()->json(['message' => 'Insufficient balance in Staking Account.'], 400);
    //     //         }
    //     //         break;
    //     //     case 'trading':
    //     //         if ($amount > $tradingBalance) {
    //     //             return response()->json(['message' => 'Insufficient balance in Trading Account.'], 400);
    //     //         }
    //     //     case 'referral':
    //     //         if ($amount > $tradingBalance) {
    //     //             return response()->json(['message' => 'Insufficient balance in Referral Account.'], 400);
    //     //         }
    //     //     case 'profit':
    //     //         if ($amount > $tradingBalance) {
    //     //             return response()->json(['message' => 'Insufficient balance in Profit Account.'], 400);
    //     //         }
    //     //     case 'deposit':
    //     //         if ($amount > $tradingBalance) {
    //     //             return response()->json(['message' => 'Insufficient balance in Deposit Account.'], 400);
    //     //         }
    //     //         break;
    //     //     default:
    //     //         return response()->json(['message' => 'Invalid account selected.'], 400);
    //     // }

    //     // Start a database transaction
    //     DB::beginTransaction();

    //     try {
    //         // Deduct the amount from the selected account
    //         switch ($accountType) {
    //             case 'holding':
    //                 HoldingBalance::where('user_id', $user->id)->decrement('amount', $amount);
    //                 break;
    //             case 'staking':
    //                 StakingBalance::where('user_id', $user->id)->decrement('amount', $amount);
    //                 break;
    //             case 'trading':
    //                 TradingBalance::where('user_id', $user->id)->decrement('amount', $amount);
    //                 break;
    //             case 'referral':
    //                 referralBalance::where('user_id', $user->id)->decrement('amount', $amount);
    //                 break;
    //             case 'profit':
    //                 Profit::where('user_id', $user->id)->decrement('amount', $amount);
    //                 break;
    //             case 'deposit':
    //                 Deposit::where('user_id', $user->id)->decrement('amount', $amount);
    //                 break;
    //         }

    //         // Create a new withdrawal record
    //         Withdrawal::create([
    //             'user_id' => $user->id,
    //             'account_type' => $accountType,
    //             'crypto_currency' => $cryptoCurrency,
    //             'amount' => $amount,
    //             'wallet_address' => $walletAddress,
    //             'status' => 'pending', // Default status
    //         ]);

    //         // Commit the transaction
    //         DB::commit();
    //         // Set a session flag to show the notification
    //         session()->flash('show_notification', true);
    //         return response()->json([
    //             'message' => 'Withdrawal request submitted successfully!',
    //             'redirect' => route('withdrawal'), // Redirect to the withdrawal page
    //         ]);
    //     } catch (\Exception $e) {
    //         // Rollback the transaction in case of an error
    //         DB::rollBack();
    //         return response()->json(['message' => 'An error occurred. Please try again.'], 500);
    //     }
    // }
}
