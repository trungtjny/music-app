<?php

namespace App\Http\Controllers;

use App\Models\Playlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlaylistController extends Controller
{
    public function __construct()
    {
        $this->playlist = new Playlist();
    }

    public function index()
    {
        $userId = Auth::id();
        $list = $this->playlist->with('music')->get();
        return $list;
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $input['user_id'] = Auth::id();
        $new = $this->playlist->create($input);
        $new->music()->sync($input['musics']);

        return $new;
    }

    public function show($id)
    {
        return $this->playlist->with('music')->findOrFail($id);
    }

    public function edit($id)
    {
    }

    public function update(Request $request, $id)
    {

        $input = $request->all();
        $playlist =  $this->playlist->findOrFail($id);
        $playlist->update($input);
        $playlist->music()->sync($input['musics']);
    }

    public function destroy($id)
    {
        $playlist =  $this->playlist->findOrFail($id);
        $playlist->music()->detach();
        $playlist->delete();
        return true;
    }

    public function change(Request $request)
    {
        $playlist =  $this->playlist->findOrFail($request['playlist_id']);
        if($request->status) {
            $playlist->music()->attach($request->music_id);
        } else {
            $playlist->music()->detach($request->music_id);
        }
        return $playlist->music;
    }
}
