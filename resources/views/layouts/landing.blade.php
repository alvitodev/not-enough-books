@extends('layouts.info')
@section('content')
<!-- Content Start -->
    <div class="hero min-h-screen" style="background-image: url('/images/bg-landing.svg');">
            <div class="hero-content text-neutral-content text-left">
                <div class="ml-20 mr-150">
                <h1 class="mb-4 text-5xl font-bold">Not Enough Book.</h1>
                <p class="mb-4">
                   Ilmu Pengetahuan Tidak Bermula Dari Satu Buku
                </p>
                <button class="btn btn-primary">
                    <a href="{{ route('home') }}">Get Started</a>
                </button>
                </div>
            </div>
        </div>
  </div>      
<!-- Content End -->
@endsection