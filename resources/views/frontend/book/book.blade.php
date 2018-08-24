@extends('frontend.templates.main')

@push('title')
    Book
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
        .hotel-form {
            border: 1px solid #9E9E9E;
            padding: 10px;
            border-radius: 7px;
            margin: 5px;
        }
        .hotel-form .form-control, .form-control:focus {
            border: 0;
            outline: 0;
            -webkit-box-shadow: none;
            box-shadow: none;
        }

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
        }
        .room:hover {
            background-color: #EEEEEE;
            cursor: pointer;
        }
        .detail {
            display: none;
        }
        .btnSubmit {
            z-index: 1000;
        }
    </style>
@endpush

@push('script')
    <script>
        $(document).ready(function(){
            $('.btnSubmit').on('click', function(){
                var id = $(this).data('id');
                console.log(id);
                // var input = $(".inputId").data('id', id);
                $(".inputId" + id).prop('disabled', false);
                form.submit()
            });
            $(".expand").on( "click", function() {
                $(this).next().slideToggle(200);
            });
            $(".roomIdBtn{{ @$featured->id }}").click(function() {
                $('html, body').animate({
                    scrollTop: $(".roomIdDiv{{ $featured->id }}").offset().top
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
                <img class="img-fluid w-100" src="{{ asset('uploads') . '/rooms/'.$featured->name.'/'.$featured->photos()->where('main', 1)->first()->image }}">
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
                    <h2>Rp {{ number_format(@$featured->price, 0, ',', '.') }}</h2>
                </div>
                <button class="btn btn-tjiburial roomIdBtn{{ @$featured->id }}">Choose Room</button>
            </div>
        </div>
        <form action="{{ url('/book') }}" method="post">
            {!! csrf_field() !!}
            <div class="row mt-5">
                <div class="col-lg-12">
                    <div class="row hotel-form">
                        <div class="col-lg-3">
                            <div class="form-row d-flex justify-content-between align-items-center border-right p-2">
                                <div class="col-10">
                                    <label for="check_in_date" class="hotel-form-label mb-1"><b>Check In</b></label>
                                    <input type="date" class="form-control" name="check_in_date" id="check_in_date" min="{{ date('Y-m-d') }}">
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
                                    <select name="duration" id="duration" class="form-control custom-select" required>
                                        @foreach($duration as $key => $value)
                                            <option value="{{ $key + 1 }}">{{ $value }}</option>
                                        @endforeach
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
                                    <select name="guest" id="guest" class="form-control custom-select" required>
                                        @foreach($guest as $key => $value)
                                            <option value="{{ $value }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
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
                                        @foreach($rooms_count as $key => $value)
                                            <option value="{{ $key + 1 }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-2">
                                    <img src="{{ asset('assets') }}/images/rooms.png" alt="rooms">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if(!$rooms->isEmpty())
                @foreach($rooms as $room)
                    <div class="row mt-3">
                        <div class="col-lg-12">
                            <div class="card room roomIdDiv{{ $room->id }}">
                                <div class="card-body">

                                    <div class="expand">
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <img class="img-fluid w-100" src="{{ asset('uploads') . '/rooms/'.$room->name.'/'.$room->photos()->where('main', 1)->first()->image }}">
                                            </div>
                                            <div class="col-lg-6">
                                                <h3>{{ $room->name }}</h3>
                                                <p class="text-secondary">Max guests {{ $room->max_guest }} person</p>
                                                <div class="text-secondary">
                                                    <h5>Special Features:</h5>
                                                    {!! $room->specials !!}
                                                </div>
                                            </div>
                                            <div class="col-lg-3 text-right">
                                                @if(isWeekend(date('Y-m-d')))
                                                    <h4>Rp {{ number_format($room->price_weekend, '0', ',', '.') }} <small> / night</small></h4>
                                                @else
                                                    <h4>Rp {{ number_format($room->price, '0', ',', '.') }} <small> / night</small></h4>
                                                @endif
                                                <p class="text-primary">Inclusive of taxes</p>
                                                @if($room->installment == 1)
                                                    <p>Installment is available for credit cardholders</p>
                                                @else
                                                    <p>No installment available</p>
                                                @endif
                                                <input type="hidden" name="room_id" value="{{ $room->id }}" class="inputId{{ $room->id }}" disabled>
                                                <button class="btn btn-tjiburial text-light btnSubmit" data-id="{{ $room->id }}">Book Now</button>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="text-center">
                                                    <i class="fa fa-chevron-down"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="detail mt-3">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <img class="img-fluid w-100" src="{{ asset('uploads') . '/rooms/'.$room->name.'/'.$room->photos()->where('main', 1)->first()->image }}">
                                            </div>
                                            <div class="col-lg-6">
                                                <h4 class="text-bold">Room Overview</h4>
                                                {!! $room->overview !!}
                                                <h4 class="text-bold">Basic Facilities</h4>
                                                {!! $room->facilities !!}
                                                <h4 class="text-bold">Amenities</h4>
                                                {!! $room->amenities !!}
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </form>
    </div>

    @include('frontend.templates.footer')

@endsection