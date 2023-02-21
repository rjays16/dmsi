<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EducationalBackground extends Model
{
    use SoftDeletes;
    public $table = "educational_background";

    protected $fillable = [
        'pcr_member_id',
        'medicine',
        'med_graduation',
        'residency',
        'res_graduation',
        'specialty',
        'spec_graduation',
        'specialty_society',
        'specialty_society_graduation',
        'subspecialty',
        'subspecialty_society',
        'subspecialty_society_induction',
        'master_education',
        'master_education_school'
    ];

    public function pcr_member() {
        return $this->belongsTo(PCRMember::class, 'pcr_member_id');
    }
}