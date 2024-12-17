<?php

namespace App\Models\Client;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = "reviews";
    protected $guarded = [];
    protected $appends = ['created_date'];

    public function getCreatedDateAttribute()
    {
        return Carbon::parse($this->created_at)->format('d M, Y');
    }

    public function employer()
    {
        return $this->belongsTo(User::class, 'employer_id');
    }
}
