<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    public $table = "registrations";

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'reason',
        'contact_number',
        'prc_number',
        'address',
        'username',
        'reg_type_id',
        'mem_type_id',
        'non_type_id',
        'chapter_id',
        'pcr_id',
        'memberships',
        'prc_upload',
        'email',
        'country',
        'state',
        'city',
        'zip_code',
        'payment_file_path',
        'prefix_name',
        'suffix_name',
        'is_declined'
    ];

    protected $hidden = [
        'last_login'
    ];

    public function user() {
        return $this->morphOne(User::class, 'userable');
    }

    public function registration_type() {
        return $this->hasOne(RegistrationType::class);
    }

    public function membership_type() {
        return $this->hasOne(MembershipType::class);
    }

    public function non_membership_type() {
        return $this->hasOne(NonMembershipType::class);
    }
    
    public function pcr_chapter() {
        return $this->hasOne(PCRChapter::class);
    }

    public function prc_number() {
        return $this->hasOne(PRCNumber::class);
    }

    public function getAllPending() {
        $data = self::where('is_approved', 0)
        ->orderBy('last_name', 'asc')
        ->get();

        return $data;
    }

    public function getAllApproved() {
        $data = self::where('is_approved', 1)
        ->orderBy('last_name', 'asc')
        ->latest()
        ->paginate(20);

        return $data;
    }
}
