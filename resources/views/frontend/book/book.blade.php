@extends('frontend.templates.main')

@push('title')
    Book
@endpush

@push('css')
    {{--<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>--}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css" />
@endpush

@push('js')
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
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
            /*z-index: 0;*/
        }
        .base img {
            width: 100%;
            position: absolute;
            margin: auto;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            /*z-index: 0;*/
        }
        .img-fluid {
            display: inline-block;
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

        .review, .price {
            line-height: 10px;
        }

        /*HOTEL FORM*/
        /*.hotel-form {*/
            /*border: 1px solid #9E9E9E;*/
            /*padding: 10px;*/
            /*border-radius: 7px;*/
            /*margin: 5px;*/
        /*}*/
        /*.hotel-form .form-control, .form-control:focus {*/
            /*border: 0;*/
            /*outline: 0;*/
            /*-webkit-box-shadow: none;*/
            /*box-shadow: none;*/
        /*}*/

        /*
        ROOM CARD STYLES
         */
        .room {
            -webkit-border-radius: 2px;
            -moz-border-radius: 2px;
            border-radius: 2px;
            border: 1px solid #BDBDBD;
            transition: background-color 0.5s ease;
            padding-bottom: 0;
            color: #212121;
            /*max-height: 200px;*/
        }
        .room:hover {
            background-color: #EEEEEE;
            /*cursor: pointer;*/
            color: #000000;
            text-decoration: none;
        }
        .detail {
            display: none;
        }
        .btnSubmit {
            z-index: 1000;
        }
        /*.carousel-control-prev, .carousel-control-next {*/
            /*!*left: 0;*!*/
            /*z-index: 2000;*/
        /*}*/
        .slick-prev:before {
            color: #212121;
        }
        .slick-next:before {
            color: #212121;
        }
        .slick-slider div {
            display: none;
        }

        .slick-slider:first-child {
             display: block;
        }

        .slick-slider.slick-initialized div {
            display: block;
        }

        .img-col{
            /*margin-top: -120px;*/
            overflow: hidden;
            width: 100%;
            height: 120px;
        }
        .img-col img{
            width: 100%;
            height: auto;
        }

    </style>
@endpush

@push('script')
    <script>
        $(document).ready(function(){
            $('.slick').slick();
            $('.btnSubmit').on('click', function(){
                var id = $(this).data('id');
                console.log(id);
                // var input = $(".inputId").data('id', id);
                $(".inputId" + id).prop('disabled', false);
                form.submit()
            });
            $(".expand").on( "click", function() {
                $(this).next().slideToggle(200);
                // $(this).('.slick').slick();
            });
            $(".roomIdBtn{{ @$featured->id }}").click(function() {
                $('html, body').animate({
                    scrollTop: $(".roomIdDiv{{ @$featured->id }}").offset().top
                }, 1000);
            });
        });
    </script>
@endpush

@php
function isWeekend($date) {
    return (date('N', strtotime($date)) >= 6);
}
@endphp

@section('content')
    <div class="base">
        <img class="img-fluid" src="{{ asset('assets') }}/images/hotel.png">
    </div>

    <div class="container my-4">
        <div class="row">
            <div class="col-lg-12">
                <h4 class="text-center">Bookings</h4>
                <p class="text-center">Discover the rooms Hotel Pondokan Tjiburial offers</p>
                @include('backend.templates.feedback')
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-lg-8">
                @if($featured->images->count() != 0)
                    <div class="px-3">
                        <div class="slick slick-slider">
                            @foreach(@$featured->images as $key => $photo)
                                <div class="slick-slide">
                                    <img class="d-block img-fluid w-100" src="{{ asset('uploads') . '/rooms/' . $featured->id . '/' . $photo->image }}" alt="Image {{ $key + 1 }}">
                                </div>
                            @endforeach
                        </div>
                    </div>
                @else
                    <div class="border p-5">
                        <h4 class="text-center">Coming Soon</h4>
                    </div>
                @endif
                {{--<div id="carouselFeatured" class="carousel slide" data-ride="carousel">--}}
                    {{--<ol class="carousel-indicators">--}}
                        {{--@foreach(@$featured->images as $key => $photo)--}}
                            {{--<li data-target="#carouselFeatured" data-slide-to="{{ $key }}"></li>--}}
                        {{--@endforeach--}}
                    {{--</ol>--}}
                    {{--<div class="carousel-inner">--}}
                        {{--@forelse(@$featured->images as $key => $photo)--}}
                            {{--<div class="carousel-item active">--}}
                                {{--<img class="d-block w-100" src="{{ asset('uploads') . '/rooms/' . $featured->name . '/' . $photo->image }}" alt="Image {{ $key + 1 }}">--}}
                            {{--</div>--}}
                        {{--@empty--}}
                            {{--<div class="carousel-item active">--}}
                                {{--<img class="d-block w-100" src="{{ asset('assets') }}/images/hotel.png" alt="No Image">--}}
                            {{--</div>--}}
                        {{--@endforelse--}}
                    {{--</div>--}}
                {{--</div>--}}
            </div>
            <div class="col-lg-4">
                <h2>{{ @$featured->name }}</h2>
                <h3 class="text-primary align-left">8.7 <small> / 10</small></h3>
                <p class="text-secondary">Based on 34 online reviews</p>
                <div class="review pt-3">
                    <p class="review-text">"Great View, Amazing Experience"</p>
                    <p class="review-people text-secondary">- Kevin T Gunawan, Google</p>
                </div>
                <div class="review pt-3">
                    <p class="review-text">"Great View, Amazing Experience"</p>
                    <p class="review-people text-secondary">- Kevin T Gunawan, Google</p>
                </div>
                <div class="price pt-5">
                    <p class="text-secondary">Starting from</p>
                    <h2>Rp {{ number_format(@$featured->allotment()->harga, 0, ',', '.') }}</h2>
                </div>
                <button class="btn btn-tjiburial roomIdBtn{{ @$featured->id }}">Choose Room</button>
            </div>
        </div>
        <form action="{{ url('/book') }}" method="post" id="form">
            {!! csrf_field() !!}
            <div class="row mt-5">
                <div class="col-lg-12">
                    @include("frontend.templates.booking-form")
                </div>
            </div>

            @if(!$rooms->isEmpty())
                @foreach($rooms as $room)
                    <div class="row mt-3">
                        <div class="col-lg-12">
                            <a class="card room roomIdDiv{{ $room->id }}" href="{{ url('book/room-detail/'.$room->id) }}">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-2 img-col">
                                            @if(!empty($room->images()->where('main', 1)->first()->image))
                                                <img class="img-fluid w-100" src="{{ asset('uploads') . '/rooms/'.$room->id.'/'.$room->images()->where('main', 1)->first()->image }}">
                                            @else
                                                <div class="border p-3">
                                                    <h5 class="text-center">Coming Soon</h5>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="col-lg-6">
                                            <h4>{{ $room->title }}</h4>
                                            {{--<p>--}}
                                                {{--Max guests {{ $room->max_guest }} person <br>--}}
                                                {{--@if($room->room_count - $room->reservation->count() > 0)--}}
                                                    {{--Rooms available: {{ ($room->room_count - $room->reservation->count()) }}--}}
                                                {{--@else--}}
                                                    {{--<span class="text-danger">Rooms available: 0</span>--}}
                                                {{--@endif--}}
                                            {{--</p>--}}
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="text-right">
                                                <h4>Rp {{ number_format($room->allotment()->harga, '0', ',', '.') }} <small> / night</small></h4>

                                                @if($room->installment == 1)
                                                    Terima cicilan untuk pemegang kartu kredit
                                                @else
                                                    Tidak ada cicilan
                                                @endif
                                                <input type="hidden" name="room_id" value="{{ $room->id }}" class="inputId{{ $room->id }}" disabled>
{{--                                                @if($room->room_count - $room->reservation->count() > 0)--}}
                                                    <button class="btn btn-tjiburial mt-2 text-light btnSubmit"
                                                            data-id="{{ $room->id }}">Book Now</button>
                                                {{--@else--}}
                                                    {{--<button class="btn btn-tjiburial mt-2 text-light disabled" disabled>Book Now</button>--}}
                                                {{--@endif--}}
                                            </div>
                                        </div>
                                    </div>]
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            @endif
        </form>
    </div>

    @include('frontend.templates.footer')

@endsection