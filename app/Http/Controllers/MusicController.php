<?php

namespace App\Http\Controllers;

use App\Exceptions\PermissionNotAllowException;
use App\Models\Album;
use App\Models\Music;
use App\Models\MusicView;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        $data = $this->music->with(['category','singer'])->withCount('musicView')->orderBy('music_view_count', 'desc')->get();

        return $data;
    }

    public function list()
    {
        $data = $this->music->with(['category','singer'])->orderBy('created_at', 'desc')->get();

        return $data;
    }

    public function store(Request $request)
    {
        $input = $request->input();
        $user = Auth::user();
        if(!$user->active) {
            throw new PermissionNotAllowException();
        }
        DB::transaction(function () use ($request, $input) {
            if ($request->hasFile('thumbnail')) {
                $image = $request->file('thumbnail');
                $type = $request->file('thumbnail')->extension();
                $image_name = time() . '-thumbnail.' . $type;
                $path = Storage::disk('local')->put('/public/music/thumbnail/' . $image_name, $image->getContent());
                $input['thumbnail'] = 'storage/music/thumbnail/' . $image_name;
            }
            if ($request->hasFile('music_file')) {
                $image = $request->file('music_file');
                $type = $request->file('music_file')->extension();
                $fileName = time() . '-music.' . $type;
                $path = Storage::disk('local')->put('/public/music/source/' . $fileName, $image->getContent());
                $input['file_path'] = 'storage/music/source/' . $fileName;
            }
    
            $input['user_upload'] = Auth::id();
            $music = $this->music->create($input);
            // $input['singers'] = explode(",", $input['singers']);
            $music->singer()->sync($input['singers']);
            return $music;
        });
    }

    public function show($id)
    {
        $music = $this->music->findOrFail($id);
        $music->views = $music->view + 1;
        MusicView::create(['music_id' => $music->id]);
        $music->save();

        return $music->with(['category','singer']);
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();
        if ($request->hasFile('thumbnail')) {
            $image = $request->file('thumbnail');
            $type = $request->file('thumbnail')->extension();
            $image_name = time() . '-thumbnail.' . $type;
            $path = Storage::disk('local')->put('/public/music/thumbnail/' . $image_name, $image->getContent());
            $input['thumbnail'] = 'storage/music/thumbnail/' . $image_name;
        }
        $music = $this->music->findOrFail($id);
        $music->update($input);
        $music->singer()->sync($input['singers']);
        return $music;
    }

    public function destroy($id)
    {
        return $this->music->findOrFail($id)->delete();
    }

    public function myMusic()
    {
        $userId = Auth::id();
        $music = Music::where('user_upload', $userId)->get();

        return $music;
    }

    public function bestMusic()
    {
        $data = $this->music->with('singer')->withCount('topDay')->orderBy('top_day_count', 'desc')->limit(5)->get();

        return $data;
    }

    public function search(Request $request)
    {
        $key = $request->key;
        $musics = $this->music->where('title' , 'like', '%'.$request->key."%")->with(['category','singer'])->get();
        $list = Role::where('name', 'singer')
            ->with(['users' => function($query)use ($key) {
                $query->where('active', 1)->where('name' , 'like', '%'.$key."%");
            }])->get();
        $users = $list[0]->users;
        $albums = Album::where('name' , 'like', '%'.$request->key."%")->get();

        $data = ['user' => $users, 'musics' =>$musics, 'albums' =>$albums];
        return $data;
    }

    public function listSinger()
    {
        $list = Role::where('name', 'singer')->with(['users' => function($query) {
            $query->where('active', 1);
        }])->get();
        return $list[0]->users;
    }

    public function detailSinger($id) {
        $user = User::with(['music.singer','category'])->findOrFail($id);
        $albums = Album::where('user_id', $id)->with('singer')->with(['music.singer','category']);
        return ['detail' => $user, 'albums' => $albums->get()];
    }
}
