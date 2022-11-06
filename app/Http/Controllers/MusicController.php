<?php

namespace App\Http\Controllers;

use App\Models\Music;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MusicController extends Controller
{
    public $music;

    public function __construct()
    {
        $this->music = new Music();
    }

    public function index()
    {

        $data = $this->music->withCount('musicView')->orderBy('music_view_count', 'desc')->get();

        return $data;
    }

    public function store(Request $request)
    {
        $input = $request->input();
        if ($request->hasFile('thumbnail')) {
            $image = $request->file('thumbnail');
            $type = $request->file('thumbnail')->extension();
            $image_name = time() . '-thumbnail.' . $type;
            $path = Storage::disk('local')->put('/public/music/thumbnail/' . $image_name, $image->getContent());
            $input['thumbnail'] = 'storage/music/thumbnail' . $image_name;
        }
        if ($request->hasFile('music_file')) {
            $image = $request->file('music_file');
            $type = $request->file('music_file')->extension();
            $fileName = time() . '-music.' . $type;
            $path = Storage::disk('local')->put('/public/music/source/' . $fileName, $image->getContent());
            $input['file_path'] = 'storage/music/thumbnail' . $fileName;
        }

        $input['user_upload'] = Auth::id();
        $music = $this->music->create($input);
        $input['singers'] = explode(",", $input['singers']);
        $music->singer()->sync($input['singers']);
        return $music;
    }

    public function show($id)
    {
        $music = $this->music->findOrFail($id);
        $music->views = $music->view + 1;

        return $music;
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();
        if ($request->hasFile('thumbnail')) {
            $image = $request->file('thumbnail');
            $type = $request->file('thumbnail')->extension();
            $image_name = time() . '-thumbnail.' . $type;
            $path = Storage::disk('local')->put('/public/music/thumbnail/' . $image_name, $image->getContent());
            $input['thumbnail'] = 'storage/music/thumbnail' . $image_name;
        }
        $music = $this->music->findOrFail($id);
        $music->update($input);
        $input['singers'] = explode(",", $input['singers']);
        $music->singer()->sync($input['singers']);
        return $music;
    }

    public function destroy($id)
    {
        return $this->music->findOrFail($id)->delete();
    }
}
