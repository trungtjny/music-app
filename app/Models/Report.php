<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $table = 'reports';
    // protected $fillable= ['name', 'avatar_path','description'];
    protected $guarded= ['id'];


    public function user()
    {
     return $this->belongsTo(User::class, 'user_id');

    }
    public function music()
    {
        return $this->belongsTo(Music::class,'music_id')->withTrashed();
    }
}
