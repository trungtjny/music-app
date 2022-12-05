<!DOCTYPE html>
@extends('admin-views.layouts.admin-layout')

@section('admin-title')
<title>Quản lý Album bài hát</title>
@endsection



@section('admin-js')

<script type="text/javascript" src="{{ asset('resources/js/admin-page/reuseable/hide-toast.js') }}"></script>
<script type="text/javascript" src="{{ asset('resources/js/admin-page/reuseable/sweet-alert-2.js') }}"></script>
@endsection


@section('admin-css')
<link rel="stylesheet" href="{{ asset('resources/css/admin-page/reuseable/img-fit.css') }}">
</link>
@endsection



@section('admin-content')



<div class="container-xxl flex-grow-1 container-p-y">

  @include('admin-views.partials.content-header',['pageParent' => 'Quản lý Album Bài hát', 'pageName' => 'Tất cả Album'])

  <div class="toast-container">
    @if (session('success'))
    <!-- Toast with Placements -->
    <div class="bs-toast toast toast-placement-ex m-2 bg-success top-0 end-0 show" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000" id="successToast">
      <div class="toast-header">
        <i class="bx bx-bell me-2"></i>
        <div class="me-auto fw-semibold">Thông báo</div>
        <small>vừa xong</small>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
      <div class="toast-body">{{ Session::get('success') }}</div>
    </div>
    <!-- Toast with Placements -->
    @endif
    @if (session('error'))
    <!-- Toast with Placements -->
    <div class="bs-toast toast toast-placement-ex m-2 bg-danger top-0 end-0 show" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000" id="successToast">
      <div class="toast-header">
        <i class="bx bx-bell me-2"></i>
        <div class="me-auto fw-semibold">Thông báo</div>
        <small>vừa xong</small>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
      <div class="toast-body">{{ Session::get('error') }}</div>
    </div>
    <!-- Toast with Placements -->
    @endif
  </div>


  <div class="row">

    <!-- Button with Badges -->
    <div class="col-lg">
      <div class="card mb-4">
        <div class="card-header d-flex justify-content-between my-2">
          <div class="p-2">
            <h5 class="card-title mb-0">Danh sách Album Bài hát</h5>
          </div>
          <!-- <div class="pt-md-0">
            <a href="{{ route('albums.create') }}" class="dt-button create-new btn btn-success" type="button">
              <span>
                <i class="bx bx-plus me-sm-2"></i>
                <span class="d-none d-sm-inline-block">Thêm mới Album</span>
              </span>
            </a>
          </div> -->
        </div>


        <div class="card-body ">
          <div class="table-responsive text-nowrap">
            <table style="line-height: 3" id="table1" class="table table-hover table-lg">
              <thead class="table-light">
                <tr>
                  <th>ID</th>
                  <th>Tên album</th>
                  <th>Ảnh đại diện</th>
                  <th>Nghệ sĩ</th>
                  <th>Hành động</th>
                </tr>
              </thead>
              <tbody class="table-border-bottom-0">
                @foreach($albums as $album)
                <tr>
                  <td>{{$album->id}}</td>
                  <td>{{$album->name}}</td>
                  <td>
                    @if (isset($album->thumbnail))
                    <img class="img-custom" width="150" height="100" src="{{ $album->thumbnail }}">
                    @else
                    <img class="img-custom" width="150" height="100" src="https://banksiafdn.com/wp-content/uploads/2019/10/placeholde-image.jpg">
                    @endif


                  </td>
                  <td>{{$album->singer->name}} {{$album->singer->nickname}}</td>

                  <td>
                    <a type="button" href="{{ route('albums.edit', ['id' => $album->id]) }}" class="btn btn-primary">
                      <span>
                        <i class='bx bxs-edit'></i>
                        <span class="d-none d-sm-inline-block">Sửa</span>
                      </span>
                    </a>
                    <!-- Button trigger modal -->
                    <a type="button" href="" class="btn btn-danger mx-1 action-delete" data-url="{{route('albums.delete', ['id' => $album->id])}}">
                      <span>
                        <i class='bx bx-trash'></i>
                        <span class="d-none d-sm-inline-block">Xóa</span>
                      </span>
                    </a>

                  </td>

                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
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