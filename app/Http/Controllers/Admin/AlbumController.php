<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Traits\StorageFileTrait;
use Illuminate\Support\Facades\File;

class AlbumController extends Controller
{
    use StorageFileTrait;
    private $album;
    private $user;
    private $role;
    public function __construct()
    {
        $this->album = new Album; 
        $this->user = new User; 
        $this->role = new Role;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $albums = $this->album->all();
        return view('admin-views.pages.manage.albums.index', compact('albums'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $artists = $this->role->where('name', 'singer')->first()->users()->get();
        return view('admin-views.pages.manage.albums.add',compact('artists'));
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
        try {
           
            $albumMapping = [
                'name' => $request->name,
                'user_id' => $request->user_id,
                'description' => $request->description,
            ];
            
    
            $avatarImageUploaded = $this->storageFileUpload($request, 'avatar_path', 'admin-page/images/albums/' . Str::Slug($request->name) . '/avatar');
            if (!empty($avatarImageUploaded)) {
                $albumMapping['thumbnail'] = $avatarImageUploaded['file_path'];
                
            }
            $categoryCreated = $this->album->create($albumMapping);
            return redirect()->route('albums.index')->with('success','Th??m m???i Album th??nh c??ng!');
            
          
          } catch (\Exception $e) {
                return redirect()->route('albums.index')->with('error','Th??m m???i Album th???t b???i! ???? x???y ra l???i');
          }
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
        try {
            $album = $this->album->find($id);
            $artists = $this->role->where('name', 'singer')->first()->users()->get();
            return view('admin-views.pages.manage.albums.edit',compact('album','artists'));
        } catch (\Exception $e) {
            return redirect()->route('albums.index')->with('error','Kh??ng t??m th???y album');
          
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
            $albumOnUpdated = $this->album->find($id);

            $albumAvatarDirectory = 'storage/admin-page/images/albums/' . Str::slug($albumOnUpdated->name) .'/avatar'; 
    
            $albumMapping = [
                'name' => $request->name,
                'user_id' => $request->user_id,
                'description' => $request->description,
            ];
            $avatarImageUploaded = $this->storageFileUpload($request, 'avatar_path', 'admin-page/images/albums/' . Str::slug($request->name) . '/avatar');
            if (!empty($avatarImageUploaded)) {
               
                $albumMapping['thumbnail'] = $avatarImageUploaded['file_path'];
            }
            $albumOnUpdated->update($albumMapping);
    
            return redirect()->route('albums.index')->with('success','C???p nh???t album th??nh c??ng!');
        } catch (\Exception $e) {
            return redirect()->route('albums.index')->with('error','C???p nh???t album th???t b???i! C?? l???i x???y ra');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        try {
            //code...
            $albumOnDeleted = $this->album->find($id);

            $albumAvatarDirectory = 'storage/admin-page/images/albums/' . Str::slug($albumOnDeleted->name) . '/avatar'; 
            
        
            if(File::exists($albumAvatarDirectory)){
                File::deleteDirectory(public_path($albumAvatarDirectory));
            }
            $albumOnDeleted->delete();
            return redirect()->route('albums.index')->with('success', 'X??a album th??nh c??ng!');
        } catch (\Exception $e) {
            //throw $th;
            return redirect()->route('albums.index')->with('error', 'X??a album th???t b???i! ???? x???y ra l???i');
        }
    }
}
