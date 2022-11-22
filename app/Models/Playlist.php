<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Playlist extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'user_id'];

    public function item()
    {
        return $this->hasMany(PlaylistItem::class, 'playlist_id');
    }

    public function music()
    {
        return $this->belongsToMany(Music::class, 'playlist_items');
    }
}
