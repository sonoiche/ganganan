<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\Client\UserSkill;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    protected $appends = ['fullname','display_photo','role_menu','created_date_time', 'created_date','complete_address'];

    public function getFullnameAttribute()
    {
        $fname = $this->fname ?? '';
        $lname = $this->lname ?? '';

        if($fname && $lname) {
            return $fname . ' ' . $lname;
        }

        return '';
    }

    public function getDisplayPhotoAttribute()
    {
        $photo = $this->photo ?? '';
        if($photo) {
            return url($photo);
        }

        return 'https://ui-avatars.com/api/?name=' .$this->fullname. '&background=random';
    }

    public function getRoleMenuAttribute()
    {
        $role = $this->role ?? '';
        if($role) {
            return strtolower($role);
        }

        return '';
    }

    public function getCreatedDateTimeAttribute()
    {
        $created_at = $this->created_at;
        if($created_at) {
            return Carbon::parse($created_at)->format('F d, Y H:i A');
        }

        return '';
    }

    public function getCreatedDateAttribute()
    {
        $created_at = $this->created_at;
        if($created_at) {
            return Carbon::parse($created_at)->format('M. d, Y');
        }

        return '';
    }

    public function getCompleteAddressAttribute()
    {
        $address    = $this->address;
        $city       = $this->city;
        $zip_code   = $this->zip_code;

        if($address) {
            return $address . ' ' . $city . ' ' . $zip_code;
        }
    }

    public function user_skill()
    {
        return $this->hasOne(UserSkill::class, 'user_id');
    }

    public function skillDisplay($id)
    {
        $skill = Skill::find($id);
        return $skill->name;
    }
}
