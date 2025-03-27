@extends('layout.layout')
@section('content')   

<link rel="stylesheet" href="{{asset('styles/store.css')}}">



<button id="homeButton" onclick="scrollToTop()">Home</button>

  <script>
    function scrollToTop() {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }
  </script>
@endsection