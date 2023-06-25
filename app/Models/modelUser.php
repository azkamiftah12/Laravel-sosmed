<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class modelUser extends Authenticatable
{
    use HasFactory;
    protected $table = 'user';
    protected $primaryKey = 'id_user';
    public $timestamps = true;

    protected $fillable = [
        'username',
        'password',
        'id_role',
    ];

    public function posts()
    {
        return $this->hasMany(modelPost::class, 'id_user');
    }
    public function user_role()
    {
        return $this->hasOne(modelUserRole::class, 'id_user', 'id_user');
    }
    public function role()
    {
        return $this->belongsTo(modelRole::class, 'id_role');
    }

    public function profile()
    {
        return $this->hasOne(modelProfile::class,'id_user');
    }
    public function getProfileAttribute()
    {
        // return $this->belongsTo(MProfile::class, 'id_profile');
        $profile = modelProfile::where('id_user', '=', $this->id_user)->latest()->first();
        return $profile;
    }
}
