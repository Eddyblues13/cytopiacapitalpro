<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Trade;
use App\Models\Trader;
use Illuminate\Http\Request;
use App\Models\TradingHistory;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class UserTradingHistoryController extends Controller
{
    public function index($userId)
    {
        // Get list of available traders (you might have a Trader model)
        $traders = Trader::get();

        // List of common trading symbols
        $symbols = [
            'BTCUSD',
            'ETHUSD',
            'XRPUSD',
            'SOLUSD',
            'ADAUSD',
            'DOTUSD',
            'DOGEUSD',
            'AVAXUSD',
            'MATICUSD',
            'LTCUSD',
            'ATOMUSD',
            'XLMUSD',
            'EURUSD',
            'GBPUSD',
            'USDJPY',
            'AUDUSD',
            'USDCAD',
            'USDCHF',
            'GOLD',
            'SILVER',
            'OIL',
            'SPX500',
            'NAS100',
            'DJ30'
        ];

        $trades = Trade::with('user')
            ->orderBy('entry_date', 'desc')
            ->paginate(20);


        $user = User::findOrFail($userId);
        $histories = TradingHistory::with(['user', 'trader'])
            ->where('user_id', $userId)
            ->latest()
            ->get(); 

        return view('admin.user.trading.index', compact('histories', 'user', 'traders', 'trades', 'symbols'));
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'user_id' => 'nullable|exists:users,id',
                'symbol' => 'nullable|string|max:20',
                // 'type' => 'nullable|in:spot,futures,margin',
                'direction' => 'nullable|in:up,down',
                'entry_price' => 'nullable|numeric|min:0',
                'exit_price' => 'nullable|numeric|min:0',
                'amount' => 'nullable|numeric|min:0',
                'profit' => 'nullable|numeric',
                'status' => 'nullable|in:active,closed',
                'entry_date' => 'nullable|date',
                'exit_date' => 'nullable|date',
                'trader_name' => 'nullable|string|max:255',
                'notes' => 'nullable|string'
            ]);

            $trade = Trade::create($validated);

            return response()->json([
                'status' => 'success',
                'message' => 'Trade created successfully!',
                'trade' => $trade
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            Log::error('Error creating trade: ' . $e->getMessage());
            return response()->json([
                'message' => 'Failed to create trade. Please try again.'
            ], 500);
        }
    }

    public function update(Request $request, Trade $trade)
    {
        try {
            $validated = $request->validate([
                'symbol' => 'nullable|string|max:20',
                // 'type' => 'required|in:spot,futures,margin',
                'direction' => 'nullable|in:up,down',
                'entry_price' => 'nullable|numeric|min:0',
                'exit_price' => 'nullable|numeric|min:0|required_if:status,closed',
                'amount' => 'required|numeric|min:0',
                'profit' => 'nullable|numeric',
                'status' => 'required|in:active,closed',
                'entry_date' => 'required|date',
                'exit_date' => 'nullable|date|required_if:status,closed',
                'trader_name' => 'nullable|string|max:255',
                'notes' => 'nullable|string'
            ]);

            $trade->update($validated);

            return response()->json([
                'status' => 'success',
                'message' => 'Trade updated successfully!',
                'trade' => $trade
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            Log::error('Error updating trade: ' . $e->getMessage());
            return response()->json([
                'message' => 'Failed to update trade. Please try again.'
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $trade = Trade::findOrFail($id);
            $trade->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Trade deleted successfully!'
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Trade not found'
            ], 404);
        } catch (\Exception $e) {
            Log::error('Error deleting trade: ' . $e->getMessage());
            return response()->json([
                'message' => 'Failed to delete trade. Please try again.'
            ], 500);
        }
    }
}
