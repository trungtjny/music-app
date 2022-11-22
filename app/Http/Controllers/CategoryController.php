<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private $category;

    public function __construct()
    {
        $this->category = new Category();
    }

    public function index() {
        $list = $this->category->with('music.singer')->orderBy('created_at', 'desc')->get();

        return $list;
    }
    public function list() {
        $list = $this->category->get();

        return $list;
    }

    public function show($id) {
        $cate = $this->category->with('music.singer')->findOrFail($id);
        return $cate;
    }
}
