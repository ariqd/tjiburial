@extends('frontend.templates.main')

@push('title')
    About
@endpush

@push('style')
    <style>
        .navbar {
            /*position: absolute;*/
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

        .card {
            -webkit-border-radius: 0;
            -moz-border-radius: 0;
            border-radius: 0;
            border: 0;
        }

        input, textarea {
            border: 0;
        }
    </style>
@endpush

@section('content')
    <div class="base">
        <img class="img-fluid" src="{{ asset('assets') }}/images/contact.png">
    </div>
    <div class="container">
        <div class="row my-4">
            <div class="col-lg-6 mt-3">
                <h4>Contact Us</h4>
                <p class="mt-3">
                    <b>Hotel Address</b> <br>
                    Jl Bukit Pakar Timur No. 33
                    <br><br>
                    <b>Phone</b> <br>
                    +62 22 204 65 111 <br>
                    +62 22 204 65 222 <br>
                    <br>
                    <b>Email</b> <br>
                    pondokantjiburialbdg@gmail.com
                </p>
            </div>
            <div class="col-lg-6">
                <div class="card bg-light">
                    <div class="card-body">
                        <fieldset>
                            <h4 class="mb-3">Message Us</h4>
                            <form action="#">
                                <div class="form-row">
                                    <div class="col">
                                        <input type="text" name="firstname" class="form-control" placeholder="First Name*">
                                    </div>
                                    <div class="col">
                                        <input type="text" name="lastname" class="form-control" placeholder="Last Name*">
                                    </div>
                                </div>
                                <div class="form-row mt-3">
                                    <div class="col">
                                        <input type="email" name="email" class="form-control" placeholder="Email*">
                                    </div>
                                    <div class="col">
                                        <input type="text" name="phone" class="form-control" placeholder="Phone">
                                    </div>
                                </div>
                                <div class="form-group mt-3">
                                    <textarea name="message" id="message" rows="6" class="form-control" placeholder="Message"></textarea>
                                </div>
                                <button type="submit" class="btn btn-dark float-right">Send</button>
                            </form>
                        </fieldset>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('frontend.templates.footer')

@endsection