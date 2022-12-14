<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\Category;
use App\Models\Music;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class AnalizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $album;
    private $user;
    private $role;
    private $music;
    private $category;

    public function __construct()
    {
        $this->album = new Album; 
        $this->user = new User; 
        $this->role = new Role;
        $this->music = new Music;
        $this->category = new Category;
    }
    public function index()
    {
        //
        $totalAlbum = $this->album->count();
        $totalMusic = $this->music->count();
        $totalCategory = $this->category->count();
        $totalUser = $this->user->count();


        $top5MostViewAll = $this->music->orderBy('views','DESC')->limit(5)->get();
        
        $top5MostViewDay = $this->music->with('singer')->withCount('topDay')->orderBy('top_day_count', 'desc')->limit(5)->get();
        
        return view('admin-views.pages.analize.index',compact('totalUser','totalMusic','totalCategory','totalAlbum','top5MostViewAll','top5MostViewDay'));
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
