<?php

namespace App\Models\Client;

use Illuminate\Database\Eloquent\Model;

class UserSkill extends Model
{
    protected $table = "user_skills";
    protected $guarded = [];
    protected $appends = ['array_skills'];

    public function getArraySkillsAttribute()
    {
        $skills = str_replace("'","",$this->skills);
        if($skills) {
            return explode(',', $skills);
        }

        return '';
    }
}
