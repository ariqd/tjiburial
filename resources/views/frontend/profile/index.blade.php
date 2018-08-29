@extends('frontend.templates.main')

@push('title')
    {{ $user->name }}
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
        .img-fluid {
            display: inline-block;
        }
        .push-down {
            margin-top: 100px;
        }
        a.list-group-item.active {
            background-color: #4CAF50;
            border-color: #4CAF50;
        }
        a.btn:hover {
            color: #fefefe;
        }

        input, textarea {
            border: 0;
        }
    </style>
@endpush

@section('content')
    <div class="container">
        <div class="row">
            @include('frontend.templates.profile-sidebar')
            <div class="col-lg-9 push-down">
                <div class="card">
                    <div class="card-body">
                        @yield('profile')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection