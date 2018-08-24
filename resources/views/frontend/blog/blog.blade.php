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
                <a href="{{ url('blog/1') }}" class="card text-dark">
                    <img class="card-img-top" src="{{ asset('uploads') }}/blog/1.jpg" alt="Blog image">
                    <div class="card-body">
                        <h5 class="card-title">Blog title</h5>
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci aliquam blanditiis dignissimos eius eum facere fuga laboriosam officia officiis, quae quia rerum, suscipit. Est et, ex id porro quaerat velit?</p>
                        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                    </div>
                </a>
                <a href="{{ url('blog/1') }}" class="card text-dark">
                    <img class="card-img-top" src="{{ asset('uploads') }}/blog/5.png" alt="Blog image">
                    <div class="card-body">
                        <h5 class="card-title">Blog title</h5>
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci aliquam blanditiis dignissimos eius eum facere fuga laboriosam officia officiis, quae quia rerum, suscipit. Est et, ex id porro quaerat velit?</p>
                        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                    </div>
                </a>
                <a href="{{ url('blog/1') }}" class="card text-dark">
                    <img class="card-img-top" src="{{ asset('uploads') }}/blog/promo-2.png" alt="Blog image">
                    <div class="card-body">
                        <h5 class="card-title">Blog title</h5>
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci aliquam blanditiis dignissimos eius eum facere fuga laboriosam officia officiis, quae quia rerum, suscipit. Est et, ex id porro quaerat velit?</p>
                        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                    </div>
                </a>
                <a href="{{ url('blog/1') }}" class="card text-dark">
                    <img class="card-img" src="{{ asset('uploads') }}/blog/3.jpg" alt="Blog image">
                    <div class="card-body">
                        <h5 class="card-title">Blog title</h5>
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci aliquam blanditiis dignissimos eius eum facere fuga laboriosam officia officiis, quae quia rerum, suscipit. Est et, ex id porro quaerat velit?</p>
                        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                    </div>
                </a>
                <a href="{{ url('blog/1') }}" class="card text-dark">
                    <img class="card-img" src="{{ asset('uploads') }}/blog/blog1.png" alt="Blog image">
                    <div class="card-body">
                        <h5 class="card-title">Blog title</h5>
                        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>
                        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                    </div>
                </a>
                <a href="{{ url('blog/1') }}" class="card text-dark">
                    <img class="card-img" src="{{ asset('uploads') }}/blog/promo-3.png" alt="Blog image">
                    <div class="card-body">
                        <h5 class="card-title">Blog title</h5>
                        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>
                        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                    </div>
                </a>
            </div>
        </div>
    </div>

    @include('frontend.templates.footer')

@endsection