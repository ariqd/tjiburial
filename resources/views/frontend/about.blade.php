@extends('frontend.templates.main')

@push('title')
    About
@endpush

@push('style')
    <style>
        .navbar {
            position: absolute;
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
            <div class="col-lg-12">
                <h3 class="mb-3">About Pondokan Tjiburial </h3>
                <p>
                    Pondokan Tjiburial, an ideal place to spend your precious moment in nature, built thoughtfully with compassion of the founding family. Be natural, feel nature and may our earth be more sustainable  for the next generation.
                </p>
                <p>
                    Located on Dago Pakar, feel & breath the fresh air, and enjoy Bandung nightscape as our speciality. With our hospitality, may your stay be memorable and comfortable.
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-2 text-center">
                <img class="img-fluid" src="{{ asset('assets') }}/images/logo-big.png">
            </div>
            <div class="col-lg-10">
                <div class="card mt-lg-0 mt-md-4 mt-sm-4">
                    <div class="card-body">
                        <h4>History of Pondokan Tjiburial</h4>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('frontend.templates.footer')

@endsection