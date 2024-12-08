<?php

namespace App\Models\Client;

use Carbon\Carbon;
use App\Models\Client\Payment;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $table = "subscriptions";
    protected $guarded = [];
    protected $appends = ['created_date','valid_until_date'];

    public function getCreatedDateAttribute()
    {
        return Carbon::parse($this->created_at)->format('d M, Y');
    }

    public function getValidUntilDateAttribute()
    {
        return Carbon::parse($this->valid_until)->format('d M, Y');
    }

    public function payment()
    {
        return $this->hasOne(Payment::class, 'subscription_id');
    }
}
