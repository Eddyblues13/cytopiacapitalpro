<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Models\TradingHistory;
use Illuminate\Support\Facades\DB;
use App\Models\User\TradingBalance;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CopiedTradeController extends Controller
{
    /**
     * Display all copied traders
     */
    public function index()
    {
        $tradingHistory = TradingHistory::with(['trader' => function ($query) {
            $query->select('id', 'name', 'picture', 'return_rate');
        }])
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('user.copied-traders', [
            'tradingHistory' => $tradingHistory,
            'tradingBalance' => $this->getTradingBalance()
        ]);
    }

    /**
     * Stop copying a trader
     */
    public function stop(Request $request)
    {
        $request->validate([
            'trade_id' => 'required|exists:trading_histories,id'
        ]);

        try {
            DB::beginTransaction();

            $trade = TradingHistory::where('user_id', Auth::id())
                ->where('id', $request->trade_id)
                ->where('status', 'active')
                ->firstOrFail();

            // Refund the amount to trading balance
            TradingBalance::create([
                'user_id' => Auth::id(),
                'amount' => $trade->amount
            ]);

            // Update trade status
            $trade->update([
                'status' => 'closed',
                'closed_at' => now()
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Successfully stopped copying this trader',
                'refund_amount' => $trade->amount
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Failed to stop trade: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Copy a new trader
     */
    public function copyTrader(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'trader_id' => 'required|exists:traders,id',
            'amount' => 'nullable'
        ]);



        try {
            DB::beginTransaction();

            // Check available balance
            $currentBalance = $this->getTradingBalance();

            if ($currentBalance < $validated['amount']) {
                return response()->json([
                    'success' => false,
                    'message' => 'Insufficient trading balance. Your balance: $' . number_format($currentBalance, 2)
                ], 400);
            }

            //Decrement trading balance
            TradingBalance::where('user_id', $user->id)
                ->decrement('amount', $validated['amount']);

            // Create trading history record
            $trade = TradingHistory::create([
                'user_id' => $user->id,
                'trader_id' => $validated['trader_id'],
                'amount' => $validated['amount'],
                'status' => 'active'
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Successfully copied trader',
                'new_balance' => $currentBalance,
                'trade_id' => 2,
                'new_balance' => $currentBalance - $validated['amount'],
                'trade_id' => $trade->id
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Failed to copy trader: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get user's current trading balance
     */
    private function getTradingBalance()
    {
        return TradingBalance::where('user_id', Auth::id())
            ->sum('amount') ?? 0;
    }
}
