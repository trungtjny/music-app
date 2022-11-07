<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ablum extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'user_id'];

    public function music()
    {
        return $this->hasMany(Music::class, 'album_id');
    }
}
