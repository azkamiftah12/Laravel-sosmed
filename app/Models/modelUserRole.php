<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class modelUserRole extends Model
{
    use HasFactory;

    protected $table = 'user_role';
    protected $primaryKey = 'id_userrole';
    public $timestamps = true;

    protected $fillable = [
        'id_user',
        'id_role',
    ];

    public function role()
    {
        return $this->belongsTo(modelRole::class, 'id_role');
    }

    public function user()
    {
        return $this->belongsTo(modelUser::class, 'id_user');
    }
}
