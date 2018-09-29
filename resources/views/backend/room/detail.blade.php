@extends('backend.templates.main')

@push('title')
    {{ $room->name }} Detail
@endpush

@push('style')
    <style>
        .room-detail .row {
            margin: 20px 0;
        }
    </style>
@endpush

@push('script')
    <script>
        $(document).ready(function(){
            $('.btnDelete').on('click', function(e){
                e.preventDefault();
                var parent = $(this).parent();

                swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this data!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then(function(willDelete){
                    if (willDelete) {
                        parent.find('.formDelete').submit();
                    }
                });
            });
        });
    </script>
@endpush

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <h1>{{ $room->name }}</h1>
            </div>
            <div class="col-lg-6">
                <div class="float-right">
                    <a href="{{ url('admin/rooms') }}" class="btn btn-secondary btn-raised"><i class="fe fe-chevron-left"></i> Back</a>
                    <a href="{{ url('admin/rooms/'. $room->id .'/edit') }}" class="btn btn-warning btn-raised ml-1"><i class="fe fe-edit"></i> Edit</a>
                    <a href="#" class="btn btn-raised btn-danger btnDelete ml-5"><i class="fe fe-trash"></i> Delete</a>
                    <form action="{{ url('admin/rooms/'.$room->id) }}" method="post" class="formDelete" style="display: none;">
                        {!! csrf_field() !!}
                        {!! method_field('delete') !!}
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body room-detail">

                        <div class="row mt-0">
                            <div class="col-lg-3">
                                <b>Room Name</b>
                            </div>
                            <div class="col-lg-9">
                                {{ $room->name }}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3">
                                <b>Slug</b>
                            </div>
                            <div class="col-lg-9">
                                {{ $room->slug }}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3">
                                <b>Room Type</b>
                            </div>
                            <div class="col-lg-9">
                                {{ $room->type }}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3">
                                <b>Max. Guest</b>
                            </div>
                            <div class="col-lg-9">
                                {{ $room->max_guest }}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3">
                                <b>Installment Available</b>
                            </div>
                            <div class="col-lg-9">
                                {{ ($room->installment ? 'Yes' : 'No') }}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3">
                                <b>Price Weekday</b>
                            </div>
                            <div class="col-lg-9">
                                Rp {{ number_format($room->price, '0', ',', '.') }}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3">
                                <b>Price Weekend</b>
                            </div>
                            <div class="col-lg-9">
                                Rp {{ number_format($room->price_weekend, '0', ',', '.') }}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3">
                                <b>Overview</b>
                            </div>
                            <div class="col-lg-9">
                                {!! $room->overview !!}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3">
                                <b>Facilities</b>
                            </div>
                            <div class="col-lg-9">
                                {!! $room->facilities !!}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3">
                                <b>Amenities</b>
                            </div>
                            <div class="col-lg-9">
                                {!! $room->amenities !!}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3">
                                <b>Specials</b>
                            </div>
                            <div class="col-lg-9">
                                {!! $room->specials !!}
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-lg-6">
                <h3>Images</h3>
            </div>
            <div class="col-lg-6">
                <div class="float-right">
                    <a href="{{ url('admin/rooms/'. $room->id .'/images') }}" class="btn btn-success btn-raised"><i class="fe fe-image"></i> Manage</a>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                        @forelse($room->photos as $image)
                            <div class="col-lg-4">
                                <img src="{{ asset('uploads') . '/rooms/'.$room->name.'/'.$image->image }}" class="img-fluid">
                            </div>
                        @empty
                            <div class="col-lg-12 text-center">
                                <h3>Room has no image</h3>
                                <a href="{{ url('admin/rooms/'. $room->id .'/images') }}" class="btn btn-primary"><i class="fe fe-plus"></i> Add Image</a>
                            </div>
                        @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection