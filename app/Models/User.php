<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\User\Profit;
use App\Models\User\HoldingBalance;
use App\Models\User\StakingBalance;
use App\Models\User\TradingBalance;
use App\Models\User\ReferralBalance;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone_number',
        'currency',
        'country',
        'city',
        'profile_photo_url',
        'profile_photo_public_id',
        'email_verification',
        'id_verification',
        'address_verification',
        'plain',
        'signal_strength',
        'user_status',
        'top_up_mail',
        'notification_status',
        'network_status',
        'upgrade_status',
        'confirmed_registration_fee',
        'top_up_status',
        'subscription_status',
        'verification_code',
        'verification_expiry',
        'referral_code',
        'referred_by',
        'password',
    ];



    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'verification_expiry' => 'datetime',
            'email_verification' => 'boolean',
            'id_verification' => 'boolean',
            'address_verification' => 'boolean',
            'top_up_mail' => 'boolean',
            'notification_status' => 'boolean',
            'network_status' => 'boolean',
            'upgrade_status' => 'boolean',
            'confirmed_registration_fee' => 'boolean',
            'top_up_status' => 'boolean',
            'subscription_status' => 'boolean',
            'password' => 'hashed',
        ];
    }

    public function holdingBalance()
    {
        return $this->hasOne(HoldingBalance::class);
    }

    public function stakingBalance()
    {
        return $this->hasOne(StakingBalance::class);
    }

    public function tradingBalance()
    {
        return $this->hasOne(TradingBalance::class);
    }

    // Relationship to ReferralBalance
    public function referralBalance()
    {
        return $this->hasOne(ReferralBalance::class);
    }

    // Relationship to Referred Users
    public function referredUsers()
    {
        return $this->hasMany(User::class, 'referred_by');
    }

    public function profitBalance()
    {
        return $this->hasOne(Profit::class);
    }


    public function trades()
    {
        return $this->hasOne(Trade::class);
    }



    // Generate a unique referral code
    public static function generateReferralCode()
    {
        do {
            $code = strtoupper(substr(md5(uniqid()), 0, 8));
        } while (self::where('referral_code', $code)->exists());

        return $code;
    }
}
