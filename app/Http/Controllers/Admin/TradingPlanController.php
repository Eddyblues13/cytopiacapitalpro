<?php

namespace App\Http\Controllers\Admin;

use App\Models\Plan;
use App\Models\TradingPlan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TradingPlanController extends Controller
{
    public function index()
    {
        $plans = Plan::all();
        return view('admin.plans.index', compact('plans'));
    }

    public function create()
    {
        return view('admin.plans.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'swap_fee' => 'boolean',
            'pairs' => 'required|integer|min:1',
            'leverage' => 'nullable|string|max:50',
            'spread' => 'nullable|string|max:50',
        ]);

        try {
            Plan::create($request->all());
            return response()->json([
                'status' => 'success',
                'message' => 'Plan created successfully!',
                'redirect' => route('admin.plans.index')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error creating plan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function edit(Plan $plan)
    {
        return view('admin.plans.edit', compact('plan'));
    }

    public function update(Request $request, Plan $plan)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'swap_fee' => 'boolean',
            'pairs' => 'required|integer|min:1',
            'leverage' => 'nullable|string|max:50',
            'spread' => 'nullable|string|max:50',
        ]);

        try {
            $plan->update($request->all());
            return response()->json([
                'status' => 'success',
                'message' => 'Plan updated successfully!',
                'redirect' => route('admin.plans.index')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error updating plan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy(Plan $plan)
    {
        try {
            $plan->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Plan deleted successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error deleting plan: ' . $e->getMessage()
            ], 500);
        }
    }
}
