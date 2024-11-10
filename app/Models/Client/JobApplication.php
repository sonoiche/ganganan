<?php

namespace App\Models\Client;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    protected $table = "job_applications";
    protected $guarded = [];
    protected $appends = ['created_date'];

    public function getCreatedDateAttribute()
    {
        $created_at = $this->created_at;
        if($created_at) {
            return Carbon::parse($created_at)->format('M. d, Y');
        }

        return '';
    }
}
