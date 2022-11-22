<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\Music;
use App\Models\Report;
use App\Models\User;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    private $album;
    private $user;
    private $music;
    private $report;

    public function __construct()
    {
        $this->album = new Album; 
        $this->user = new User; 
        $this->music = new Music;
        $this->report = new Report;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $reports = $this->report->all();
        return view('admin-views.pages.manage.reports.index', compact('reports'));
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
            $report = $this->report->find($id);
            return view('admin-views.pages.manage.reports.edit',compact('report'));
        } catch (\Exception $e) {
            return redirect()->route('admin.reports.index')->with('error','Không tìm thấy danh mục');
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
            $reportOnUpdated = $this->report->find($id);

         
    
            $reportMapping = [
                'status' => $request->status,
               
            ];
          
            $reportOnUpdated->update($reportMapping);
    
            return redirect()->route('admin.reports.index')->with('success','Cập nhật báo cáo thành công!');
        } catch (\Exception $e) {
            return redirect()->route('admin.reports.index')->with('error','Cập nhật báo cáo thất bại! Có lỗi xảy ra');
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
            $reportOnDeleted = $this->report->find($id);

         
            
        
        
            $reportOnDeleted->delete();
            return redirect()->route('admin.reports.index')->with('success', 'Xóa báo cáo thành công!');
        } catch (\Exception $e) {
            //throw $th;
            return redirect()->route('admin.reports.index')->with('error', 'Xóa báo cáo thất bại! Đã xảy ra lỗi');
        }
    }
}
