@extends('frontend.templates.main')

@push('title')
    {{ $room->title }}
@endpush

@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css" />
@endpush

@push('js')
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
@endpush

@push('style')
    <style>
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

        .room-snippet {
            /*text-align: center;*/
        }
        .room-snippet .snippet-head {
            /*margin-bottom: 0;*/
        }
        .room-snippet .snippet-body {
            font-size: 1.25em;
            /*margin-bottom: 0;*/
            /*padding-bottom: 0;*/
            font-weight: 700;
        }

    </style>
@endpush

@push('script')
    <script>
        $(document).ready(function(){
            $('.slick').slick();
        });
    </script>
@endpush

@php
    function isWeekend($date) {
        return (date('N', strtotime($date)) >= 6);
    }
@endphp

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-5">
                @if($room->images->count() != 0)
                    <div class="px-3">
                        <div class="slick slick-slider">
                            @foreach(@$room->images as $key => $photo)
                                <div class="slick-slide">
                                    <img class="d-block img-fluid w-100" src="{{ asset('uploads') . '/rooms/' . $room->id . '/' . $photo->image }}" alt="Image {{ $key + 1 }}">
                                </div>
                            @endforeach
                        </div>
                    </div>
                @else
                    <div class="border p-5">
                        <h4 class="text-center">Coming Soon</h4>
                    </div>
                @endif
            </div>
            <div class="col-lg-7 my-auto">
                <h1>{{ $room->title }}</h1>
                <h4>{{ $room->tipe_kamar }}</h4>
                <h3 class="pt-3">
                    <small>Price</small>
                    <br>
                    Rp {{ number_format($room->allotment()->harga, '0', ',', '.') }} <small> / night</small>
                </h3>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ url('/book') }}" method="post" id="form">
                            {!! csrf_field() !!}
                            <input type="hidden" value="{{ $room->id }}" name="room_id">
                            @include("frontend.templates.booking-form")
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5 class="card-title">Facilities</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @forelse($room->facilities as $facility)
                                <div class="col-lg-4 my-2">
                                    <p><b><i class="fa fa-check text-success"></i> {{ $facility->name }}</b></p>
                                </div>
                            @empty
                                <div class="col-lg-12 text-center">
                                    <h3>Room has no facility</h3>
                                    <a href="{{ url('admin/rooms/'. $room->id .'/edit') }}" class="btn btn-primary"><i class="fe fe-plus"></i> Add Facility</a>
                                </div>
                            @endforelse
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <hr>
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <b>Breakfast</b>
                                        <h5>
                                            @if($room->breakfast)
                                                <i class="fa fa-check text-success"></i> Included
                                            @else
                                                <i class="fa fa-times text-danger"></i> Not Included
                                            @endif
                                        </h5>
                                    </div>
                                    <div>
                                        <b>Wi-Fi</b>
                                        <h5>
                                            @if($room->wifi)
                                                <i class="fa fa-check text-success"></i> Available
                                            @else
                                                <i class="fa fa-times text-danger"></i> Unavailable
                                            @endif
                                        </h5>
                                    </div>
                                    <div>
                                        <b>Smoking Room</b>
                                        <h5>
                                            @if($room->wifi)
                                                <i class="fa fa-check text-success"></i> Yes
                                            @else
                                                <i class="fa fa-times text-danger"></i> No
                                            @endif
                                        </h5>
                                    </div>
                                    <div>
                                        <b>Terrace</b>
                                        <h5>
                                            @if($room->has_terrace)
                                                <i class="fa fa-check text-success"></i> Available
                                            @else
                                                <i class="fa fa-times text-danger"></i> Unavailable
                                            @endif
                                        </h5>
                                    </div>
                                    <div>
                                        <b>Room Size</b>
                                        <h5>
                                            @if($room->room_size_terrace)
                                                <i class="fa fa-check text-success"></i> Terrace
                                            @else
                                                <i class="fa fa-times text-danger"></i> Regular
                                            @endif
                                            {{--({{ $room->room_size }})--}}
                                        </h5>
                                    </div>
                                    <div>
                                        <b>24-hour use</b>
                                        <h5>
                                            @if($room->day_use_room)
                                                <i class="fa fa-check text-success"></i> Available
                                            @else
                                                <i class="fa fa-times text-danger"></i> -
                                            @endif
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5 class="card-title">Description</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="d-flex justify-content-start">
                                    <div>
                                        <b>1st Bed Type</b>
                                        <h5>
                                            <i class="fa fa-bed"></i> {{ $room->bed_type1 }}
                                        </h5>
                                    </div>
                                    @if(!empty($room->bed_type2))
                                        <div class="ml-3">
                                            <b>2nd Bed Type</b>
                                            <h5>
                                                <i class="fa fa-bed"></i> {{ $room->bed_type2 }}
                                            </h5>
                                        </div>
                                    @endif
                                    @if(!empty($room->bed_type3))
                                        <div class="ml-3">
                                            <b>3rd Bed Type</b>
                                            <h5>
                                                <i class="fa fa-bed"></i> {{ $room->bed_type3 }}
                                            </h5>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <hr>
                                {!! $room->desc !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('frontend.templates.footer')
@endsection