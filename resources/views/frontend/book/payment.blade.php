@extends('frontend.templates.main')

@push('title')
    Payment
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
        .expand {
            cursor: pointer;
        }
        .expand:hover {
            color: #555;
        }
        .detail {
            margin: 10px 0 10px 0px;
            display: none;
            line-height: 22px;
            padding: 20px 0 10px 0;
        }
        .detail a {
            text-decoration: none;
        }
        .right-arrow {
            margin-left: 20px;
            width: 10px;
            height: 100%;
            float: right;
            font-weight: bold;
            font-size: 20px;
        }
        .formMidtrans{
            animation: fadeIn .7s ease-in-out;
        }
        .hidden{
            display: none !important;
            animation: fadeOut .7s ease-out;
        }
        @keyframes fadeIn{
            from{
                opacity: 0;
            }
            to{
                opacity: 1;
            }
        }
        @keyframes fadeOut{
            from{
                opacity: 1;
            }
            to{
                opacity: 0;
            }
        }
    </style>
@endpush

@push('script')
    <script>
        $(document).ready(function(){
            $(".expand").on( "click", function() {
                $(this).next().slideToggle(200);
                $expand = $(this).find(">:first-child");

                if($expand.text() == "+") {
                    $expand.text("-");
                } else {
                    $expand.text("+");
                }
            });

            $('[name="payment"]').on('change', function(){
                var val = $(this).val();
                // payment = val;

                if(val === 'Midtrans'){
                    $('.formMidtrans').removeClass('hidden');
                }else{
                    $('.formMidtrans').addClass('hidden');
                }
            });
            $('[name="payment"]').change();
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
    <div class="container mt-3">
        <div class="row">
            <div class="col-lg-7">
                <div class="card">
                    <div class="card-body">
                        <h4>Payment Details</h4>
                        <form action="{{ url('book/payment') }}" method="post">
                            <div class="form-group">
                                <label for="">Select payment method :</label>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="midtrans" name="payment" class="custom-control-input" value="Midtrans">
                                    <label class="custom-control-label" for="midtrans">Midtrans</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="onsite" name="payment" class="custom-control-input" checked value="Onsite">
                                    <label class="custom-control-label" for="onsite">Directly at Hotel</label>
                                </div>
                            </div>
                            <div class="formMidtrans">
                                <div class="card border">
                                    <div class="card-body">
                                        <h5>Pay using Midtrans</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-tjiburial mt-3">Finish Booking</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body expand">
                                <div class="right-arrow">+</div>
                                <h4>Guest Details</h4>
                            </div>
                            <div class="table-responsive detail">
                                <table class="table table-vcenter card-table table-detail">
                                    <tbody>
                                    <tr>
                                        <td>Guest Name :</td>
                                        <td>{{ $booking['title'] . ' ' . $booking['name'] }}</td>
                                    </tr>
                                    <tr>
                                        <td>E-Mail :</td>
                                        <td>{{ $booking['email'] }}</td>
                                    </tr>
                                    <tr>
                                        <td>Date of Birth :</td>
                                        <td>{{ $booking['dob']->format('l, F jS Y') }}</td>
                                    </tr>
                                    <tr>
                                        <td>Nationality :</td>
                                        <td>{{ $booking['nationality'] }}</td>
                                    </tr>
                                    <tr>
                                        <td>Address :</td>
                                        <td>{{ $booking['address'] }}</td>
                                    </tr>
                                    <tr>
                                        <td>Country :</td>
                                        <td>{{ $booking['country'] }}</td>
                                    </tr>
                                    <tr>
                                        <td>State :</td>
                                        <td>{{ $booking['state'] }}</td>
                                    </tr>
                                    <tr>
                                        <td>City :</td>
                                        <td>{{ $booking['city'] }}</td>
                                    </tr>
                                    <tr>
                                        <td>Postal Code :</td>
                                        <td>{{ $booking['postal'] }}</td>
                                    </tr>
                                    <tr>
                                        <td>Phone :</td>
                                        <td>{{ $booking['phone_code'] . '' . $booking['phone_no'] }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 mt-3">
                        <div class="card">
                            <div class="card-body expand">
                                <div class="right-arrow">+</div>
                                <h4>Reservation Details</h4>
                            </div>
                            <div class="table-responsive detail">
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
                            {{--<div class="table-responsive">--}}
                            {{--</div>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    @include('frontend.templates.footer')

@endsection