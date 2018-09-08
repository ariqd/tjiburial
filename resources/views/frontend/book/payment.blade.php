@extends('frontend.templates.main')

@push('title')
    Payment
@endpush

@push('css')
    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/select2/select2.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/select2/select2-bootstrap.min.css">
@endpush

@push('js')
    <script src="{{ asset('assets') }}/plugins/select2/select2.full.min.js"></script>
    <script src="{{ asset('assets') }}/plugins/sweetalert/sweetalert.min.js"></script>
    <script type="text/javascript"
            src="https://app.sandbox.midtrans.com/snap/snap.js"
            data-client-key="SB-Mid-client-VhrdXfsNQARuMh4z"></script>
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

        .modal-body {
            overflow: auto;
            height: 400px;
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
        .required {
            color: red;
            font-weight: bold;
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
            $('.select2-single').select2({
                "theme" : "bootstrap"
            });

            $(".expand").on( "click", function() {
                $(this).next().slideToggle(200);
                $expand = $(this).find(">:first-child");

                if($expand.text() == "+") {
                    $expand.text("-");
                } else {
                    $expand.text("+");
                }
            });

            $('#direct-button').click(function (e) {
                e.preventDefault();
                swal({
                    title: "Are you sure?",
                    text: "Your payment will be deducted when checking in.",
                    icon: "info",
                    buttons: true,
                })
                    .then(function(okay){
                        if (okay) {
                            $('#myModal').modal('show');
                            $('#myModal').on('hidden.bs.modal', function (e) {
                                $('#okay').on('click', function () {
                                    $('#direct').submit();
                                });
                            })
                        }
                    });
            });

            $('#pay-button').click(function (event) {
                event.preventDefault();

                $('#myModal').modal('show');
                $('#okay').on('click', function () {
                    $('#myModal').modal('hide');
                    $('#pay-button').html("Please Wait...");
                    $('#pay-button').attr("disabled", "disabled");
                    $('#myModal').on('hidden.bs.modal', function (e) {
                        $.ajax({

                            url: '{{ url('book/payment/getSnapToken') }}',
                            cache: false,

                            success: function(data) {
                                //location = data;

                                console.log('token = '+data);

                                // var resultType = document.getElementById('result-type');
                                // var resultData = document.getElementById('result-data');

                                function changeResult(type,data){
                                    $("#result-type").val(type);
                                    $("#result-data").val(JSON.stringify(data));
                                    //resultType.innerHTML = type;
                                    //resultData.innerHTML = JSON.stringify(data);
                                }

                                snap.pay(data, {

                                    onSuccess: function(result){
                                        changeResult('success', result);
                                        console.log(result.status_message);
                                        console.log(result);
                                        $("#payment-form").submit();
                                    },
                                    onPending: function(result){
                                        changeResult('pending', result);
                                        console.log(result.status_message);
                                        $("#payment-form").submit();
                                    },
                                    onError: function(result){
                                        changeResult('error', result);
                                        console.log(result.status_message);
                                        $("#payment-form").submit();
                                    }
                                });
                            }
                        });

                    });

                });

            });
        });
    </script>
@endpush

@php
    $check_in_date = Carbon\Carbon::createFromFormat('Y-m-d', $reservation['check_in']);
@endphp

@section('content')
    <div class="base">
        @if(!empty($room->photos()->where('main', 1)->first()->image))
            <img class="img-fluid" src="{{ asset('uploads') . '/rooms/'.$room->name.'/'.$room->photos()->where('main', 1)->first()->image }}">
        @else
            <div class="border p-5" style="margin-top: 100px;">
                <h4 class="text-center">Coming Soon</h4>
            </div>
        @endif
    </div>
    <div class="container mt-3">
        <div class="row">
            <div class="col-lg-7">
                <div class="card mb-3">
                    <div class="card-body">
                        <h4>Payment Details</h4>
                        <h5>Choose Payment Method :</h5>
                        <div class="border py-3">
                            <form action="{{ url('book/payment') }}" method="post" id="payment-form">
                                {!! csrf_field() !!}
                                <div class="text-center">
                                    <input type="hidden" name="result_type" id="result-type" value="">
                                    <input type="hidden" name="result_data" id="result-data" value="">
                                    <b>Pay using Credit Card, Bank Transfer, Virtual Account, etc.</b><br>
                                    <small>Supported by Midtrans</small><br>
                                    <button type="submit" class="btn btn-tjiburial mt-3" id="pay-button">Click here to pay now</button>
                                </div>
                            </form>
                        </div>
                        <div class="text-center mt-4">
                            <h4>Or</h4>
                        </div>
                        <div class="text-center mt-2">
                            <form action="{{ url('book/payment') }}" id="direct" method="post">
                                {!! csrf_field() !!}
                                <input type="hidden" name="payment_type" value="direct">
                                <input type="hidden" name="result_type" value="success">
                                <button type="submit" class="btn btn-secondary mt-3" id="direct-button">Pay when Check In</button>
                            </form>
                        </div>
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

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Terms & Conditions</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {!! $terms->body !!}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="okay">I Agree</button>
                </div>
            </div>
        </div>
    </div>

    @include('frontend.templates.footer')

@endsection
