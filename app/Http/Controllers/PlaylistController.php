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

        $list = $this->playlist->with('item.music')->get();
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $new = $this->playlist->create($input);
        $new->music()->sync(explode(",", $input['singers']));

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
        //
    }

    public function destroy($id)
    {
        //
    }
}