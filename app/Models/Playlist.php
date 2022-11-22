<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Playlist extends Model
{
    use HasFactory;

<<<<<<< HEAD
    protected $fillable = ['name', 'description', 'user_id'];
=======
    protected $guarded = ['id'];
>>>>>>> 4d35dad9584314dab896d57d20f5935c28e6e3ec

    public function item()
    {
        return $this->hasMany(PlaylistItem::class, 'playlist_id');
    }

    public function music()
    {
        return $this->belongsToMany(Music::class, 'playlist_items');
    }
}
