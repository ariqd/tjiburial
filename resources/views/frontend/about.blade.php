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
    </style>
@endpush

@section('content')
    <div class="base">
        <img class="img-fluid" src="{{ asset('assets') }}/images/about.png">
    </div>
    <div class="container">
        <div class="row my-4">

            {{--<div class="col-lg-2 text-center my-auto">--}}
            {{--<img class="img-fluid" src="{{ asset('assets') }}/images/logo-big.png">--}}
            {{--</div>--}}
            <div class="col-lg-12">
                @include('backend.templates.feedback')
                <h3 class="my-3">About Pondokan Tjiburial </h3>
                <div class="mt-lg-0 mt-md-4 mt-sm-4">
                    Previously just another empty space below the Sierra cafe & Lounge, our founder had a vision to create a place for people to rest, relax and have a shared experience of living in the most scenic area. The view of Bandung cityscape and enclosed forest will give you an unforgettable experience. Consisting of 40 spacious rooms that are fully facilitated and well furnished for an enjoyable and memorable stay.
                </div>
            </div>
        </div>
        <div class="row my-2">
            <div class="col-lg-12">
                <p>
                    Pondokan Tjiburial, an ideal place to spend your precious moment in nature, built thoughtfully with compassion of the founding family. Be natural, feel nature and may our earth be more sustainable  for the next generation.
                </p>
                <p>
                    Located on Dago Pakar, feel & breath the fresh air, and enjoy Bandung nightscape as our speciality. With our hospitality, may your stay be memorable and comfortable.
                </p>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row my-4">
            <div class="col-lg-6 mt-3">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3961.2296543555253!2d107.62732121431732!3d-6.86305819504039!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e723b2ddc3fd%3A0xcf1a6bdf1a56f76f!2sJl.+Bukit+Pakar+Timur+No.33%2C+Ciburial%2C+Cimenyan%2C+Bandung%2C+Jawa+Barat+40198!5e0!3m2!1sid!2sid!4v1527653824816"height="450" frameborder="0" style="border:0;width:100%;" allowfullscreen></iframe>
                <div class="row mt-2">
                    <div class="col-6">
                        <b>Hotel Address</b> <br>
                        Jl Bukit Pakar Timur No. 33
                    </div>
                    <div class="col-6">
                        <b>Phone</b> <br>
                        +62 22 204 65 111 <br>
                        +62 22 204 65 222 <br>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mt-3">
                <div class="card bg-light">
                    <div class="card-body">
                        <h5 class="mb-3">Message Us</h5>
                        <fieldset>
                            <form action="{{ url('contact/send-message') }}" method="post">
                                @csrf
                                <div class="form-row">
                                    <div class="col">
                                        <label for="name">Your Name</label>
                                        <input type="text" id="name" name="name" class="form-control">
                                    </div>
                                    <div class="col">
                                        <label for="email">Email</label>
                                        <input type="email" id="email" name="email" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group mt-3">
                                    <label for="phone">Subject Message</label>
                                    <input type="text" name="subject" class="form-control" id="subject">
                                </div>
                                <div class="form-group mt-3">
                                    <label for="message">Message</label>
                                    <textarea name="message" id="message" rows="6" class="form-control"></textarea>
                                </div>
                                <button type="submit" class="btn btn-dark">Send</button>
                            </form>
                        </fieldset>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('frontend.templates.footer')

@endsection