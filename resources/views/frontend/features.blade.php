@extends('frontend.templates.main')

@push('title')
    Hotels
@endpush

@push('style')
    <style>
        .navbar {
            position: absolute;
            width: 100%;
        }
        .base {
            position: relative;
            top: 0;
            left: 0;
        }
        p {
            text-align: justify;
        }
        .img-fluid {
            display: inline-block;
        }

        #banner{
            position: relative;
            width: 100%;
            height: 500px;
        }
        #banner img{
            max-width: 100%;
            max-height: 100%;
        }
        #banner:after {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 600px;
            width: 100%;
            z-index: 1;
        }
        #banner .heading{
            position: absolute;
            left: 0;
            bottom: 0;
            color: #fff;
            background: #212121;
            z-index: 2;
            padding: 20px 20px 10px 20px;
            opacity: 0.8;
            margin-bottom: 40px;
        }
        #banner .heading h1 {
            font-size: 60px;
        }
        .carousel-control-prev, .carousel-control-next {
            z-index: 5;
        }
        .card {
            /*max-height: 300px;*/
        }
        .card-body img {
            /*max-height: 300px;*/
            height: 100%;
        }
        .card-body p {
            text-align: justify;
        }
        /*#banner .heading p {*/
            /*font-size: 24px;*/
        /*}*/
    </style>
@endpush

@section('content')
    <div class="section d-none d-lg-block" id="banner">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="{{ asset('assets') }}/images/hotel.png" alt="First slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="{{ asset('assets') }}/images/hotel.png" alt="Second slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="{{ asset('assets') }}/images/hotel.png" alt="Third slide">
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
            <h4>Facilities</h4>
            <p class="text-justify">Facilities and stuff on details are in here to tell the potential costumer.</p>
        </div>
    </div>

    <div class="container mt-5">
        <div class="row">

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body p-0">
                        <div class="row no-gutters">
                            <div class="col-lg-6">
                                <img class="img-fluid w-100" src="{{ asset('assets') }}/images/splash.png">
                            </div>
                            <div class="col-lg-6 p-5">
                                <h4>Kai Adult Indoor Pool</h4>
                                <p class="text-justify">
                                    We are really proud about our pool, because who can resist not to dip? Intentionally built indoor, follows the contour of the earth surface. 25 x 6 meter long, feel the brezzy wind and dippin in the fresh water. Feel recharged!
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-body p-0">
                        <div class="row no-gutters">
                            <div class="col-lg-6 p-5">
                                <h4>Cingaripit Children Outdoor Pool</h4>
                                <p class="text-justify">
                                    Embrace children with nature elements, water, mother nature, and the sun. Built outdoor, encouraging children to stay active and healthy. Uniquely shaped, with slides & swing playground. Be active, keep healthy, and play along with us!
                                </p>
                            </div>
                            <div class="col-lg-6">
                                <img class="img-fluid w-100" src="{{ asset('assets') }}/images/features-1.png">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-body p-0">
                        <div class="row no-gutters">
                            <div class="col-lg-6">
                                <img class="img-fluid w-100" src="{{ asset('assets') }}/images/features-2.png">
                            </div>
                            <div class="col-lg-6 p-5">
                                <h4>Jogging Tracks</h4>
                                <p class="text-justify">
                                    Someone said, it's not really a jogging tracks, it's like a hiking tracks. How about try it yourself? With concrete-paving to make it comfortable and hassle free.                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-body p-0">
                        <div class="row no-gutters">
                            <div class="col-lg-6 p-5">
                                <h4>Children Playground</h4>
                                <p class="text-justify">
                                    Swings and slides are the classic of course. Built outdoor, with two swings, for toddles, and grown kids. Have some memorable time with your precious family.
                                </p>
                            </div>
                            <div class="col-lg-6">
                                <img class="img-fluid w-100" src="{{ asset('assets') }}/images/features-3.png">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-body p-0">
                        <div class="row no-gutters">
                            <div class="col-lg-6">
                                <img class="img-fluid w-100" src="{{ asset('assets') }}/images/features-2.png">
                            </div>
                            <div class="col-lg-6 p-5">
                                <h4>Kids Club</h4>
                                <p class="text-justify">
                                    <-- Coming Soon -->
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{--<div class="col-lg-12 mt-5">--}}
                {{--<div class="card">--}}
                    {{--<div class="card-body p-0">--}}
                        {{--<div class="row no-gutters">--}}
                            {{--<div class="col-lg-6 p-5">--}}
                                {{--<h4>Angsana</h4>--}}
                                {{--<p class="text-justify">--}}
                                    {{--Our deluxe Angsana room type is approximately 24m2 (258sq2) with terrace balcony. Accomodates with single king-sized bed, plush top mattress, flat-screen led television with the ability to stream personal content, coffe & tea maker for your comfort, and a balcony to enjoy Bandung's nightscape privately. Minimalist closet, strategically positioned to hold some wardrobe at your ease.--}}
                                {{--</p>--}}
                                {{--<p><b>Amenities:</b></p>--}}
                                {{--<ul>--}}
                                    {{--<li>Linen & Towels Provided</li>--}}
                                    {{--<li>Complimentary Toiletries</li>--}}
                                    {{--<li>Satellite TV</li>--}}
                                    {{--<li>Telephone</li>--}}
                                    {{--<li>Television</li>--}}
                                {{--</ul>--}}
                            {{--</div>--}}
                            {{--<div class="col-lg-6">--}}
                                {{--<img class="img-fluid w-100" src="{{ asset('assets') }}/images/features-3.png">--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}

            {{--<div class="col-lg-12 mt-5">--}}
                {{--<div class="card">--}}
                    {{--<div class="card-body p-0">--}}
                        {{--<div class="row no-gutters">--}}
                            {{--<div class="col-lg-6">--}}
                                {{--<img class="img-fluid w-100" src="{{ asset('assets') }}/images/features-2.png">--}}
                            {{--</div>--}}
                            {{--<div class="col-lg-6 p-5">--}}
                                {{--<h4>Mahoni</h4>--}}
                                {{--<p class="text-justify">--}}
                                    {{--Our exclusive Mahoni room type is approximately 36m2 (419sq2) with terrace balcony. Accomodates with single king-sized bed, plush top mattress, flat-screen led television with the ability to stream personal content, coffe & tea maker for your comfort, and a balcony to enjoy Bandung's nightscape privately. Minimalist closet, strategically positioned to hold some wardrobe at your ease.--}}
                                {{--<p><b>Amenities:</b></p>--}}
                                {{--<ul>--}}
                                    {{--<li>Linen & Towels Provided</li>--}}
                                    {{--<li>Complimentary Toiletries</li>--}}
                                    {{--<li>Satellite TV</li>--}}
                                    {{--<li>Telephone</li>--}}
                                    {{--<li>Television</li>--}}
                                {{--</ul>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}

            {{--<div class="col-lg-12 mt-5">--}}
                {{--<div class="card">--}}
                    {{--<div class="card-body p-0">--}}
                        {{--<div class="row no-gutters">--}}
                            {{--<div class="col-lg-6 p-5">--}}
                                {{--<h4>Sonokeling</h4>--}}
                                {{--<p class="text-justify">--}}
                                    {{--Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad adipisci at, consectetur corporis cupiditate deleniti dolores ea enim iure magnam magni maxime, molestiae quaerat quisquam repellendus sapiente sit totam veniam!--}}
                                {{--</p>--}}
                                {{--<p><b>Amenities:</b></p>--}}
                                {{--<ul>--}}
                                    {{--<li>Linen & Towels Provided</li>--}}
                                    {{--<li>Complimentary Toiletries</li>--}}
                                    {{--<li>Satellite TV</li>--}}
                                    {{--<li>Telephone</li>--}}
                                    {{--<li>Television</li>--}}
                                {{--</ul>--}}
                            {{--</div>--}}
                            {{--<div class="col-lg-6">--}}
                                {{--<img class="img-fluid w-100" src="{{ asset('assets') }}/images/features-3.png">--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}

        </div>
    </div>

    @include('frontend.templates.footer')

@endsection