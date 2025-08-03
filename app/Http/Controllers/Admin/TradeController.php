<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Trade;
use App\Models\Trader;
use App\Models\TradeHistory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TradeController extends Controller
{

    public function index()
    {
        $traders = Trader::all();
        return view('admin.traders.index', compact('traders'));
    }



    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'followers' => 'required|integer',
            'return_rate' => 'required|numeric',
            // 'min_amount' => 'required|numeric',
            // 'max_amount' => 'required|numeric',
            'profit_share' => 'required|numeric',
            'is_verified' => 'required|boolean',
            'picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Handle file upload
        if ($request->hasFile('picture')) {
            $photo = $request->file('picture');
            $filename = time() . '.' . $photo->getClientOriginalExtension(); // Generate unique filename
            $destinationPath = public_path('uploads/photos/'); // Define destination path

            // Move the file to the destination folder
            $photo->move($destinationPath, $filename);

            // Store the path in the database
            $picturePath = 'uploads/photos/' . $filename;
        } else {
            return response()->json(['success' => false, 'message' => 'No picture uploaded.'], 400);
        }

        $trader = Trader::create([
            'name' => $request->name,
            'followers' => $request->followers,
            'return_rate' => $request->return_rate,
            // 'min_amount' => $request->min_amount,
            // 'max_amount' => $request->max_amount,
            'profit_share' => $request->profit_share,
            'is_verified' => $request->is_verified,
            'picture' => $picturePath,
        ]);

        if ($trader) {
            return response()->json(['success' => true, 'message' => 'Trader added successfully!']);
        } else {
            return response()->json(['success' => false, 'message' => 'Failed to add trader.']);
        }
    }

    // Update the specified trade in storage
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'followers' => 'required|integer',
            'return_rate' => 'required|numeric',
            // 'min_amount' => 'required|numeric',
            // 'max_amount' => 'required|numeric',
            'profit_share' => 'required|numeric',
            'is_verified' => 'required|boolean',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $trader = Trader::findOrFail($id);

        // Handle file upload if a new picture is provided
        if ($request->hasFile('picture')) {
            $photo = $request->file('picture');
            $filename = time() . '.' . $photo->getClientOriginalExtension(); // Generate unique filename
            $destinationPath = public_path('uploads/photos/'); // Define destination path

            // Move the file to the destination folder
            $photo->move($destinationPath, $filename);

            // Delete the old picture if it exists
            if ($trader->picture && file_exists(public_path($trader->picture))) {
                unlink(public_path($trader->picture)); // Delete the old file
            }

            // Store the new picture path
            $trader->picture = 'uploads/photos/' . $filename;
        }

        // Update other fields
        $trader->name = $request->name;
        $trader->followers = $request->followers;
        $trader->return_rate = $request->return_rate;
        // $trader->min_amount = $request->min_amount;
        // $trader->max_amount = $request->max_amount;
        $trader->profit_share = $request->profit_share;
        $trader->is_verified = $request->is_verified;

        $trader->save();

        if ($trader) {
            return response()->json(['success' => true, 'message' => 'Trader updated successfully!']);
        } else {
            return response()->json(['success' => false, 'message' => 'Failed to update trader.']);
        }
    }

    // Remove the specified trade from storage
    public function destroy(Trader $trade)
    {
        $trade->delete();

        return redirect()->back()->with('message', 'Trade deleted successfully.');
    }
}
