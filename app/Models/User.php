<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

// use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    const REFERRAL_LEVEL_LIMIT = 3;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // protected $fillable = [
    //     'id',
    //     'username',
    //     'email',
    //     'password',
    //     'firstname',
    //     'lastname',
    //     'phone_number',
    //     'timezone',
    // ];

    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function scopeActive(){
        return $this->find(auth()->id());
    }
    public function deposits(): HasMany {
        return $this->hasMany(Deposit::class);
    }

    public function transactions(): HasMany {
        return $this->hasMany(Transaction::class);
    }

    public function withdrawals(): HasMany {
        return $this->hasMany(Withdrawal::class);
    }

    public function earnings(): HasMany {
        return $this->hasMany(Earning::class);
    }


    public function taskHalls(): HasMany {
        return $this->hasMany(TaskHall::class);
    }

    public function taskEarnings(): HasMany {
        return $this->hasMany(TaskEarning::class);
    }

    public function referralBonuses(): HasMany {
        return $this->hasMany(ReferralBonus::class);
    }

    public function level(): BelongsTo {
        return $this->belongsTo(Level::class, 'level_id');
    }

    public function bankDetails(): HasMany {
        return $this->hasMany(BankDetail::class);
    }

    public function bankDetail(): HasOne {
        return $this->hasOne(BankDetail::class, );
    }

    public function referrals(): HasMany {
        return $this->hasMany(Referral::class, 'user_id');
    }

    public function referee(): HasOne {
        return $this->hasOne(Referral::class, 'referred_user_id');
    }

    public function getReferralLinkAttribute(){
        return Str::wrap("/register/", request()->getSchemeAndHttpHost(), $this->username);
    }

    public function getReferralTurnoverAttribute(){
        $referralIds = $this->referrals()->pluck('referred_user_id');

        return User::whereIn('id', $referralIds)->sum('total_earned');            
    }
}
