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
                <h4 class="text-center">Blog Title</h4>
            </div>
            <div class="col-lg-8 offset-lg-2 mt-3">
                <div class="row">
                    <div class="col-lg-12">
                        <img class="img-fluid w-100 h-100" src="{{ asset('uploads') }}/blog/promo-3.png">
                    </div>
                    <div class="col-lg-6 mt-4">
                        <img class="img-fluid w-100 h-100" src="{{ asset('uploads') }}/blog/promo-1.png">
                    </div>
                    <div class="col-lg-6 mt-4">
                        <img class="img-fluid w-100 h-100" src="{{ asset('uploads') }}/blog/promo-2.png">
                    </div>
                    <div class="col-lg-6 mt-4">
                        <img class="img-fluid w-100 h-100" src="{{ asset('uploads') }}/blog/4.jpg">
                    </div>
                    <div class="col-lg-6 mt-4">
                        <img class="img-fluid w-100 h-100" src="{{ asset('uploads') }}/blog/promo-4.png">
                    </div>
                    <div class="col-lg-12 mt-5">
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                        </p>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. A ab aliquam aut deserunt est expedita laborum minus nulla, omnis quia reiciendis repellat rerum ut, vel veritatis vitae voluptatem! Odio, omnis?
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aspernatur distinctio dolor doloribus esse, harum hic iste itaque labore magnam mollitia odio omnis placeat porro quas quasi quibusdam ratione repellendus voluptatem.
                        </p>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequatur deserunt distinctio error explicabo, fugit libero pariatur porro, quae quaerat quas, sapiente sed soluta tempore ut velit. Ipsam quis veniam voluptatibus.
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab consequatur delectus deserunt dignissimos dolore earum fuga, fugiat id inventore ipsa ipsam magnam, nulla, possimus soluta tenetur vel veritatis voluptates voluptatum.
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. A alias aliquid animi aperiam, architecto assumenda atque dicta illum ipsa magnam maxime minus natus nesciunt, odit, officiis quidem quo rerum voluptatem.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('frontend.templates.footer')

@endsection