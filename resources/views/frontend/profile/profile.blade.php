@extends('frontend.profile.index')

@section("profile")
    <div>
        <b>Name</b> <br>
        <h1>{{ $user->name }}</h1>
        <hr>
        <div class="row">
            <div class="col-lg-6">
                <b>Email</b> <br>
                <h4>{{ $user->email }}</h4>
            </div>
            <div class="col-lg-6">
                <b>Password</b> <br>
                <h4>***************</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <a href="{{ url('profile/edit') }}" class="btn btn-tjiburial float-right">Edit Profile</a>
            </div>
        </div>
    </div>
@endsection
