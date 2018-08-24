@extends('frontend.templates.main')

@push('title')
    Home
@endpush

@push('style')
    <style>
        .navbar {
            margin: 20px 100px;
        }
        /*section banner*/
        #banner{
            position: relative;
            margin-top: -120px;
        }
        #banner img{
            max-width: 100%;
            /*max-height: 670px;*/
        }
        #banner:after {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 250px;
            width: 100%;
            z-index: 0;
        }
        #banner .heading{
            position: absolute;
            top: 30%;
            left: 0;
            right: 0;
            color: #212121;
            z-index: 2;
            font-family: 'gravity regular';
            padding: 15px;
        }
        #banner .heading h1 {
            font-size: 60px;
        }
        #banner .heading p {
            font-size: 24px;
        }

        /*.booking {*/
            /*position: relative;*/
            /*margin-top: -100px;*/
            /*background: #1E252D;*/
            /*color: #fff;*/
            /*-webkit-border-radius: 0;*/
            /*-moz-border-radius: 0;*/
            /*border-radius: 0;*/
        /*}*/
        /*.booking .date {*/
            /*background: #384656;*/
        /*}*/
        /*.booking .btn {*/
            /*-webkit-border-radius: 0;*/
            /*-moz-border-radius: 0;*/
            /*border-radius: 0;*/
            /*background: #191F26;*/
            /*color: #fff;*/
            /*border-color: #919191;*/
            /*padding: 15px 40px;*/
        /*}*/

        #carouselExampleIndicators .carousel-indicators {
            margin-bottom: 100px;
        }
        .carousel-control-prev, .carousel-control-next {
            z-index: 5;
        }

        /*HOTEL FORM*/
        .hotel-form {
            border: 1px solid #9E9E9E;
            padding: 10px;
            border-radius: 7px;
        }

        .hotel-form .form-control, .form-control:focus {
            border: 0;
            outline: 0;
            -webkit-box-shadow: none;
            box-shadow: none;
        }

        /*.promotion {*/
            /*max-height: 150px;*/
        /*}*/

        /*.promotion .carousel-indicators {*/
            /*!*margin-bottom: 20px;*!*/
        /*}*/
        .promotion .carousel-item {
            width:100%;
            height:200px;
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
        }
    </style>
@endpush

@section('content')
    <div class="section d-none d-lg-block" id="banner">
        <div class="text-center">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="d-block img-fluid w-100" src="{{ asset('assets') }}/images/splash.png" alt="First slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block img-fluid w-100" src="{{ asset('assets') }}/images/splash.png" alt="Second slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block img-fluid w-100" src="{{ asset('assets') }}/images/splash.png" alt="Third slide">
                    </div>
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
            <div class="heading">
                <h1>Comfort</h1>
                <p>choice of number of room categories</p>
            </div>
        </div>
    </div>

    <div class="container">

        {{-- BOOKING --}}
        {{--<div class="row">--}}
            {{--<div class="col-lg-12">--}}
                {{--<div class="card booking">--}}
                    {{--<div class="card-body">--}}
                        {{--<div class="row">--}}
                            {{--<div class="col-lg-6">--}}
                                {{--<div class="text-center">--}}
                                    {{--<p>CHECK IN DATE</p>--}}
                                {{--</div>--}}
                                {{--<div class="card date">--}}
                                    {{--<div class="card-body text-center">--}}
                                        {{--SELCT DATE--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="col-lg-6 mt-sm-3 mt-md-3 mt-lg-0">--}}
                                {{--<div class="text-center">--}}
                                    {{--<p>CHECK OUT DATE</p>--}}
                                {{--</div>--}}
                                {{--<div class="card date">--}}
                                    {{--<div class="card-body text-center">--}}
                                        {{--SELCT DATE--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="row">--}}
                            {{--<div class="col-lg-12">--}}
                                {{--<div class="text-center mt-4">--}}
                                    {{--<button class="btn">REQUEST A QUOTE</button>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
        <div class="row mt-5">
            <div class="col-lg-12">
                <form action="#">
                    <div class="row hotel-form">
                        <div class="col-lg-3">
                            <div class="form-row d-flex justify-content-between align-items-center border-right p-2">
                                <div class="col-10">
                                    <label for="checkin" class="hotel-form-label mb-1"><b>Check In</b></label>
                                    <input type="date" class="form-control" name="checkin" id="checkin">
                                </div>
                                <div class="col-2">
                                    <span class="fa fa-calendar fa-2x"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-row d-flex justify-content-between align-items-center border-right p-2">
                                <div class="col-10">
                                    <label for="duration" class="hotel-form-label mb-1"><b>Duration</b></label>
                                    <select name="duration" id="duration" class="form-control custom-select">
                                        <option value="1">1 Night</option>
                                        <option value="2">2 Nights</option>
                                        <option value="3">3 Nights</option>
                                        <option value="4">4 Nights</option>
                                        <option value="5">5 Nights</option>
                                        <option value="6">6 Nights</option>
                                        <option value="7">7 Nights</option>
                                        <option value="8">8 Nights</option>
                                    </select>
                                </div>
                                <div class="col-2">
                                    <img src="{{ asset('assets') }}/images/duration.png" alt="duration">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-row d-flex justify-content-between align-items-center border-right p-2">
                                <div class="col-10">
                                    <label for="guest" class="hotel-form-label mb-1"><b>Guests</b></label>
                                    <select name="guest" id="guest" class="form-control custom-select">
                                        <option value="1">1 Guest</option>
                                        <option value="2">2 Guests</option>
                                        <option value="3">3 Guests</option>
                                        <option value="4">4 Guests</option>
                                        <option value="5">5 Guests</option>
                                        <option value="6">6 Guests</option>
                                        <option value="7">7 Guests</option>
                                        <option value="8">8 Guests</option>
                                    </select>
                                    {{--<input type="date" class="form-control  name="checkout" id="checkout">--}}
                                </div>
                                <div class="col-2">
                                    <span class="fa fa-male fa-2x"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-row d-flex justify-content-between align-items-center p-2">
                                <div class="col-10">
                                    <label for="rooms" class="hotel-form-label mb-1"><b>Rooms</b></label>
                                    <select name="rooms" id="rooms" class="form-control custom-select">
                                        <option value="1">1 Room</option>
                                        <option value="2">2 Rooms</option>
                                        <option value="3">3 Rooms</option>
                                        <option value="4">4 Rooms</option>
                                        <option value="5">5 Rooms</option>
                                        <option value="6">6 Rooms</option>
                                        <option value="7">7 Rooms</option>
                                        <option value="8">8 Rooms</option>
                                    </select>
                                </div>
                                <div class="col-2">
                                    <img src="{{ asset('assets') }}/images/rooms.png" alt="rooms">
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row my-5">
                        <div class="col-lg-12">
                            <div class="text-center">
                                <button type="submit" class="btn btn-tjiburial p-4">REQUEST A QUOTE</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- DESCRIPTION --}}
        <div class="row mt-5">
            <div class="col-lg-6">
                <h4>IT'S BETTER AT PONDOKAN TJIBURIAL</h4>
                <p class="text-justify">
                    Spacious and comfort are the two basic essential in our rooms. Thoughtfully built by the founding
                    family, we try our best to give you the same experience as our own home. Fresh air circulation,
                    no air conditioner needed.
                </p>
            </div>
            <div class="col-lg-6">
                <h4>PROMOTIONS</h4>
                <div id="promotions" class="carousel slide promotion" data-ride="carousel">
                    <ol class="carousel-indicators">
                        @foreach($promotions as $key => $promotion)
                            <li data-target="#promotions" data-slide-to="{{ $key }}" class="{{ $key == 0 ? 'active' : '' }}"></li>
                            {{--<li data-target="#promotions" data-slide-to="1"></li>--}}
                            {{--<li data-target="#promotions" data-slide-to="2"></li>--}}
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
                        {{--<a href="{{ url('promotion/1')   " class="carousel-item">--}}
                            {{--<img class="d-block img-fluid w-100" src="{{ asset('uploads') }}/promotions/2.jpg" alt="promotions">>--}}
                            {{--<div class="carousel-caption d-none d-md-block">--}}
                                {{--<h5>PROMOTION</h5>--}}
                            {{--</div>--}}
                        {{--</a>--}}
                        {{--<a href="{{ url('promotion/1') }}" class="carousel-item">--}}
                            {{--<img class="d-block img-fluid w-100" src="{{ asset('uploads') }}/promotions/3.jpg" alt="promotions">--}}
                            {{--<div class="carousel-caption d-none d-md-block">--}}
                                {{--<h5>PROMOTION</h5>--}}
                            {{--</div>--}}
                        {{--</a>--}}
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
        </div>

        {{-- MAPS --}}
        <div class="row mt-5">
            <div class="col-lg-12">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3961.2296543555253!2d107.62732121431732!3d-6.86305819504039!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e723b2ddc3fd%3A0xcf1a6bdf1a56f76f!2sJl.+Bukit+Pakar+Timur+No.33%2C+Ciburial%2C+Cimenyan%2C+Bandung%2C+Jawa+Barat+40198!5e0!3m2!1sid!2sid!4v1527653824816"height="450" frameborder="0" style="border:0;width:100%;" allowfullscreen></iframe>
            </div>
        </div>

        {{-- FEATURES --}}
        <div class="row my-4">
            <div class="col-lg-4">
                <img class="img-fluid w-100" src="{{ asset('assets') }}/images/features-1.png">
                <div class="text-center my-3">
                    <h5>Kai Adult Indoor Pool</h5>
                    <p>Intentionally built indoor, follows the contour of the earth surface. 25 x 6 meter long, feel the brezzy wind and dippin in the fresh water.</p>
                </div>
            </div>
            <div class="col-lg-4">
                <img class="img-fluid w-100" src="{{ asset('assets') }}/images/features-2.png">
                <div class="text-center my-3">
                    <h5>Cingaripit Children Outdoor Pool</h5>
                    <p>Embrace children with nature elements, water, mother nature, and the sun.</p>
                </div>
            </div>
            <div class="col-lg-4">
                <img class="img-fluid w-100" src="{{ asset('assets') }}/images/features-3.png">
                <div class="text-center my-3">
                    <h5>Jogging Tracks</h5>
                    <p>Someone said, it's not really a jogging tracks, it's like a hiking tracks. How about try it yourself?</p>
                </div>
            </div>
            <div class="col-lg-4">
                <img class="img-fluid w-100" src="{{ asset('assets') }}/images/features-1.png">
                <div class="text-center my-3">
                    <h5>Children Playground</h5>
                    <p>Built outdoor, with two swings, for toddles, and grown kids. </p>
                </div>
            </div>
            <div class="col-lg-4">
                <img class="img-fluid w-100" src="{{ asset('assets') }}/images/features-2.png">
                <div class="text-center my-3">
                    <h5>Kids Club</h5>
                    <p>-- Coming Soon --</p>
                </div>
            </div>
            <div class="col-lg-4">
                <img class="img-fluid w-100" src="{{ asset('assets') }}/images/features-3.png">
                <div class="text-center my-3">
                    <h5>Coming Soon</h5>
                    <p>Coming Soon</p>
                </div>
            </div>
        </div>

        {{-- PROMOTIONS --}}
        {{--<div class="row my-4">--}}
            {{--<div class="col-lg-12 text-center">--}}
                {{--<h4>Promotions</h4>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="row">--}}
            {{--<div class="col-lg-3">--}}
                {{--<a href="#" class="text-center text-dark no-underline my-3">--}}
                    {{--<img class="img-fluid promo-img mb-2" src="{{ asset('assets') }}/uploads/promotions/asset-1.png">--}}
                    {{--<h5>Promotions</h5>--}}
                    {{--<p>Small detail about the promotions</p>--}}
                {{--</a>--}}
            {{--</div>--}}
            {{--<div class="col-lg-3">--}}
                {{--<a href="#" class="text-center text-dark no-underline my-3">--}}
                    {{--<img class="img-fluid promo-img mb-2" src="{{ asset('assets') }}/uploads/promotions/asset-2.png">--}}
                    {{--<h5>Promotions</h5>--}}
                    {{--<p>Small detail about the promotions</p>--}}
                {{--</a>--}}
            {{--</div>--}}
            {{--<div class="col-lg-3">--}}
                {{--<a href="#" class="text-center text-dark no-underline my-3">--}}
                    {{--<img class="img-fluid promo-img mb-2" src="{{ asset('assets') }}/uploads/promotions/asset-3.png">--}}
                    {{--<h5>Promotions</h5>--}}
                    {{--<p>Small detail about the promotions</p>--}}
                {{--</a>--}}
            {{--</div>--}}
            {{--<div class="col-lg-3">--}}
                {{--<a href="#" class="text-center text-dark no-underline my-3">--}}
                    {{--<img class="img-fluid promo-img mb-2" src="{{ asset('assets') }}/uploads/promotions/asset-4.png">--}}
                    {{--<h5>Promotions</h5>--}}
                    {{--<p>Small detail about the promotions</p>--}}
                {{--</a>--}}
            {{--</div>--}}
        {{--</div>--}}
    </div>

    @include('frontend.templates.footer')

@endsection