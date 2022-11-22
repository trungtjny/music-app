<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\Music;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\StorageFileTrait;
use Illuminate\Support\Str;
class MusicController extends Controller
{
    use StorageFileTrait;
    private $album;
    private $user;
    private $role;
    private $music;
    public function __construct()
    {
        $this->album = new Album; 
        $this->user = new User; 
        $this->role = new Role;
        $this->music = new Music;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $musics = $this->music->all();
        return view('admin-views.pages.manage.musics.index', compact('musics'));
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        try {
            $music = $this->music->find($id);
            $albums = $this->album->all();
            $artists = $this->role->where('name', 'singer')->first()->users()->get();
            return view('admin-views.pages.manage.musics.edit',compact('music','artists','albums'));
        } catch (\Exception $e) {
            return redirect()->route('albums.index')->with('error','Không tìm thấy album');
          
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

        try {
            $musicOnUpdated = $this->music->find($id);

          
    
            $musicMapping = [
                'title' => $request->title,
                'album_id' => $request->album_id,
                'description' => $request->description,
                'lyrics' => $request->lyrics,
                'is_recommended' => $request->is_recommended,
                'free' => $request->free,
            ];
            $avatarImageUploaded = $this->storageFileUpload($request, 'thumbnail', 'admin-page/images/musics/' . Str::slug($request->title) . '/avatar');
            if (!empty($avatarImageUploaded)) {
               
                $musicMapping['thumbnail'] = $avatarImageUploaded['file_path'];
            }
            $musicOnUpdated->update($musicMapping);
            $musicOnUpdated->singer()->sync($request->artist_id);
            return redirect()->route('admin.musics.index')->with('success','Cập nhật bài hát thành công!');
        } catch (\Exception $e) {
            return redirect()->route('admin.musics.index')->with('error','Cập nhật bài hát thất bại! Có lỗi xảy ra');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
