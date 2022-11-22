<!DOCTYPE html>
@extends('admin-views.layouts.admin-layout')

@section('admin-title')
<title>Trang chào mừng</title>
@endsection

@section('admin-js')
<script type="text/javascript" src="{{ asset('resources/js/admin-page/reuseable/preview-image.js') }}"></script>
@endsection

@section('admin-css')
<link rel="stylesheet" href="{{ asset('resources/css/admin-page/reuseable/img-fit.css') }}">
</link>
@endsection

@section('admin-content')

<div class="container-xxl flex-grow-1 container-p-y">

    @include('admin-views.partials.content-header',['pageParent' => 'Trang chủ', 'pageName' => 'Chào mừng'])


    <div class="row">

        <!-- Examples -->
        <div class="row mb-5">
            <div class="col-md-6 col-lg-4 mb-3">
                <div class="card h-100">
                    <img class="card-img-top" src="https://www.kindpng.com/picc/m/766-7662648_statistics-clipart-png-transparent-png.png" alt="Card image cap" />
                    <div class="card-body">
                        <h5 class="card-title">Xem thống kê</h5>
                        <p class="card-text">
                            SGM Music Admin giúp bạn xem chi tiết thống kê
                        </p>
                        <a href="javascript:void(0)" class="btn btn-outline-primary">Xem ngay</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 mb-3">
                <div class="card h-100">
                    <img class="card-img-top" src="https://www.pngitem.com/pimgs/m/87-872141_catalog-png-pic-catalogue-catalog-clip-art-transparent.png" alt="Card image cap" />
                    <div class="card-body">
                        <h5 class="card-title">Quản lý danh mục âm nhạc</h5>
                        <p class="card-text">
                            SGM Music Admin giúp bạn Quản lý các danh mục âm nhạc
                        </p>
                        <a href="javascript:void(0)" class="btn btn-outline-primary">Xem ngay</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 mb-3">
                <div class="card h-100">
                    <img class="card-img-top" src="https://png.pngtree.com/element_origin_min_pic/16/12/03/933bc18f0355771537e11b375a4a2de7.jpg" alt="Card image cap" />
                    <div class="card-body">
                        <h5 class="card-title">Quản lý album</h5>
                        <p class="card-text">
                            SGM Music Admin giúp bạn Quản lý các Album nhạc
                        </p>
                        <a href="javascript:void(0)" class="btn btn-outline-primary">Xem ngay</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Examples -->

        <!-- Examples -->
        <div class="row mb-5">
                <div class="col-md-6 col-lg-4 mb-3">
                  <div class="card h-100">
                    <img class="card-img-top" src="https://www.nicepng.com/png/detail/935-9352233_music-notes-png-music-note-tattoo-png.png" alt="Card image cap" />
                    <div class="card-body">
                      <h5 class="card-title">Quản lý Bài hát</h5>
                      <p class="card-text">
                       SGM Music Admin giúp bạn Quản lý bài hát
                      </p>
                      <a href="javascript:void(0)" class="btn btn-outline-primary">Xem ngay</a>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 col-lg-4 mb-3">
                  <div class="card h-100">
                    <img class="card-img-top" src="https://png.pngtree.com/element_our/png_detail/20181208/list-icon-png_265066.jpg" alt="Card image cap" />
                    <div class="card-body">
                      <h5 class="card-title">Quản lý Báo cáo vi phạm</h5>
                      <p class="card-text">
                      SGM Music Admin giúp bạn Quản lý các Báo cáo vi phạm
                      </p>
                      <a href="javascript:void(0)" class="btn btn-outline-primary">Xem ngay</a>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 col-lg-4 mb-3">
                  <div class="card h-100">
                    <img class="card-img-top" src="https://png.pngtree.com/png-clipart/20210424/ourlarge/pngtree-suits-middle-aged-men-cartoon-characters-png-image_3232208.jpg" alt="Card image cap" />
                    <div class="card-body">
                      <h5 class="card-title">Quản lý Tài khoản</h5>
                      <p class="card-text">
                      SGM Music Admin giúp bạn Quản lý các Tài khoản
                      </p>
                      <a href="javascript:void(0)" class="btn btn-outline-primary">Xem ngay</a>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Examples -->
    </div>
    @endsection