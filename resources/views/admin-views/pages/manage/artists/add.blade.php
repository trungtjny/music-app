<!DOCTYPE html>
@extends('admin-views.layouts.admin-layout')

@section('admin-title')
<title>Thêm mới Nghệ sĩ</title>
@endsection

@section('admin-js')
<script type="text/javascript" src="{{ asset('resources/js/admin-page/reuseable/preview-image.js') }}"></script>
<script type="text/javascript" src="{{ asset('resources/js/admin-page/reuseable/select2.js') }}"></script>
<script type="text/javascript" src="{{ asset('resources/js/admin-page/reuseable/tinymce.js') }}"></script>

@endsection

@section('admin-css')
<link rel="stylesheet" href="{{ asset('resources/css/admin-page/reuseable/img-fit.css') }}">
</link>
<link rel="stylesheet" href="{{ asset('resources/css/admin-page/reuseable/hide-input-file.css') }}">
</link>
@endsection

<style>
    .select2 {
        width: 100% !important;
    }
</style>

@section('admin-content')

<div class="container-xxl flex-grow-1 container-p-y">

    @include('admin-views.partials.content-header',['pageParent' => 'Quản lý Nghệ sĩ', 'pageName' => 'Thêm mới Nghệ sĩ'])


    <div class="row">

        <!-- Button with Badges -->
        <div class="col-lg">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between my-2">
                    <div class="p-2">
                        <h5 class="card-title mb-0">Thêm mới Nghệ sĩ</h5>
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
                    <form action="{{route('artists.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-5">
                            <div class="img-upload-container">
                                <img class="avatar1 img-upload-holder" src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png">
                                <input type="file" name="avatar_path" class="hide-file" onchange="showSinglePicture(this,1);">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label" for="basic-default-fullname">Họ và tên</label>
                                <div class="input-group input-group-merge speech-to-text">
                                    <input type="text" name="name" class="form-control" placeholder="Nhập hoặc nói mã sản phẩm" aria-describedby="text-to-speech-addon" required>
                                    <span class="input-group-text" id="text-to-speech-addon">
                                        <i class="bx bx-microphone cursor-pointer text-to-speech-toggle"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">

                                <label class="form-label" for="basic-default-fullname">Ngày sinh</label>
                                <div class="input-group ">
                                    <input type="date" name="dob" class="form-control" placeholder="Nhập hoặc nói tên sản phẩm" aria-describedby="text-to-speech-addon" required>

                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label" for="basic-default-fullname">Giới tính</label>
                                <select class="form-select" name="gender" required>
                                    <option value="0">Nam</option>
                                    <option value="1">Nữ</option>
                                </select>
                            </div>


                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label" for="basic-default-fullname">Nhập email</label>
                                <div class="input-group input-group-merge speech-to-text">
                                    <input type="email" name="email" class="form-control" placeholder="Nhập hoặc nói email" aria-describedby="text-to-speech-addon" required>
                                    <span class="input-group-text" id="text-to-speech-addon">
                                        <i class="bx bx-microphone cursor-pointer text-to-speech-toggle"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-password-toggle">
                                    <label class="form-label" for="basic-default-password32">Password</label>
                                    <div class="input-group input-group-merge">
                                        <input type="password" class="form-control" name="password" id="basic-default-password32" placeholder="············" aria-describedby="basic-default-password">
                                        <span class="input-group-text cursor-pointer" id="basic-default-password"><i class="bx bx-hide"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label" for="basic-default-fullname">Trạng thái</label>
                                <select class="form-select" name="active" required>
                                    <option value="1">Đang hoạt động</option>
                                    <option value="0">Không hoạt động</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
         
                            <div class="col-md-12 mb-3">
                                <label class="form-label" for="basic-default-fullname">Số coin:</label>
                                <div class="input-group input-group-merge speech-to-text">
                                    <input type="number" min="0" name="coin" class="form-control" placeholder="Nhập hoặc nói lương tháng" aria-describedby="text-to-speech-addon" required>
                                    <span class="input-group-text" id="text-to-speech-addon">
                                        <i class="bx bx-microphone cursor-pointer text-to-speech-toggle"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label" for="basic-default-fullname">Ảnh CMT mặt trước:</label>
                                <div class="">
                                    <input type="file" class="form-control" name="id_card_front" onchange="showSinglePicture(this,2);" id="" placeholder="ACME Inc.">
                                    <img class="avatar2 my-3 img-custom" width="250" height="200" src="https://banksiafdn.com/wp-content/uploads/2019/10/placeholde-image.jpg">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label" for="basic-default-fullname">Ảnh CMT mặt sau:</label>
                                <div class="">
                                    <input type="file" class="form-control" name="id_card_back" onchange="showSinglePicture(this,3);" id="" placeholder="ACME Inc.">
                                    <img class="avatar3 my-3 img-custom" width="250" height="200" src="https://banksiafdn.com/wp-content/uploads/2019/10/placeholde-image.jpg">
                                </div>
                            </div>

                        </div>
                        <!-- <div class="row mb-3">
                            <label class="form-label" for="basic-default-company">Mô tả ngắn</label>
                            <div class="input-group input-group-merge speech-to-text">
                                <textarea class="form-control" name="short_description" placeholder="Điền hoặc nói mô tả ngắn" rows="4"></textarea>
                                <span class="input-group-text">
                                    <i class="bx bx-microphone cursor-pointer text-to-speech-toggle"></i>
                                </span>
                            </div>
                        </div> -->

                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Tiểu sử hoặc mô tả</label>
                            <textarea class="form-control tinymce-editor" name="description" id="exampleFormControlTextarea1" rows="25"></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Xác nhận thêm</button>
                        <button type="reset" class="btn btn-secondary">Hủy</button>
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