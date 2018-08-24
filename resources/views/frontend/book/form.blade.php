@extends('frontend.templates.main')

@push('title')
    Book {{ $room->name }}
@endpush

@push('css')
    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/select2/select2.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/select2/select2-bootstrap.min.css">
@endpush

@push('js')
    <script src="{{ asset('assets') }}/plugins/select2/select2.full.min.js"></script>
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
    </style>
@endpush

@push('script')
    <script>
        $(document).ready(function(){
            $('.select2-single').select2({
                "theme" : "bootstrap"
            });
        });
    </script>
@endpush

@php
    $check_in_date = Carbon\Carbon::createFromFormat('Y-m-d', $reservation['check_in']);
@endphp

@section('content')
    <div class="base">
        <img class="img-fluid" src="{{ asset('uploads') . '/rooms/'.$room->name.'/'.$room->photos()->where('main', 1)->first()->image }}">
    </div>
    <div class="container my-3">
        <div class="row">
            <div class="col-lg-7">
                <div class="card">
                    <div class="card-body">
                        <h4>Guest Detail</h4>
                        <hr>
                        @include('backend.templates.feedback')
                        <form action="{{ url('book/book-now') }}" method="post">
                            {{ csrf_field() }}
                            <div class="form-row">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="title">Title <span class="required">*</span></label>
                                        <select name="title" id="title" class="custom-select">
                                            <option value="Mr." {{ @old('title') == 'Mr.' ? 'selected' : (@$guest->title == 'Mr.' ? 'selected' : '') }}>Mr.</option>
                                            <option value="Ms." {{ @old('title') == 'Ms.' ? 'selected' : (@$guest->title == 'Ms.' ? 'selected' : '') }}>Ms.</option>
                                            <option value="Mrs." {{ @old('title') == 'Mrs.' ? 'selected' : (@$guest->title == 'Mrs.' ? 'selected' : '') }}>Mrs.</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-9">
                                    <div class="form-group">
                                        <label for="name">Full Name <span class="required">*</span></label>
                                        <input type="text" class="form-control" id="name" name="name" value="{{ (@old('name')) ? old('name') : @$guest->name }}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email">Email Address <span class="required">*</span></label>
                                <input type="text" class="form-control" id="email" name="email" value="{{ (@old('email')) ? old('email') : @$guest->email }}">
                            </div>
                            <div class="form-row">
                                <div class="col-12">
                                    <label class="label">Date of Birth <span class="required">*</span></label>
                                </div>
                                <div class="col-5">
                                    <div class="form-group">
                                        <label class="label">Month <span class="required">*</span></label>
                                        <select name="dob[month]" class="form-control custom-select select2-single" data-placeholder="Select Month">
                                            <option></option>
                                            @foreach($month as $i => $row)
                                                @if($i == 0) @continue @endif
                                                <option value="{{ $i }}" {{ (@old('dob[month]') == $i) ? 'selected' : ((@date('m', strtotime($guest->dob)) == $i && @$guest->dob) ? 'selected' : '') }}>{{ $row }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label class="label">Day <span class="required">*</span></label>
                                        <select name="dob[day]" class="form-control custom-select select2-single" data-placeholder="Select Date">
                                            <option></option>
                                            @for($i=1; $i <= 31; $i++)
                                                <option value="{{ $i }}" {{ (@old('dob[day]') == $i) ? 'selected' : ((@date('d', strtotime($guest->dob)) == $i && @$guest->dob) ? 'selected' : '') }}>{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label class="label">Year <span class="required">*</span></label>
                                        <select name="dob[year]" class="form-control custom-select select2-single" data-placeholder="Select Year">
                                            <option></option>
                                            @for($i= date('Y'); $i >= 1897; $i--)
                                                <option value="{{ $i }}" {{ (@old('dob[year]') == $i) ? 'selected' : ((@date('Y', strtotime($guest->dob)) == $i && @$guest->dob) ? 'selected' : '') }}>{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="nationality">Nationality <span class="required">*</span></label>
                                <select name="nationality" id="nationality" data-name="[nationality]" class="form-control custom-select select2-single text-left" data-placeholder="Select Nationality">
                                    <option></option>
                                    @foreach($countries as $country)
                                        <option value="{{ $country['name'] }}">{{ $country['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-12">
                                        <label class="label">Address <span class="required">*</span></label>
                                    </div>
                                    <div class="col-6">
                                        <label for="country" class="bmd-label-floating">Country <span class="required">*</span></label>
                                        <select class="form-control custom-select select2-single text-left" data-name="[country]" id="country" data-placeholder="Select Country" name="country">
                                            <option></option>
                                            @foreach($countries as $country)
                                                <option value="{{ $country['name'] }}">{{ $country['name'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="province" class="bmd-label-floating">Province / State <span class="required">*</span></label>
                                            <input type="text" class="form-control" id="province" data-name="[state]" name="state">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="city" class="bmd-label-floating">City <span class="required">*</span></label>
                                            <input type="text" class="form-control" id="city" data-name="[city]" name="city">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="postal" class="bmd-label-floating">Postal Code <span class="required">*</span></label>
                                            <input type="text" class="form-control" id="postal" data-name="[postal]" name="postal">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="address" class="bmd-label-floating">Address <span class="required">*</span></label>
                                            <textarea name="address" id="address" rows="5" class="form-control"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="phone_code" class="label">Phone Code <span class="required">*</span></label>
                                        <select name="phone_code" id="phone_code" class="custom-select form-control select2-single">
                                            @foreach($countries as $country)
                                                <option value="{{ $country['dial_code'] }}" {{ (@old('phone_code') == $country['dial_code']) ? 'selected' : ((@$guest->phone_code == $country['dial_code']) ? 'selected' : '') }}>{{ $country['name'].' ('.$country['dial_code'].')' }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <div class="form-group">
                                        <label for="phone" class="label">Phone Number <span class="required">*</span></label>
                                        <input type="text" class="form-control" id="phone" aria-describedby="phoneHelp" name="phone_no" value="{{ (@old('phone_no')) ? old('phone_no') : @$guest->phone_no }}" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="text-center my-2">
                                <button type="submit" class="btn btn-tjiburial">Confirm Reservation</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="card">
                    <div class="card-body">
                        <h4>Reservation Detail</h4>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-vcenter card-table table-detail">
                            <tbody>
                            <tr>
                                <td>Room Name:</td>
                                <td>{{ $room->name }}</td>
                            </tr>
                            <tr>
                                <td>Check In Date:</td>
                                <td>{{ $check_in_date->format('l, F jS Y') }}</td>
                            </tr>
                            <tr>
                                <td>Check Out Date:</td>
                                <td>{{ $check_in_date->addDays($reservation['duration'])->format('l, F jS Y') }}</td>
                            </tr>
                            <tr>
                                <td>Duration:</td>
                                <td>{{ $reservation['duration'] }} Night(s)</td>
                            </tr>
                            <tr>
                                <td>Guest:</td>
                                <td>{{ $reservation['guest_count'] }}</td>
                            </tr>
                            <tr>
                                <td>Rooms:</td>
                                <td>{{ $reservation['room_count'] }} Room(s)</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-vcenter card-table table-detail">
                            <tbody>
                            @foreach($reservation['pricing'] as $key => $value)
                                <tr>
                                    <td>{{ $value['date'] }}</td>
                                    <td>{{ $key > 1 ? '+' : '' }} Rp {{ number_format($value['price'], 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td><b>Price / room</b></td>
                                <td><b>Rp {{ number_format($reservation['total'], 0, ',', '.') }}</b></td>
                            </tr>
                            <tr>
                                <td>x No. of Rooms</td>
                                <td>x {{ $reservation['room_count'] }}</td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <b>Total Price:</b>
                                    <br>
                                    <h2 class="text-right">Rp {{ number_format($reservation['total'] * $reservation['room_count'], 0, ',', '.') }}</h2>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('frontend.templates.footer')

@endsection