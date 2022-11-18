<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $table = 'albums';
    protected $guarded= ['id'];

    public function artist(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
