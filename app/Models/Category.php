<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable= ['name', 'avatar_path','description'];

    public function music()
    {
        return $this->belongsToMany(Music::class, 'category_music');
    }
}
