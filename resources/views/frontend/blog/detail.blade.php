@extends('frontend.templates.main')

@push('title')
    Blog
@endpush

@push('style')
    <style>
        .navbar {
            /*position: absolute;*/
            width: 100%;
        }
        .base {
            width: 100%;
            height: 300px;
            position: relative;
            margin-left: auto;
            margin-right: auto;
            overflow: hidden;
        }
        .base img {
            width: 100%;
            position: absolute;
            margin: auto;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
        }

        .card {
            -webkit-border-radius: 0;
            -moz-border-radius: 0;
            border-radius: 0;
            border: 0;
        }

        input, textarea {
            border: 0;
        }
        .card-columns a:hover {
            text-decoration: none;
        }
    </style>
@endpush

@section('content')
    <div class="base">
        <img class="img-fluid" src="{{ asset('uploads') }}/blog/1.jpg">
    </div>

    <div class="container mt-4">
        <div class="row">
            <div class="col-lg-12">
                <h4 class="text-center">{{ $blog->title }}</h4>
            </div>
            <div class="col-lg-8 offset-lg-2 mt-3">
                <div class="row">
                    @php
                        $pictures = [];
                        if (!empty($blog->pictures))
                            $pictures = json_decode($blog->pictures);
                    @endphp
                    @forelse($pictures as $picture)
                        <div class="col-lg-6 mt-4">
                            <img class="img-fluid w-100 h-100" src="{!! asset('uploads') . '/blog/'.$blog->title.'/'.@$picture->image !!}">
                        </div>
                    @empty
                        <p class="text-center my-3">*No Image*</p>
                    @endforelse
                    <div class="col-lg-12 mt-5">
                        {!! $blog->description !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('frontend.templates.footer')

@endsection