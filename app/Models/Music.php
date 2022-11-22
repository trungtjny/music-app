<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Music extends Model
{
    use HasFactory, SoftDeletes;

    // protected $fillable  = [
    //     'title',
    //     'user_upload',
    //     'album_id',
    //     'description',
    //     'lyrics',
    //     'thumbnail',
    //     'file_path',
    //     'views',
    //     'time',
    //     'date_of_birth',
    //     'address',
    //     'free'
    // ];
    protected $guarded  = ['id'];
    // lấy thông tin ca sĩ.
    public function singer()
    {
        return $this->belongsToMany(User::class, 'user_music');
    }
    public function album()
    {
        return $this->belongsTo(Album::class,'album_id');
    }
    public function musicView()
    {
        return $this->hasMany(MusicView::class, 'music_id')->whereDate('created_at', '>', Carbon::today()->subDay(28));
    }

    public function topDay()
    {
        return $this->hasMany(MusicView::class, 'music_id')->whereDate('created_at', '>', Carbon::today()->subDay(3));
    }

    public function category()
    {
        return $this->belongsToMany(Category::class, 'category_music');
    }
}
