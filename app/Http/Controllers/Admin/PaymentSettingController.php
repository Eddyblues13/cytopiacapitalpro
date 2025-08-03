<?php

namespace App\Http\Controllers\Admin;

use App\Models\WalletOption;
use Illuminate\Http\Request;
use App\Models\PaymentSetting;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class PaymentSettingController extends Controller
{
    public function index()
    {
        $payments = WalletOption::all();
        return view('admin.payments.index', compact('payments'));
    }

    public function create()
    {
        return view('admin.payments.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'coin_code' => 'required|string|max:10',
            'coin_name' => 'required|string|max:100',
            'wallet_name' => 'required|string|max:100',
            'wallet_type' => 'required|string|max:50',
            'network_type' => 'required|string|max:50',
            'wallet_address' => 'required|string|max:255',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|in:enabled,disabled',
        ]);

        $data = $request->except('icon');

        if ($request->hasFile('icon')) {
            $data['icon'] = $request->file('icon')->store('payment-icons', 'public');
        }

        WalletOption::create($data);

        return redirect()->route('payment.index')
            ->with('message', 'Payment method created successfully');
    }

    public function edit($id)
    {
        $payment = WalletOption::findOrFail($id);
        return view('admin.payments.edit', compact('payment'));
    }

    public function update(Request $request, $id)
    {
        $payment = WalletOption::findOrFail($id);

        $request->validate([
            'coin_code' => 'required|string|max:10',
            'coin_name' => 'required|string|max:100',
            'wallet_name' => 'required|string|max:100',
            'wallet_type' => 'required|string|max:50',
            'network_type' => 'required|string|max:50',
            'wallet_address' => 'required|string|max:255',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|in:enabled,disabled',
        ]);

        $data = $request->except('icon');

        if ($request->hasFile('icon')) {
            // Delete old icon if exists
            if ($payment->icon) {
                Storage::disk('public')->delete($payment->icon);
            }
            $data['icon'] = $request->file('icon')->store('payment-icons', 'public');
        }

        $payment->update($data);

        return redirect()->route('payment.index')
            ->with('message', 'Payment method updated successfully');
    }

    public function destroy($id)
    {
        $payment = WalletOption::findOrFail($id);

        // Don't allow deletion of default payment methods
        if (in_array($payment->wallet_name, ['Ethereum', 'Bitcoin', 'Litecoin'])) {
            return redirect()->route('payment.index')
                ->with('error', 'Default payment methods cannot be deleted');
        }

        // Delete icon if exists
        if ($payment->icon) {
            Storage::disk('public')->delete($payment->icon);
        }

        $payment->delete();

        return redirect()->route('payment.index')
            ->with('message', 'Payment method deleted successfully');
    }
}
