<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Traits\StorageFileTrait;
use Illuminate\Support\Facades\File;
class CategoryController extends Controller
{
    use StorageFileTrait;
    private $category;

    public function __construct()
    {
        $this->category = new Category; 
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = $this->category->all();
        return view('admin-views.pages.manage.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin-views.pages.manage.categories.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        try {
           
            $categoryMapping = [
                'name' => $request->name,
                'description' => $request->description,
            ];
            
    
            $avatarImageUploaded = $this->storageFileUpload($request, 'avatar_path', 'admin-page/images/categories/' . Str::Slug($request->name) . '/avatar');
            if (!empty($avatarImageUploaded)) {
                $categoryMapping['avatar_path'] = $avatarImageUploaded['file_path'];
                
            }
            $categoryCreated = $this->category->create($categoryMapping);
            return redirect()->route('categories.index')->with('success','Thêm mới danh mục thành công!');
            
          
          } catch (\Exception $e) {
                return redirect()->route('categories.index')->with('error','Thêm mới danh mục thất bại! Đã xảy ra lỗi');
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
            $category = $this->category->find($id);
            return view('admin-views.pages.manage.categories.edit',compact('category'));
        } catch (\Exception $e) {
            return redirect()->route('categories.index')->with('error','Không tìm thấy danh mục');
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
         //
         try {
            $categoryOnUpdated = $this->category->find($id);

            $categoryAvatarDirectory = 'storage/admin-page/images/categories/' . Str::slug($categoryOnUpdated->name) .'/avatar'; 
    
            $categoryMapping = [
                'name' => $request->name,
                'description' => $request->description,
            ];
            $avatarImageUploaded = $this->storageFileUpload($request, 'avatar_path', 'admin-page/images/categories/' . Str::slug($request->name) . '/avatar');
            if (!empty($avatarImageUploaded)) {
               
                $categoryMapping['avatar_path'] = $avatarImageUploaded['file_path'];
            }
            $categoryOnUpdated->update($categoryMapping);
    
            return redirect()->route('categories.index')->with('success','Cập nhật danh mục thành công!');
        } catch (\Exception $e) {
            return redirect()->route('categories.index')->with('error','Cập nhật danh mục thất bại! Có lỗi xảy ra');
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
        //

        try {
            //code...
            $categoryOnDeleted = $this->category->find($id);

            $categoryAvatarDirectory = 'storage/admin-page/images/categories/' . Str::slug($categoryOnDeleted->name) . '/avatar'; 
            
        
            if(File::exists($categoryAvatarDirectory)){
                File::deleteDirectory(public_path($categoryAvatarDirectory));
            }
            $categoryOnDeleted->delete();
            return redirect()->route('categories.index')->with('success', 'Xóa danh mục thành công!');
        } catch (\Exception $e) {
            //throw $th;
            return redirect()->route('categories.index')->with('error', 'Xóa danh mục thất bại! Đã xảy ra lỗi');
        }
    }
}
