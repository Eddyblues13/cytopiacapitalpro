<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Models\User\HoldingBalance;
use App\Models\User\StakingBalance;
use App\Models\User\TradingBalance;
use App\Http\Controllers\Controller;
use App\Models\IdentityVerification;
use App\Models\User\ContactInfo;
use App\Models\User\ReferralBalance;
use Illuminate\Support\Facades\Auth;
use Cloudinary\Cloudinary;
use Cloudinary\Api\Upload\UploadApi;

class VerificationController extends Controller
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

        $data['email_verification'] = $user->email_verification;
        $data['id_verification'] = $user->id_verification;
        $data['address_verification'] = $user->address_verification;

        return view('user.verification.index', $data);
    }

    public function identity(Request $request)
    {
        $user = Auth::user();
        $data['user'] = Auth::user();

        $data['holdingBalance'] = HoldingBalance::where('user_id', $user->id)->sum('amount') ?? 0;
        $data['stakingBalance'] = StakingBalance::where('user_id', $user->id)->sum('amount') ?? 0;
        $data['tradingBalance'] = TradingBalance::where('user_id', $user->id)->sum('amount') ?? 0;
        $data['referralBalance'] = ReferralBalance::where('user_id', $user->id)->sum('amount') ?? 0;

        $data['email_verification'] = $user->email_verification;
        $data['id_verification'] = $user->id_verification;
        $data['address_verification'] = $user->address_verification;

        return view('user.verification.id_verification', $data);
    }

    public function identityVerify(Request $request)
    {
        $request->validate([
            'front_photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'back_photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user = Auth::user();

        // Check if user already has a pending or approved verification
        $existingVerification = IdentityVerification::where('user_id', $user->id)
            ->whereIn('status', ['pending', 'approved'])
            ->first();

        if ($existingVerification) {
            return response()->json([
                'success' => false,
                'message' => 'You already have a verification request that is pending or approved.'
            ], 422);
        }

        try {
            // Handle front photo upload to Cloudinary
            $frontPhotoUrl = null;
            $frontPhotoPublicId = null;
            if ($request->hasFile('front_photo')) {
                $uploadResult = $this->uploadApi->upload(
                    $request->file('front_photo')->getRealPath(),
                    [
                        'folder' => 'identity_verifications',
                        'transformation' => [
                            'width' => 800,
                            'height' => 600,
                            'crop' => 'limit'
                        ]
                    ]
                );
                $frontPhotoUrl = $uploadResult['secure_url'];
                $frontPhotoPublicId = $uploadResult['public_id'];
            }

            // Handle back photo upload to Cloudinary
            $backPhotoUrl = null;
            $backPhotoPublicId = null;
            if ($request->hasFile('back_photo')) {
                $uploadResult = $this->uploadApi->upload(
                    $request->file('back_photo')->getRealPath(),
                    [
                        'folder' => 'identity_verifications',
                        'transformation' => [
                            'width' => 800,
                            'height' => 600,
                            'crop' => 'limit'
                        ]
                    ]
                );
                $backPhotoUrl = $uploadResult['secure_url'];
                $backPhotoPublicId = $uploadResult['public_id'];
            }

            // Create the verification record
            $verification = IdentityVerification::create([
                'user_id' => $user->id,
                'front_photo_url' => $frontPhotoUrl,
                'front_photo_public_id' => $frontPhotoPublicId,
                'back_photo_url' => $backPhotoUrl,
                'back_photo_public_id' => $backPhotoPublicId,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Identity verification submitted successfully. It will be reviewed shortly.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to upload verification documents. Please try again.'
            ], 500);
        }
    }

    public function address(Request $request)
    {
        $user = Auth::user();
        $data['user'] = Auth::user();

        $data['holdingBalance'] = HoldingBalance::where('user_id', $user->id)->sum('amount') ?? 0;
        $data['stakingBalance'] = StakingBalance::where('user_id', $user->id)->sum('amount') ?? 0;
        $data['tradingBalance'] = TradingBalance::where('user_id', $user->id)->sum('amount') ?? 0;
        $data['referralBalance'] = ReferralBalance::where('user_id', $user->id)->sum('amount') ?? 0;

        $data['email_verification'] = $user->email_verification;
        $data['id_verification'] = $user->id_verification;
        $data['address_verification'] = $user->address_verification;

        return view('user.verification.address_verification', $data);
    }

    public function addressVerify(Request $request)
    {
        $request->validate([
            'utility_bill' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user = Auth::user();

        // Check if user already has a verification
        $existingVerification = ContactInfo::where('user_id', $user->id)->first();

        if ($existingVerification) {
            return response()->json([
                'success' => false,
                'message' => 'You already have an address verification on file.'
            ], 422);
        }

        try {
            // Handle utility bill upload to Cloudinary
            $utilityBillUrl = null;
            $utilityBillPublicId = null;
            if ($request->hasFile('utility_bill')) {
                $uploadResult = $this->uploadApi->upload(
                    $request->file('utility_bill')->getRealPath(),
                    [
                        'folder' => 'address_verifications',
                        'transformation' => [
                            'width' => 800,
                            'height' => 600,
                            'crop' => 'limit'
                        ]
                    ]
                );
                $utilityBillUrl = $uploadResult['secure_url'];
                $utilityBillPublicId = $uploadResult['public_id'];
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Utility bill file is required.'
                ], 422);
            }

            // Create the verification record
            $verification = ContactInfo::create([
                'user_id' => $user->id,
                'mobile_number' => $request->mobile_number ?? null,
                'street_address' => $request->street_address ?? null,
                'zip_code' => $request->zip_code ?? null,
                'city' => $user->city ?? null,
                'state' => $user->state ?? null,
                'country' => $user->country ?? null,
                'utility_bill_url' => $utilityBillUrl,
                'utility_bill_public_id' => $utilityBillPublicId, 
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Address verification submitted successfully. It will be reviewed shortly.',
                'data' => $verification
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to upload address verification document. Please try again.'
            ], 500);
        }
    }
}
