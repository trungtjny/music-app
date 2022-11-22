<!DOCTYPE html>
@extends('admin-views.layouts.admin-layout')

@section('admin-title')
<title>Sửa Báo cáo bài hát</title>
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

    @include('admin-views.partials.content-header',['pageParent' => 'Quản lý Báo cáo bài hát', 'pageName' => 'Sửa danh mục'])


    <div class="row">

        <!-- Button with Badges -->
        <div class="col-lg">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between my-2">
                    <div class="p-2">
                        <h5 class="card-title mb-0">Sửa Báo cáo bài hát</h5>
                    </div>
                    <!-- <div class="pt-md-0">
                        <button class="dt-button create-new btn btn-primary" type="button">
                            <span>
                                <i class="bx bx-plus me-sm-2"></i>
                                <span class="d-none d-sm-inline-block">Thêm mới danh mục</span>
                            </span>
                        </button>
                    </div> -->
                </div>

                <div class="card-body">
                    <form action="{{route('admin.reports.update', ['id' => $report->id])}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">Người báo cáo:</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge speech-to-text">
                                    <input type="text" name="name" class="form-control" placeholder="Nhập hoặc nói tên danh mục" value="{{$report->user->name}} - {{$report->user->email}} - @foreach ($report->user->roles as $role) {{$role->name}} @endforeach" aria-describedby="text-to-speech-addon" required disabled>
                                    <span class="input-group-text" id="text-to-speech-addon">
                                        <i class="bx bx-microphone cursor-pointer text-to-speech-toggle"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-company">Bài hát bị báo cáo:</label>
                            <div class="col-sm-10">
                                <!-- <input type="file" class="form-control" name="avatar_path" onchange="showSinglePicture(this,1);" id="basic-default-company" placeholder="ACME Inc."> -->
                                <div class="row">
                                    <div class="col-md-2">
                                        @if (isset($report->music->thumbnail))
                                        <img style="border-radius:50%" class="avatar1 my-3 img-custom" width="150" height="150" src="{{ $report->music->thumbnail }}">
                                        @else
                                        <img style="border-radius:50%" class="avatar1 my-3 img-custom" width="150" height="150" src="  https://banksiafdn.com/wp-content/uploads/2019/10/placeholde-image.jpg">
                                        @endif
                                    </div>
                                    <div class="col-md-5">
                                        <div class="row my-4 fw-bold fs-5">{{$report->music->title}}</div>
                                        <div class="row fw-bold fs-5">Nghệ sĩ:
                                            @foreach ($report->music->singer as $artist)
                                            {{$artist->name}} - {{$artist->nickname}},
                                            @endforeach

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-email">Email</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <input type="text" id="basic-default-email" class="form-control" placeholder="john.doe" aria-label="john.doe" aria-describedby="basic-default-email2">
                                    <span class="input-group-text" id="basic-default-email2">@example.com</span>
                                </div>
                                <div class="form-text">You can use letters, numbers &amp; periods</div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-phone">Phone No</label>
                            <div class="col-sm-10">
                                <input type="text" id="basic-default-phone" class="form-control phone-mask" placeholder="658 799 8941" aria-label="658 799 8941" aria-describedby="basic-default-phone">
                            </div>
                        </div> -->
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-message">Mô tả chi tiết: </label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge speech-to-text">
                                    <textarea class="form-control" name="message" placeholder="Điền hoặc nói mô tả chi tiết" rows="4">{{$report->message}}</textarea>
                                    <span class="input-group-text">
                                        <i class="bx bx-microphone cursor-pointer text-to-speech-toggle"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">Trạng thái:</label>
                            <div class="col-sm-10">
                                <select class="form-select" name="status" required>
                                    @if ($report->status == 0)
                                    <option value="0" selected>Chưa xử lý</option>
                                    <option value="1">Đã xử lý</option>
                                    @else
                                    <option value="0">Chưa xử lý</option>
                                    <option value="1" selected>Đã xử lý</option>

                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="row justify-content-end">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Xác nhận sửa </button>
                                <button type="reset" class="btn btn-secondary">Hủy </button>
                            </div>
                        </div>
                    </form>
                </div>


            </div>
        </div>
    </div>
    <!-- Accordion -->
    <!-- <h5 class="mt-4">Accordion</h5>
              <div class="row">
                <div class="col-md mb-4 mb-md-0">
                  <small class="text-light fw-semibold">Basic Accordion</small>
                  <div class="accordion mt-3" id="accordionExample">
                    <div class="card accordion-item active">
                      <h2 class="accordion-header" id="headingOne">
                        <button
                          type="button"
                          class="accordion-button"
                          data-bs-toggle="collapse"
                          data-bs-target="#accordionOne"
                          aria-expanded="true"
                          aria-controls="accordionOne"
                        >
                          Accordion Item 1
                        </button>
                      </h2>

                      <div
                        id="accordionOne"
                        class="accordion-collapse collapse show"
                        data-bs-parent="#accordionExample"
                      >
                        <div class="accordion-body">
                          Lemon drops chocolate cake gummies carrot cake chupa chups muffin topping. Sesame snaps icing
                          marzipan gummi bears macaroon dragée danish caramels powder. Bear claw dragée pastry topping
                          soufflé. Wafer gummi bears marshmallow pastry pie.
                        </div>
                      </div>
                    </div>
                    <div class="card accordion-item">
                      <h2 class="accordion-header" id="headingTwo">
                        <button
                          type="button"
                          class="accordion-button collapsed"
                          data-bs-toggle="collapse"
                          data-bs-target="#accordionTwo"
                          aria-expanded="false"
                          aria-controls="accordionTwo"
                        >
                          Accordion Item 2
                        </button>
                      </h2>
                      <div
                        id="accordionTwo"
                        class="accordion-collapse collapse"
                        aria-labelledby="headingTwo"
                        data-bs-parent="#accordionExample"
                      >
                        <div class="accordion-body">
                          Dessert ice cream donut oat cake jelly-o pie sugar plum cheesecake. Bear claw dragée oat cake
                          dragée ice cream halvah tootsie roll. Danish cake oat cake pie macaroon tart donut gummies.
                          Jelly beans candy canes carrot cake. Fruitcake chocolate chupa chups.
                        </div>
                      </div>
                    </div>
                    <div class="card accordion-item">
                      <h2 class="accordion-header" id="headingThree">
                        <button
                          type="button"
                          class="accordion-button collapsed"
                          data-bs-toggle="collapse"
                          data-bs-target="#accordionThree"
                          aria-expanded="false"
                          aria-controls="accordionThree"
                        >
                          Accordion Item 3
                        </button>
                      </h2>
                      <div
                        id="accordionThree"
                        class="accordion-collapse collapse"
                        aria-labelledby="headingThree"
                        data-bs-parent="#accordionExample"
                      >
                        <div class="accordion-body">
                          Oat cake toffee chocolate bar jujubes. Marshmallow brownie lemon drops cheesecake. Bonbon
                          gingerbread marshmallow sweet jelly beans muffin. Sweet roll bear claw candy canes oat cake
                          dragée caramels. Ice cream wafer danish cookie caramels muffin.
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md">
                  <small class="text-light fw-semibold">Accordion Without Arrow</small>
                  <div id="accordionIcon" class="accordion mt-3 accordion-without-arrow">
                    <div class="accordion-item card">
                      <h2 class="accordion-header text-body d-flex justify-content-between" id="accordionIconOne">
                        <button
                          type="button"
                          class="accordion-button collapsed"
                          data-bs-toggle="collapse"
                          data-bs-target="#accordionIcon-1"
                          aria-controls="accordionIcon-1"
                        >
                          Accordion Item 1
                        </button>
                      </h2>

                      <div id="accordionIcon-1" class="accordion-collapse collapse" data-bs-parent="#accordionIcon">
                        <div class="accordion-body">
                          Lemon drops chocolate cake gummies carrot cake chupa chups muffin topping. Sesame snaps icing
                          marzipan gummi bears macaroon dragée danish caramels powder. Bear claw dragée pastry topping
                          soufflé. Wafer gummi bears marshmallow pastry pie.
                        </div>
                      </div>
                    </div>

                    <div class="accordion-item card">
                      <h2 class="accordion-header text-body d-flex justify-content-between" id="accordionIconTwo">
                        <button
                          type="button"
                          class="accordion-button collapsed"
                          data-bs-toggle="collapse"
                          data-bs-target="#accordionIcon-2"
                          aria-controls="accordionIcon-2"
                        >
                          Accordion Item 2
                        </button>
                      </h2>
                      <div id="accordionIcon-2" class="accordion-collapse collapse" data-bs-parent="#accordionIcon">
                        <div class="accordion-body">
                          Dessert ice cream donut oat cake jelly-o pie sugar plum cheesecake. Bear claw dragée oat cake
                          dragée ice cream halvah tootsie roll. Danish cake oat cake pie macaroon tart donut gummies.
                          Jelly beans candy canes carrot cake. Fruitcake chocolate chupa chups.
                        </div>
                      </div>
                    </div>

                    <div class="accordion-item card active">
                      <h2 class="accordion-header text-body d-flex justify-content-between" id="accordionIconThree">
                        <button
                          type="button"
                          class="accordion-button"
                          data-bs-toggle="collapse"
                          data-bs-target="#accordionIcon-3"
                          aria-expanded="true"
                          aria-controls="accordionIcon-3"
                        >
                          Accordion Item 3
                        </button>
                      </h2>
                      <div
                        id="accordionIcon-3"
                        class="accordion-collapse collapse show"
                        data-bs-parent="#accordionIcon"
                      >
                        <div class="accordion-body">
                          Oat cake toffee chocolate bar jujubes. Marshmallow brownie lemon drops cheesecake. Bonbon
                          gingerbread marshmallow sweet jelly beans muffin. Sweet roll bear claw candy canes oat cake
                          dragée caramels. Ice cream wafer danish cookie caramels muffin.
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div> -->
    <!--/ Accordion -->

    <!--/ Advance Styling Options -->
</div>
@endsection