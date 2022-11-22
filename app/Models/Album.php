<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{

    use HasFactory;
    protected $table = 'albums';
    protected $guarded= ['id'];

    public function artist(){
        return $this->belongsTo(User::class, 'user_id');
    }

    // protected $fillable = ['name', 'user_id', 'thumbnail'];

    public function music()
    {
        return $this->hasMany(Music::class, 'album_id');
    }
    public function singer()
    {
        return $this->hasOne(User::class,'id','user_id');

    }
}
