@extends('frontend.templates.main')

@push('title')
    Home
@endpush

@push('style')
    <style>
        /*html,*/
        /*body,*/
        /*.carousel {*/
            /*height: 100%;*/
            /*margin: 0;*/
        /*}*/

        /*.carousel-item img {*/
            /*display: block;*/
            /*width: auto;*/
            /*height: auto;*/
            /*max-width: 100%;*/
            /*max-height: 50%;*/
        /*}*/
        /*section banner*/
        #banner{
            margin-top: -70px;
            overflow: hidden;
            width: 100%;
            height: 100vh;
        }
        #banner img{
            width: 100%;
            height: 100vh;
        }

        #carouselExampleIndicators .carousel-indicators {
            /*margin-bottom: 100px;*/
        }
        .carousel-control-prev, .carousel-control-next {
            z-index: 5;
        }
        .carousel-caption {
            background: rgba(33,33,33 ,0.7)!important;
        }

        /*HOTEL FORM*/
        .hotel-form {
            /*border: 1px solid #9E9E9E;*/
            /*padding: 10px;*/
            /*border-radius: 7px;*/
        }

        .hotel-form .form-control, .form-control:focus {
            border: 0;
            outline: 0;
            -webkit-box-shadow: none;
            box-shadow: none;
        }
        .promotion .carousel-item {
            width: 100%;
            height: 200px;
            border-radius: 3px;
        }

        .promotion .carousel-item img {
            -webkit-filter: blur(2px);
            -moz-filter: blur(2px);
            -o-filter: blur(2px);
            -ms-filter: blur(2px);
            filter: blur(2px);
            border: 1px solid #9e9e9e;
            border-radius: 3px;
        }

        .btn-tjiburial:hover {
            color: #fff;
        }

        .carousel-caption{
            padding-bottom: 35px;
            left: 0;
            right: 0;
            bottom: 0;
        }

        @media(max-width: 768px){
            .navbar {
                margin: 0;
            }
            .booking {
                margin-top: 20px;
            }
            .promo-img {
                display: inline-block;
            }
            #banner {
                margin-top: 0;
            }
            #banner{
                height: 300px;
            }
            #banner img{
                height: 300px;
            }
        }
    </style>
@endpush

@section('content')
    <div class="section" id="banner">
        <div class="text-center">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    @foreach( $banners as $banner )
                        <li data-target="#carouselExampleIndicators" data-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}"></li>
                    @endforeach
                </ol>
                <div class="carousel-inner">
                    @foreach($banners as $banner)
                        <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                            <img class="d-block img-fluid" src="{{ asset('uploads/banner/'.$banner->image) }}" alt="{{ $banner->title }}">
                            <div class="carousel-caption bg-dark w-100 mx-auto">
                                <h5>{{ $banner->title }}</h5>
                                <p class="d-none d-md-block">{{ $banner->description }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row mt-5">
            <div class="col-lg-12">
                <form action="{{ url('/book#form') }}" method="get">
                    @include("frontend.templates.booking-form")
                </form>
            </div>
        </div>

        {{-- DESCRIPTION --}}
        <div class="row mt-5">
            <div class="{{ @$promotions->isEmpty() ? 'col-lg-12' : 'col-lg-6' }}">
                <h4>IT'S BETTER AT PONDOKAN TJIBURIAL</h4>
                <p>
                    Spacious and comfort are the two basic essential in our rooms. Thoughtfully built by the founding
                    family, we try our best to give you the same experience as our own home. Fresh air circulation,
                    no air conditioner needed.
                </p>
            </div>
            @if(!$promotions->isEmpty())
                <div class="col-lg-6">
                    <h4>PROMOTIONS</h4>
                    <div id="promotions" class="carousel slide promotion" data-ride="carousel">
                        <ol class="carousel-indicators">
                            @foreach($promotions as $key => $promotion)
                                <li data-target="#promotions" data-slide-to="{{ $key }}" class="{{ $key == 0 ? 'active' : '' }}"></li>
                            @endforeach
                        </ol>
                        <div class="carousel-inner">
                            @foreach($promotions as $key => $promotion)
                                <a href="{{ url('promotion/'.$promotion->id) }}" class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                    <img class="d-block img-fluid w-100" src="{{ asset('uploads').'/promotions/'.$promotion->title.'/'.@$promotion->images()->where('main', 1)->first()->image }}" alt="promotions">
                                    <div class="carousel-caption d-none d-md-block">
                                        <h5 class="bg-dark p-2" style="opacity: 0.7">{{ $promotion->title }}</h5>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                        <a class="carousel-control-prev" href="#promotions" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#promotions" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            @endif

        </div>

        {{-- MAPS --}}
        <div class="row mt-5">
            <div class="col-lg-12">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3961.2296543555253!2d107.62732121431732!3d-6.86305819504039!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e723b2ddc3fd%3A0xcf1a6bdf1a56f76f!2sJl.+Bukit+Pakar+Timur+No.33%2C+Ciburial%2C+Cimenyan%2C+Bandung%2C+Jawa+Barat+40198!5e0!3m2!1sid!2sid!4v1527653824816"height="450" frameborder="0" style="border:0;width:100%;" allowfullscreen></iframe>
            </div>
        </div>
    </div>

    @include('frontend.templates.footer')

@endsection