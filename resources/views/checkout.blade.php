@extends('frontend.templates.main')

@push('title')
	Book {{ $room->name }}
@endpush

@push('css')
    <link href="{{ asset('css/jquery.fancybox.css') }}" rel="stylesheet">
@endpush

@push('js')
    <script type="text/javascript" src="https://api.sandbox.veritrans.co.id/v2/assets/js/veritrans.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.fancybox.pack.js') }}"></script>
@endpush

@push('script')
    <script>
        $(document).ready(function(){
            // Sandbox URL
            Veritrans.url = "https://api.sandbox.veritrans.co.id/v2/token";
            // TODO: Change with your client key.
            Veritrans.client_key = "VT-client-tsQabcFjwuwUuN7a";
            //Veritrans.client_key = "VT-client-h7ubdjqpcsLAQnjY";

            //Veritrans.client_key = "d4b273bc-201c-42ae-8a35-c9bf48c1152b";
            var card = function(){
                return {
                    'card_number'		: $(".card-number").val(),
                    'card_exp_month'	: $(".card-expiry-month").val(),
                    'card_exp_year'		: $(".card-expiry-year").val(),
                    'card_cvv'			: $(".card-cvv").val(),
                    'secure'			: false,
                    'bank'				: 'bni',
                    'gross_amount'		: 10000
                }
            };

            function callback(response) {
                if (response.redirect_url) {
                    // 3dsecure transaction, please open this popup
                    openDialog(response.redirect_url);

                } else if (response.status_code == '200') {
                    // success 3d secure or success normal
                    closeDialog();
                    // submit form
                    $(".submit-button").attr("disabled", "disabled");
                    $("#token_id").val(response.token_id);
                    $("#payment-form").submit();
                } else {
                    // failed request token
                    console.log('Close Dialog - failed');
                    //closeDialog();
                    //$('#purchase').removeAttr('disabled');
                    // $('#message').show(FADE_DELAY);
                    // $('#message').text(response.status_message);
                    //alert(response.status_message);
                }
            }

            function openDialog(url) {
                $.fancybox.open({
                    href: url,
                    type: 'iframe',
                    autoSize: false,
                    width: 700,
                    height: 500,
                    closeBtn: false,
                    modal: true
                });
            }

            function closeDialog() {
                $.fancybox.close();
            }

            $('.submit-button').click(function(event){
                event.preventDefault();
                //$(this).attr("disabled", "disabled");
                Veritrans.token(card, callback);
                return false;
            });
        });
    </script>
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

@section('content')
    {{--<div class="base">--}}
        {{--<img class="img-fluid" src="{{ asset('uploads') . '/rooms/'.$room->name.'/'.$room->photos()->where('main', 1)->first()->image }}">--}}
    {{--</div>--}}

    <div class="container">
        <div class="row">
            <div class="col-lg-12 mt-5">
                <div class="card mt-5">
                    <div class="card-body">
                        <h1>Checkout</h1>
                        <form action="vtdirect" method="POST" id="payment-form">
                            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                            <fieldset>
                                {{--<legend>Checkout</legend>--}}
                                <div class="form-group">
                                    <label for="card-number">Card Number</label>
                                    <input class="card-number form-control" id="card-number" value="4011111111111112" size="20" type="text" autocomplete="off"/>
                                </div>
                                <div class="form-row">
                                    <div class="col-3">
                                        <label>Expiration (MM/YYYY)</label>
                                    </div>
                                    <div class="col-3">
                                        <input class="card-expiry-month form-control" value="12" placeholder="MM" size="2" type="text" />
                                    </div>
                                    <div class="col-3">
                                        <span> / </span>
                                    </div>
                                    <div class="col-3">
                                        <input class="card-expiry-year form-control" value="2018" placeholder="YYYY" size="4" type="text" />
                                    </div>
                                </div>
                                <p>
                                    <label>CVV</label>
                                    <input class="card-cvv" value="123" size="4" type="password" autocomplete="off"/>
                                </p>

                                <p>
                                    <label>Save credit card</label>
                                    <input type="checkbox" name="save_cc" value="true">
                                </p>

                                <input id="token_id" name="token_id" type="hidden" value="{{ $snap_token }}" />
                                <button class="submit-button" type="submit">Submit Payment</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection