<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class modelPost extends Model
{
    use HasFactory;
    protected $table = 'post';
    protected $primaryKey = 'id_post';
    public $timestamps = true;

    protected $fillable = [
        'id_user',
        'title',
        'picture',
    ];

    public function user()
    {
        return $this->belongsTo(modelUser::class, 'id_user');
    }
}
