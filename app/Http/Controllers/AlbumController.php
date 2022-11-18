<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Album;
use App\Models\Music;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AlbumController extends Controller
{
    public $albums;
    public function __construct()
    {
        $this->albums = new Album();
    }
    public function index()
    {
        return $this->albums->with('music.singer')->with('singer')->get();
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $input['user_id'] = Auth::id();
        if ($request->hasFile('thumbnail')) {
            $image = $request->file('thumbnail');
            $type = $request->file('thumbnail')->extension();
            $fileName = time() . '-albumns.' . $type;
            $path = Storage::disk('local')->put('/public/albumns/' . $fileName, $image->getContent());
            $input['thumbnail'] = 'storage/albumns/' . $fileName;
        }
        $new = $this->albums->create($input);
        Music::whereIn('id', $input['musics'])->where('album_id', 0)->update(['album_id' => $new->id]);
        $new->music;
        return $new;

    }

    public function show($id)
    {
        $show = $this->albums->with('music.singer')->with('singer')->findOrFail($id);

        return $show;
    }

    public function edit($id)
    {
    }

    public function update(Request $request, $id)
    {
        $album = $this->albums->findOrFail($id);
        $input = $request->all();
        $album->update($input);
        Music::whereIn('id', $input['musics'])->where('album_id', 0)->update(['album_id' => $id]);
        return $album;
    }

    public function destroy($id)
    {
        $album = $this->albums->findOrFail($id);

        $updateMusic = Music::where('album_id', $id)->update(['album_id' => NULL]);

        $album->delete();

        return responseSuccess([]);
    }
}
