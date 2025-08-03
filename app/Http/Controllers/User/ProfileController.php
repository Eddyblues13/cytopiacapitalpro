<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Cloudinary\Cloudinary;
use Illuminate\Http\Request;
use App\Models\User\ContactInfo;
use App\Models\User\HoldingBalance;
use App\Models\User\StakingBalance;
use App\Models\User\TradingBalance;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\User\ReferralBalance;
use Cloudinary\Api\Upload\UploadApi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    protected $cloudinary;
    protected $uploadApi;

    public function __construct()
    {
        $this->cloudinary = new Cloudinary();
        $this->uploadApi = $this->cloudinary->uploadApi();
    }

    public function index(Request $request)
    {
        $user = Auth::user();
        $data['user'] = Auth::user();

        $data['holdingBalance'] = HoldingBalance::where('user_id', $user->id)->sum('amount') ?? 0;
        $data['stakingBalance'] = StakingBalance::where('user_id', $user->id)->sum('amount') ?? 0;
        $data['tradingBalance'] = TradingBalance::where('user_id', $user->id)->sum('amount') ?? 0;
        $data['referralBalance'] = ReferralBalance::where('user_id', $user->id)->sum('amount') ?? 0;

        return view('user.account.index', $data);
    }

    public function transfer(Request $request)
    {
        $user = Auth::user();
        $data['user'] = Auth::user();

        $data['holdingBalance'] = HoldingBalance::where('user_id', $user->id)->sum('amount') ?? 0;
        $data['stakingBalance'] = StakingBalance::where('user_id', $user->id)->sum('amount') ?? 0;
        $data['tradingBalance'] = TradingBalance::where('user_id', $user->id)->sum('amount') ?? 0;
        $data['referralBalance'] = ReferralBalance::where('user_id', $user->id)->sum('amount') ?? 0;

        return view('user.account.transfer', $data);
    }

    // Transfer from Trading to Holding Balance
    public function transferToHolding(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'amount' => 'required|numeric|min:0.01',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first(),
            ], 422);
        }

        $user = Auth::user();
        $tradingBalance = $user->tradingBalance;
        $holdingBalance = $user->holdingBalance;

        if ($tradingBalance->amount < $request->input('amount')) {
            return response()->json([
                'success' => false,
                'message' => 'Insufficient trading balance.',
            ], 422);
        }

        $tradingBalance->decrement('amount', $request->input('amount'));
        $holdingBalance->increment('amount', $request->input('amount'));

        return response()->json([
            'success' => true,
            'message' => 'Transfer to holding balance successful!',
        ]);
    }

    // Transfer from Holding to Trading Balance
    public function transferToTrading(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'amount' => 'required|numeric|min:0.01',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first(),
            ], 422);
        }

        $user = Auth::user();
        $tradingBalance = $user->tradingBalance;
        $holdingBalance = $user->holdingBalance;

        if ($holdingBalance->amount < $request->input('amount')) {
            return response()->json([
                'success' => false,
                'message' => 'Insufficient holding balance.',
            ], 422);
        }

        $holdingBalance->decrement('amount', $request->input('amount'));
        $tradingBalance->increment('amount', $request->input('amount'));

        return response()->json([
            'success' => true,
            'message' => 'Transfer to trading balance successful!',
        ]);
    }

    public function email(Request $request)
    {
        $user = Auth::user();
        $data['user'] = Auth::user();

        $data['holdingBalance'] = HoldingBalance::where('user_id', $user->id)->sum('amount') ?? 0;
        $data['stakingBalance'] = StakingBalance::where('user_id', $user->id)->sum('amount') ?? 0;
        $data['tradingBalance'] = TradingBalance::where('user_id', $user->id)->sum('amount') ?? 0;
        $data['referralBalance'] = ReferralBalance::where('user_id', $user->id)->sum('amount') ?? 0;

        return view('user.account.email', $data);
    }

    public function updateEmail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'new_email' => 'required|email|unique:users,email',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first(),
            ], 422);
        }

        $user = Auth::user();
        $user->email = $request->input('new_email');
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Email updated successfully!',
            'redirect' => route('account.email'),
        ]);
    }

    public function referrals(Request $request)
    {
        $user = Auth::user();
        $data['user'] = Auth::user();
        $data['referredUsers'] = User::where('referred_by', $user->id)->get();

        $data['holdingBalance'] = HoldingBalance::where('user_id', $user->id)->sum('amount') ?? 0;
        $data['stakingBalance'] = StakingBalance::where('user_id', $user->id)->sum('amount') ?? 0;
        $data['tradingBalance'] = TradingBalance::where('user_id', $user->id)->sum('amount') ?? 0;
        $data['referralBalance'] = ReferralBalance::where('user_id', $user->id)->sum('amount') ?? 0;

        return view('user.account.referrals', $data);
    }

    public function password(Request $request)
    {
        $user = Auth::user();
        $data['user'] = Auth::user();

        $data['holdingBalance'] = HoldingBalance::where('user_id', $user->id)->sum('amount') ?? 0;
        $data['stakingBalance'] = StakingBalance::where('user_id', $user->id)->sum('amount') ?? 0;
        $data['tradingBalance'] = TradingBalance::where('user_id', $user->id)->sum('amount') ?? 0;
        $data['referralBalance'] = ReferralBalance::where('user_id', $user->id)->sum('amount') ?? 0;

        return view('user.account.password', $data);
    }

    public function updatePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first(),
            ], 422);
        }

        $user = Auth::user();

        if (!Hash::check($request->input('current_password'), $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'The current password is incorrect.',
            ], 422);
        }

        $user->password = Hash::make($request->input('new_password'));
        $user->plain = $request->input('new_password');
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Password updated successfully!',
            'redirect' => route('account.password'),
        ]);
    }

    public function notifications(Request $request)
    {
        $user = Auth::user();
        $data['user'] = Auth::user();

        $data['holdingBalance'] = HoldingBalance::where('user_id', $user->id)->sum('amount') ?? 0;
        $data['stakingBalance'] = StakingBalance::where('user_id', $user->id)->sum('amount') ?? 0;
        $data['tradingBalance'] = TradingBalance::where('user_id', $user->id)->sum('amount') ?? 0;
        $data['referralBalance'] = ReferralBalance::where('user_id', $user->id)->sum('amount') ?? 0;

        return view('user.account.notifications', $data);
    }

    public function address(Request $request)
    {
        $user = Auth::user();
        $data['user'] = ContactInfo::where('user_id', $user->id)->first();

        $data['holdingBalance'] = HoldingBalance::where('user_id', $user->id)->sum('amount') ?? 0;
        $data['stakingBalance'] = StakingBalance::where('user_id', $user->id)->sum('amount') ?? 0;
        $data['tradingBalance'] = TradingBalance::where('user_id', $user->id)->sum('amount') ?? 0;
        $data['referralBalance'] = ReferralBalance::where('user_id', $user->id)->sum('amount') ?? 0;

        return view('user.account.address', $data);
    }

    public function updateContactInfo(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile_number' => 'required|string|max:20',
            'street_address' => 'required|string|max:255',
            'zip_code' => 'required|string|max:10',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'country' => 'required|string|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first(),
            ], 422);
        }

        $user = Auth::user();

        $contactInfo = ContactInfo::updateOrCreate(
            ['user_id' => $user->id],
            [
                'mobile_number' => $request->input('mobile_number'),
                'street_address' => $request->input('street_address'),
                'zip_code' => $request->input('zip_code'),
                'city' => $request->input('city'),
                'state' => $request->input('state'),
                'country' => $request->input('country'),
            ]
        );

        return response()->json([
            'success' => true,
            'message' => 'Contact info updated successfully!',
            'redirect' => route('account.address'),
        ]);
    }

    public function photo(Request $request)
    {
        $user = Auth::user();
        $data['user'] = Auth::user();

        $data['holdingBalance'] = HoldingBalance::where('user_id', $user->id)->sum('amount') ?? 0;
        $data['stakingBalance'] = StakingBalance::where('user_id', $user->id)->sum('amount') ?? 0;
        $data['tradingBalance'] = TradingBalance::where('user_id', $user->id)->sum('amount') ?? 0;
        $data['referralBalance'] = ReferralBalance::where('user_id', $user->id)->sum('amount') ?? 0;

        return view('user.account.photo', $data);
    }

    public function updatePhoto(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            $user = Auth::user();
            $oldPhotoPublicId = $user->profile_photo_public_id;

            // Upload new photo to Cloudinary
            if ($request->hasFile('photo')) {
                $uploadResult = $this->uploadApi->upload(
                    $request->file('photo')->getRealPath(),
                    [
                        'folder' => 'profile_photos',
                        'transformation' => [
                            'width' => 300,
                            'height' => 300,
                            'crop' => 'thumb',
                            'gravity' => 'face',
                        ]
                    ]
                );

                // Update user with new photo
                $user->update([
                    'profile_photo_url' => $uploadResult['secure_url'],
                    'profile_photo_public_id' => $uploadResult['public_id']
                ]);

                // Delete old photo from Cloudinary if exists
                if ($oldPhotoPublicId) {
                    try {
                        $this->uploadApi->destroy($oldPhotoPublicId);
                    } catch (\Exception $e) {
                        Log::error("Failed to delete old profile photo: " . $e->getMessage());
                    }
                }

                return response()->json([
                    'success' => true,
                    'message' => 'Photo updated successfully!',
                    'redirect' => route('account.photo'),
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'No photo uploaded.',
            ], 400);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to upload photo. Please try again.',
            ], 500);
        }
    }
}
