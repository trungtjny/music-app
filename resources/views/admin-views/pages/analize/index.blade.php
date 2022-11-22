<!DOCTYPE html>
@extends('admin-views.layouts.admin-layout')

@section('admin-title')
<title>Thống kê</title>
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

  @include('admin-views.partials.content-header',['pageParent' => 'Trang chủ', 'pageName' => 'Thống kê'])

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


  </div>
  
</div>
@endsection