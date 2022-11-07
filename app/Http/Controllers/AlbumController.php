<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ablum;
use App\Models\Music;

class AlbumController extends Controller
{
    public $albums;
    public function __construct()
    {
        $this->albums = new Ablum();
    }
    public function index()
    {
        return $this->albums->get();
    }

    
    public function create()
    {
        
    }

    public function store(Request $request)
    {
        $input = $request->all();

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
