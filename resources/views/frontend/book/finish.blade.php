@extends('frontend.templates.main')

@push('title')
    Book {{ $room->name }}
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
        .img-fluid {
            display: inline-block;
        }
        .required {
            color: red;
            font-weight: bold;
        }

        .table-detail tr td{
            padding: 5px 20px;
        }
        a.btn-tjiburial:hover {
            color: #fefefe;
        }
    </style>
@endpush

@section('content')
    <div class="base">
        <img class="img-fluid" src="{{ asset('uploads') . '/rooms/'.$room->name.'/'.$room->photos()->where('main', 1)->first()->image }}">
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card mt-3">
                    <div class="card-body">
                        <h1>Booking Finished!</h1>
                        <a href="{{ url('/') }}" class="btn btn-tjiburial">Back to Home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('frontend.templates.footer')
@endsection
