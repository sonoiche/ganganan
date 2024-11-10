<?php

namespace App\Models\Client;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Employment extends Model
{
    protected $table = "employments";
    protected $guarded = [];
    protected $appends = ['created_date','employment_date_display'];

    public function getCreatedDateAttribute()
    {
        $created_at = $this->created_at;
        if($created_at) {
            return Carbon::parse($created_at)->format('M. d, Y');
        }

        return '';
    }

    public function getEmploymentDateDisplayAttribute()
    {
        $employment_date = $this->employment_date;
        if($employment_date) {
            return Carbon::parse($employment_date)->format('F Y');
        }

        return '';
    }
}
