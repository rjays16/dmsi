<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConventionContest extends Model
{
    use HasFactory;
    public $table = "convention_contests";

    protected $fillable = [
        'contest_name',
        'contest_author',
        'convention_year',
        'contest_title',
        'contest_institution',
        'contest_description',
        'contest_pdf',
        'contest_image',
        'contest_rank',
        'contest_type',
        'contest_video'
    ];

    protected $appends = [
        'contest_image_link',
        'contest_pdf_link',
    ];



    public function getContestImageLinkAttribute()
    {
        $image_link = url('/images/noimage.png');
        if ($this->contest_image) {
            $explode_path = explode('/', $this->contest_image);
            unset($explode_path[0]);
            $implode_path = implode('/', $explode_path);
            $image_link = url("storage/" . $implode_path);
            // $image_link = config('app.mem_url') ."storage/" . $implode_path;

        }
        return $image_link;
    }
    public function getContestPdfLinkAttribute()
    {
        $pdf_link = "";
        if ($this->contest_pdf) {
            $explode_path = explode('/', $this->contest_pdf);
            unset($explode_path[0]);
            $implode_path = implode('/', $explode_path);
            $pdf_link = url("storage/" . $implode_path);
            // $pdf_link = config('app.mem_url') ."storage/" . $implode_path;

        }
        return $pdf_link;
    }
}
