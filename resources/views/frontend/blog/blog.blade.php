@extends('frontend.templates.main')

@push('title')
    Blog
@endpush

@push('style')
    <style>
        .navbar {
            position: absolute;
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
                <div class="text-center">
                    <h3>Blogs</h3>
                    <p>Discover the blogs Hotel Pondokan Tjiburial has to offer for up to date informations about us</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="card-columns">
                @foreach($blogs as $blog)
                    @php
                    $pictures = [];
                    if (!empty($blog->pictures))
                        $pictures = json_decode($blog->pictures);
                    @endphp
{{--                    @foreach($pictures as $picture)--}}
                    {{--@endforeach--}}
                    <a href="{{ url('blog/'.$blog->id) }}" class="card text-dark">
                        @forelse($pictures as $picture)
                            <img class="card-img-top" src="{!! asset('uploads') . '/blog/'.$blog->title.'/'.@$picture->image !!}" alt="Blog image">
                            @break
                        @empty
                            <p class="text-center my-3">*No Image*</p>
                        @endforelse
                        <div class="card-body">
                            <h5 class="card-title">{{ $blog->title }}</h5>
                            <p class="card-text">{!! mb_strimwidth($blog->description, 0, 200, "...") !!}</p>
                            <p class="card-text"><small class="text-muted">Last updated {{ $blog->updated_at->diffForHumans() }}</small></p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    @include('frontend.templates.footer')

@endsection