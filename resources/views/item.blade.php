@extends('layouts.app')
@section('css')
    @parent
    <link rel="stylesheet" media="screen" href="{{asset('assets/vendor/lightgallery.js/dist/css/lightgallery.min.css')}}"/>
@endsection
@section('main')
<main class="page-wrapper">
    <!-- Navbar Marketplace-->
    <!-- Remove "navbar-sticky" class to make navigation bar scrollable with the page.-->
    @include('components.headers.default')
    <!-- Page Title-->
    @include('components.headers.pagetitle', ['title' => $item->name])
    <!-- Product Section-->
    @include('components.sections.product', ['item' => $item])
    <!-- Product description + Reviews + Comments-->
    @include('components.sections.product.description', ['item' => $item])
    <!-- Related products carousel-->
    @include('components.sections.related',['related' => $related, 'seller' => $item->user])
  </main>
@endsection
@section('js')
@parent
    <script src="{{asset('assets/vendor/lightgallery.js/dist/js/lightgallery.min.js')}}"></script>
    <script src="{{asset('assets/vendor/lg-fullscreen.js/dist/lg-fullscreen.min.js')}}"></script>
    <script src="{{asset('assets/vendor/lg-zoom.js/dist/lg-zoom.min.js')}}"></script>
@endsection