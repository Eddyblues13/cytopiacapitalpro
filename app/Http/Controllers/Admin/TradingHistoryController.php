<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Trader;
use Illuminate\Http\Request;
use App\Models\TradingHistory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class TradingHistoryController extends Controller
{
    public function index()
    {
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

        // Fetch trading history with user and trader relations
        $histories = TradingHistory::with(['user', 'trader'])->latest()->get();

        // Get all users and traders
        $users = User::all();
        $traders = Trader::all();

        return view('admin.trading-histories.index', compact('histories', 'users', 'traders', 'symbols'));
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'trader_id' => 'required|exists:traders,id',
            'amount' => 'required|numeric|min:0',
            'status' => 'required|in:pending,completed,failed'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $history = TradingHistory::create($request->all());
            return response()->json([
                'status' => 'success',
                'message' => 'Trading history created successfully!',
                'data' => $history
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error creating trading history: ' . $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'trader_id' => 'required|exists:traders,id',
            'amount' => 'required|numeric|min:0',
            'status' => 'required|in:pending,completed,failed'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $history = TradingHistory::findOrFail($id);
            $history->update($request->all());
            return response()->json([
                'status' => 'success',
                'message' => 'Trading history updated successfully!',
                'data' => $history
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error updating trading history: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $history = TradingHistory::findOrFail($id);
            $history->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Trading history deleted successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error deleting trading history: ' . $e->getMessage()
            ], 500);
        }
    }
}
