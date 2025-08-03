<?php

namespace App\Http\Controllers\Admin;

use App\Models\Stock;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StockController extends Controller
{
    public function index()
    {
        $stocks = Stock::all();
        return view('admin.stocks.index', compact('stocks'));
    }

    public function create()
    {
        return view('admin.stocks.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'stock_name' => 'required|string|max:255',
            'stock_max_amount' => 'required|numeric|min:0',
            'stock_min_amount' => 'required|numeric|min:0',
            'stock_js' => 'required|string',
            'stock_graph' => 'required|string',
            'top_up_amount' => 'nullable|numeric|min:0',
            'top_up_interval' => 'nullable|string|max:255',
            'top_up_type' => 'nullable|string|max:255',
            'investment_duration' => 'nullable|integer|min:1',
            'top_up_status' => 'required|',
            'performance' => 'nullable|string|max:255',
            'copier_roi' => 'nullable|numeric|min:0|max:100',
            'years_of_experience' => 'nullable|integer|min:0',
            'picture' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('picture')) {
            $file = $request->file('picture');
            $filename = time() . '_stock.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/stocks'), $filename);
            $validated['picture'] = 'uploads/stocks/' . $filename;
        }

        Stock::create($validated);

        return redirect()->route('stock.index')->with('success', 'Stock created successfully!');
    }

    public function edit(Stock $stock)
    {
        return view('admin.stocks.edit', compact('stock'));
    }

    public function update(Request $request, Stock $stock)
    {
        $validated = $request->validate([
            'stock_name' => 'required|string|max:255',
            'stock_max_amount' => 'required|numeric|min:0',
            'stock_min_amount' => 'required|numeric|min:0',
            'stock_js' => 'nullable|string|',
            'stock_graph' => 'nullable|string|max:255',
            'top_up_amount' => 'required|numeric|min:0',
            'top_up_interval' => 'required|string|max:255',
            'top_up_type' => 'required|string|max:255',
            'investment_duration' => 'required|numeric|min:1',
            'top_up_status' => 'required|',
            'performance' => 'nullable|string|max:255',
            'copier_roi' => 'nullable|numeric|min:0',
            'years_of_experience' => 'required|numeric|min:0',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'nullable|string',
        ]);

        if ($request->hasFile('picture')) {
            $file = $request->file('picture');
            $filename = time() . '_stock.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/stocks'), $filename);
            $validated['picture'] = 'uploads/stocks/' . $filename;
        }

        $stock->update($validated);

        return redirect()->route('stock.index')->with('success', 'Stock updated successfully!');
    }

    public function destroy(Stock $stock)
    {
        if ($stock->picture && file_exists(public_path($stock->picture))) {
            unlink(public_path($stock->picture));
        }

        $stock->delete();

        return redirect()->route('stock.index')->with('success', 'Stock deleted successfully!');
    }
}
