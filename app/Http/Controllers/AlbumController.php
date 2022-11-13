<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Album;
use App\Models\Music;
use Illuminate\Support\Facades\Auth;

class AlbumController extends Controller
{
    public $albums;
    public function __construct()
    {
        $this->albums = new Album();
    }
    public function index()
    {
        return $this->albums->where('id', '>', 0)->with('music')->get();
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $input['user_id'] = Auth::id();
        $new = $this->albums->create($input);
        return $new;
    }

    public function show($id)
    {
        $show = $this->albums->with('music')->findOrFail($id);

        return $show;
    }

    public function edit($id)
    {
    }

    public function update(Request $request, $id)
    {
        $album = $this->albums->findOrFail($id);

        $res = $album->update($request->all());

        return $res;
    }

    public function destroy($id)
    {
        $album = $this->albums->findOrFail($id);

        $updateMusic = Music::where('album_id', $id)->update(['album_id' => NULL]);

        $album->delete();

        return responseSuccess([]);
    }
}
