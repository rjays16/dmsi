<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Auth\Events\Verified;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'password',
        'first_name',
        'last_name',
        'role',
        'profile_pic',
        'userable_type',
        'userable_id',
        'profile_pic',
        'tag_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function userable() {
        return $this->morphTo();
    }

    public function tag() {
        return $this->hasOne(Tag::class, 'tag_id');
    }

    public function deposit_slips() {
        return $this->hasMany(DepositSlip::class, 'user_id');
    }

    public function member() {
        return $this->belongsTo(PCRMember::class, 'userable_id');
    }
}
