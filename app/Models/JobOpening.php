<?php

namespace App\Models;

use App\Models\Client\JobApplication;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class JobOpening extends Model
{
    protected $table = "job_openings";
    protected $guarded = [];
    protected $appends = ['display_photo','created_date','date_until_display','array_skills'];

    public function getDisplayPhotoAttribute()
    {
        $photo = $this->photo ?? '';
        if($photo) {
            return url($photo);
        }

        return 'https://ui-avatars.com/api/?name=No+Photo&background=random';
    }

    public function getCreatedDateAttribute()
    {
        $created_at = $this->created_at;
        if($created_at) {
            return Carbon::parse($created_at)->format('F d, Y');
        }

        return '';
    }

    public function getDateUntilDisplayAttribute()
    {
        $date_until = $this->date_until;
        if($date_until) {
            return Carbon::parse($date_until)->format('F d, Y');
        }

        return '';
    }

    public function getArraySkillsAttribute()
    {
        $skills = str_replace("'","",$this->skills);
        if ($skills) {
            return explode(',', $skills);
        }

        return [];
    }

    public function employer()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function applications()
    {
        return $this->hasMany(JobApplication::class, 'job_id');
    }
}
