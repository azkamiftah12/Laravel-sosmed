<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class modelProfile extends Model
{
    use HasFactory;
    protected $table = 'profile';
    protected $primaryKey = 'id_profile';
    public $timestamps = true;

    protected $fillable = [
        'id_user',
        'nama',
        'alamat',
        'nohp',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

}
