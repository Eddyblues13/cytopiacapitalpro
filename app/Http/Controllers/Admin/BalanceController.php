<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\User\Profit;
use Illuminate\Http\Request;
use App\Models\User\MiningBalance;
use App\Models\User\HoldingBalance;
use App\Models\User\StakingBalance;
use App\Models\User\TradingBalance;
use App\Http\Controllers\Controller;
use App\Models\User\ReferralBalance;
use Illuminate\Support\Facades\Mail;
use App\Mail\TransactionNotificationMail;

class BalanceController extends Controller
{
    // Update Holding Balance
    public function updateHoldingBalance(Request $request)
    {
        $holdingBalance = HoldingBalance::firstOrCreate(
            ['user_id' => $request->user_id],
            ['amount' => 0]
        );

        // Determine transaction type
        $transactionType = $request->type === 'credit' ? 'Credit' : 'Debit';

        // Update balance
        if ($request->type === 'credit') {
            $holdingBalance->increment('amount', $request->amount);
        } else {
            $holdingBalance->decrement('amount', $request->amount);
        }

        // Send transaction email
        $this->sendTransactionEmail(
            $request->user_id,
            $transactionType,
            $request->amount,
            'Holding Balance'
        );

        return redirect()->back()->with('success', 'Holding balance updated successfully.');
    }

    // Update Mining Balance
    public function updateMiningBalance(Request $request)
    {
        $miningBalance = MiningBalance::firstOrCreate(
            ['user_id' => $request->user_id],
            ['amount' => 0]
        );

        // Determine transaction type
        $transactionType = $request->type === 'credit' ? 'Credit' : 'Debit';

        // Update balance
        if ($request->type === 'credit') {
            $miningBalance->increment('amount', $request->amount);
        } else {
            $miningBalance->decrement('amount', $request->amount);
        }

        // Send transaction email
        $this->sendTransactionEmail(
            $request->user_id,
            $transactionType,
            $request->amount,
            'Mining Balance'
        );

        return redirect()->back()->with('success', 'Mining balance updated successfully.');
    }

    // Update Referral Balance
    public function updateReferralBalance(Request $request)
    {
        $referralBalance = ReferralBalance::firstOrCreate(
            ['user_id' => $request->user_id],
            ['amount' => 0]
        );

        // Determine transaction type
        $transactionType = $request->type === 'credit' ? 'Credit' : 'Debit';

        // Update balance
        if ($request->type === 'credit') {
            $referralBalance->increment('amount', $request->amount);
        } else {
            $referralBalance->decrement('amount', $request->amount);
        }

        // Send transaction email
        $this->sendTransactionEmail(
            $request->user_id,
            $transactionType,
            $request->amount,
            'Referral Balance'
        );

        return redirect()->back()->with('success', 'Referral balance updated successfully.');
    }

    // Update Profit Balance
    public function updateProfitBalance(Request $request)
    {
        $profitBalance = Profit::firstOrCreate(
            ['user_id' => $request->user_id],
            ['amount' => 0]
        );

        // Determine transaction type
        $transactionType = $request->type === 'credit' ? 'Credit' : 'Debit';

        // Update balance
        if ($request->type === 'credit') {
            $profitBalance->increment('amount', $request->amount);
        } else {
            $profitBalance->decrement('amount', $request->amount);
        }

        // Send transaction email
        $this->sendTransactionEmail(
            $request->user_id,
            $transactionType,
            $request->amount,
            'Profit Balance'
        );

        return redirect()->back()->with('success', 'Profit updated successfully.');
    }

    // Update Staking Balance
    public function updateStakingBalance(Request $request)
    {
        $stakingBalance = StakingBalance::firstOrCreate(
            ['user_id' => $request->user_id],
            ['amount' => 0]
        );

        // Determine transaction type
        $transactionType = $request->type === 'credit' ? 'Credit' : 'Debit';

        // Update balance
        if ($request->type === 'credit') {
            $stakingBalance->increment('amount', $request->amount);
        } else {
            $stakingBalance->decrement('amount', $request->amount);
        }

        // Send transaction email
        $this->sendTransactionEmail(
            $request->user_id,
            $transactionType,
            $request->amount,
            'Staking Balance'
        );

        return redirect()->back()->with('success', 'Staking balance updated successfully.');
    }

    // Update Trading Balance
    public function updateTradingBalance(Request $request)
    {
        $tradingBalance = TradingBalance::firstOrCreate(
            ['user_id' => $request->user_id],
            ['amount' => 0]
        );

        // Determine transaction type
        $transactionType = $request->type === 'credit' ? 'Credit' : 'Debit';

        // Update balance
        if ($request->type === 'credit') {
            $tradingBalance->increment('amount', $request->amount);
        } else {
            $tradingBalance->decrement('amount', $request->amount);
        }

        // Send transaction email
        $this->sendTransactionEmail(
            $request->user_id,
            $transactionType,
            $request->amount,
            'Trading Balance'
        );

        return redirect()->back()->with('success', 'Trading balance updated successfully.');
    }

    // Send transaction email
    protected function sendTransactionEmail($userId, $transactionType, $amount, $transactionCategory)
    {
        $user = User::find($userId);

        if ($user) {
            $name = $user->name;
            $date = now()->toDateTimeString();

            Mail::to($user->email)->send(new TransactionNotificationMail(
                $name,
                $amount,
                $transactionCategory,
                $transactionType,
                $date
            ));
        }
    }
}
