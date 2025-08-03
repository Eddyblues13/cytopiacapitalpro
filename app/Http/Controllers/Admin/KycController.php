<?php

namespace App\Http\Controllers\Admin;

use App\Models\Document;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KycController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $kycs = Document::with('user')->get();
        return view('admin.kyc.index', compact('kycs'));
    }

    public function show($id)
    {
        $kyc = Document::with('user')->findOrFail($id);
        return view('admin.kyc.show', compact('kyc'));
    }

    public function approve($id)
    {
        $kyc = Document::findOrFail($id);
        $kyc->status = 'approved';
        $kyc->save();

        return redirect()->route('kyc.index')->with('success', 'KYC Approved');
    }

    public function destroy($id)
    {
        $kyc = Document::findOrFail($id);
        $kyc->delete();

        return redirect()->route('kyc.index')->with('success', 'KYC Deleted');
    }
}
