<?php

namespace App\Models\Client;

use App\Models\Client\AssessmentClient;
use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
    protected $table = "assessments";
    protected $guarded = [];

    public function client()
    {
        return $this->hasOne(AssessmentClient::class, 'assessment_id');
    }
}
