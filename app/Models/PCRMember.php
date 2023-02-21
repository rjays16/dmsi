<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\MembershipType;
use App\Enums\OrderStatusEnum;
use App\Enums\OrderTypeEnum;

use App\Models\SpecialtyDivisionMembership;
use App\Models\AffiliateSocietyMemberships;
use App\Models\CollectionFee;

class PCRMember extends Model
{
    use HasFactory, SoftDeletes;
    public $table = "pcr_members";

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'contact_number',
        'reason',
        'email',
        'prc_number',
        'prc_expiration',
        'pma_number',
        'place_of_practice',
        'date_of_birth',
        'address',
        'username',
        'is_trainee',
        'reg_type_id',
        'mem_type_id',
        'spec_div_mem_type',
        'affi_soc_mem_type',
        'affi_soc_other',
        'non_type_id',
        'chapter_id',
        'prc_id',
        'memberships',
        'training_ins',
        'prc_upload',
        'is_declined',
        'balance',
        'is_approved',
        'deposit_slip',
        'in_good_standing',
        'is_active',
        'email_for_active_status_sent',
        'has_requested_cogs'
    ];

    protected $appends = [
        'has_pending_orders',
        'can_generate_cert',
        'spec_div_mem_name',
        'affi_soc_mem_name',
        'can_vote'
    ];

    protected $casts = [
        'in_good_standing' => 'boolean',
        'is_active' => 'boolean',
        'email_for_active_status_sent' => 'boolean',
        'has_requested_cogs' => 'boolean',
    ];
    
    public function getAllPending() {
        $data = self::where('is_approved', 0)
        ->orderBy('last_name', 'asc')
        ->get();

        return $data;
    }

    public function getAllApproved() {
        $data = self::with('user')->where('is_approved', 1)
        ->orderBy('last_name', 'asc')
        ->latest()
        ->paginate(20);

        return $data;
    }
    
    public function user() {
        return $this->morphOne(User::class, 'userable');
    }

    public function pcr_chapter() {
        return $this->belongsTo(PCRChapter::class, 'chapter_id');
    }

    public function membership_type() {
        return $this->belongsTo(MembershipType::class, 'mem_type_id');
    }

    public function specialty_division() {
        return $this->belongsTo(SpecialtyDivisionMembership::class, 'spec_div_mem_type');
    }

    public function affiliate_society() {
        return $this->belongsTo(AffiliateSocietyMemberships::class, 'affi_soc_mem_type');
    }
    
    public function orders() {
        return $this->hasMany(Order::class, 'pcr_member_id');
    }

    public function payments() {
        return $this->hasMany(Payment::class, 'pcr_member_id');
    }

    public function educational_background() {
        return $this->hasOne(EducationalBackground::class, 'pcr_member_id');
    }

    public function getHasPendingOrdersAttribute() {
        $orders = $this->orders;
        $has_pending_orders = false;
        if(!empty($orders)) {
            $pending_orders = $orders->whereIn('status', [OrderStatusEnum::PENDING, OrderStatusEnum::PARTIAL])
                ->first();

            if(!is_null($pending_orders)) {
                $has_pending_orders = true;
            }
        }

        return $has_pending_orders;
    }

    public function getCanGenerateCertAttribute() {
        $orders = $this->orders;
        $can_generate = false;

        if(!empty($orders)) {
            $pending_pma_order = $orders->whereIn('status', [OrderStatusEnum::PENDING, OrderStatusEnum::PARTIAL])
                ->where('type', '<>', OrderTypeEnum::PMA)
                ->first();

            if(is_null($pending_pma_order)) {
                $can_generate = true;
            }
        }

        return $can_generate;
    }

    public function getSpecDivMemNameAttribute() {
        $spec_type = $this->spec_div_mem_type;
        $spec_membership = SpecialtyDivisionMembership::where('id', $spec_type)->first();
        $name = null;

        if(!is_null($spec_membership)) {
            $name = $spec_membership->name;
        }

        return $name;
    }

    public function getAffiSocMemNameAttribute() {
        $affi_type = $this->affi_soc_mem_type;
        $affi_soc_other = $this->affi_soc_other;
        $name = null;

        if(!is_null($affi_soc_other) && $affi_soc_other !== "null") {
            $name = $affi_soc_other;
        } else {
            $affi_membership = AffiliateSocietyMemberships::where('id', $affi_type)->first();
            if(!is_null($affi_membership)) {
                $name = $affi_membership->name;
            }
        }

        return $name;
    }

    public function getCanVoteAttribute() {
        $can_vote = false;
        $orders = $this->orders;
        $payments = $this->payments;
        $membership_fee = CollectionFee::where('description', 'Membership Fee')->first();

        if(is_null($membership_fee)) {
            $can_vote = false;
        } else {
            if($orders->isNotEmpty() && $payments->isNotEmpty()) {
                $order_ids = $orders->pluck('id');

                $pending_membership_orders = Order::whereIn('id', $order_ids)
                    ->where('collection_type_id', $membership_fee->id);
                
                if($pending_membership_orders->get()->isNotEmpty()) {
                    $paid_pending_membership_orders = $pending_membership_orders
                        ->whereHas('payment', function ($query) { 
                            $query->where('status', [OrderStatusEnum::PENDING, OrderStatusEnum::FAILED, OrderStatusEnum::PARTIAL]);
                        })
                        ->get();

                    if($paid_pending_membership_orders->isEmpty()) {
                        $can_vote = true;
                    }
                } else {
                    $can_vote = false;
                }
            }
        }

        return $can_vote;
    }

    public function paidAllCurrentYearFees() {
        $is_active = false;
        $orders = $this->orders;
        $payments = $this->payments;
        $membership_fee = CollectionFee::where('description', 'Membership Fee')->first();

        if(is_null($membership_fee)) {
            $can_vote = false;
        } else {
            if($orders->isNotEmpty() && $payments->isNotEmpty()) {
                $order_ids = $orders->pluck('id');

                $pending_membership_orders = Order::whereIn('id', $order_ids)
                    ->where('collection_type_id', $membership_fee->id);
                
                if($pending_membership_orders->get()->isNotEmpty()) {
                    $paid_pending_membership_orders = $pending_membership_orders
                        ->whereHas('payment', function ($query) { 
                            $query->where('status', [OrderStatusEnum::PENDING, OrderStatusEnum::FAILED, OrderStatusEnum::PARTIAL]);
                        })
                        ->get();

                    if($paid_pending_membership_orders->isEmpty()) {
                        $can_vote = true;
                    }
                } else {
                    $can_vote = false;
                }
            }
        }

        return $can_vote;
    }
}