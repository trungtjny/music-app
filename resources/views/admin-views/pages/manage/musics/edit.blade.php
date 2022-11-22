<!DOCTYPE html>
@extends('admin-views.layouts.admin-layout')

@section('admin-title')
<title>Sửa Bài hát</title>
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

    @include('admin-views.partials.content-header',['pageParent' => 'Quản lý Bài hát', 'pageName' => 'Sửa Bài hát'])


    <div class="row">

        <!-- Button with Badges -->
        <div class="col-lg">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between my-2">
                    <div class="p-2">
                        <h5 class="card-title mb-0">Sửa Bài hát</h5>
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
                    <form action="{{route('admin.musics.update',['id' => $music->id ])}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-5">
                            @if (isset($music->thumbnail))
                            <div class="img-upload-container">
                                <img class="avatar1 img-upload-holder" src="{{$music->thumbnail}}">
                                <input type="file" name="thumbnail" class="hide-file" onchange="showSinglePicture(this,1);">
                            </div>
                            @else
                            <div class="img-upload-container">
                                <img class="avatar1 img-upload-holder" src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png">
                                <input type="file" name="thumbnail" class="hide-file" onchange="showSinglePicture(this,1);">
                            </div>
                            @endif

                        </div>
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label class="form-label" for="basic-default-fullname">Tên bài hát</label>
                                <div class="input-group input-group-merge speech-to-text">
                                    <input type="text" name="title" value="{{$music->title}}" class="form-control" placeholder="Nhập hoặc nói Tên bài hát" aria-describedby="text-to-speech-addon" required>
                                    <span class="input-group-text" id="text-to-speech-addon">
                                        <i class="bx bx-microphone cursor-pointer text-to-speech-toggle"></i>
                                    </span>
                                </div>
                            </div>


                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">

                                <label class="form-label" for="basic-default-fullname">Lượt nghe</label>
                                <div class="input-group ">
                                    <input type="number" min="0" name="views" value="{{$music->views}}" class="form-control" placeholder="Nhập hoặc nói lượt nghe" aria-describedby="text-to-speech-addon" required disabled>

                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label" for="basic-default-fullname">Tải miễn phí</label>
                                <select class="form-select" name="free" required>
                                    @if ($music->free == 0)
                                    <option value="0" selected>Không</option>
                                    <option value="1">Có</option>
                                    @else
                                    <option value="0">Không</option>
                                    <option value="1" selected>Có</option>

                                    @endif
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label" for="basic-default-fullname">Đề xuất</label>
                                <select class="form-select" name="is_recommended" required>
                                    @if ($music->is_recommended == 0)
                                    <option value="0" selected>Không</option>
                                    <option value="1">Có</option>
                                    @else
                                    <option value="0">Không</option>
                                    <option value="1" selected>Có</option>

                                    @endif
                                </select>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label" for="basic-default-fullname">Chọn Nghệ sĩ:</label>

                                <select class="form-control select2-multiple" name="artist_id[]" multiple required>

                                    @foreach ($artists as $artist)
                                    <option value="{{ $artist->id }}" @foreach($music->singer as $musicArtist)
                                        {{$musicArtist->id == $artist->id ? 'selected': ''}}
                                        @endforeach> {{ $artist->name }} {{ $artist->nickname }}

                                    </option>

                                    @endforeach
                                </select>

                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label" for="basic-default-fullname">Chọn Album</label>
                                <select class="form-select" name="album_id" required>
                                    @foreach ($albums as $album)
                                    <option value="{{ $album->id }}" {{( $album->id == $music->album_id) ? 'selected' : '' }}>{{$album->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                        <div class="row">

                            <div class="col-md-8 mb-3">
                                <label class="form-label" for="basic-default-fullname">File nhạc</label>
                                <audio controls class="form-control">
                                    <source src="{{$music->file_path}}" type="audio/mpeg">
                                    Your browser does not support the audio element.
                                </audio>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label" for="basic-default-fullname">Độ dài</label>
                                <div class="input-group input-group-merge speech-to-text">
                                    <input type="text" name="time" value="{{$music->time}}" class="form-control" placeholder="Nhập hoặc nói Độ dài bài hát" aria-describedby="text-to-speech-addon" disabled>
                                    <span class="input-group-text" id="text-to-speech-addon">
                                        <i class="bx bx-microphone cursor-pointer text-to-speech-toggle"></i>
                                    </span>
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
                        <label for="exampleFormControlTextarea1" class="form-label">Lời bài hát</label>
                            <div class="input-group input-group-merge speech-to-text">
                                <textarea class="form-control" name="lyrics" placeholder="Nhập hoặc nói lời bài hát" rows="8">{{$music->lyrics}}</textarea>
                                <span class="input-group-text">
                                    <i class="bx bx-microphone cursor-pointer text-to-speech-toggle"></i>
                                </span>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Tiểu sử hoặc mô tả</label>
                            <textarea class="form-control tinymce-editor" name="description" id="exampleFormControlTextarea1" rows="20">{{$music->description}}</textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Xác nhận Sửa</button>
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