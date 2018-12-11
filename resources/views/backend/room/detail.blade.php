@extends('backend.templates.main')

@push('title')
    {{ $room->title }} Detail
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
                <h1>{{ $room->title }}</h1>
            </div>
            <div class="col-lg-6">
                <div class="float-right">
                    <a href="{{ url('admin/rooms') }}" class="btn btn-dark"><i class="fe fe-chevron-left"></i> Back</a>
                    <a href="{{ url('admin/rooms/'. $room->id .'/edit') }}" class="btn btn-warning"><i class="fe fe-edit"></i> Edit</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body room-detail">

                        <div class="row mt-0">
                            <div class="col-lg-3">
                                <b>Room ID</b>
                            </div>
                            <div class="col-lg-9">
                                {{ $room->id }}
                            </div>
                        </div>

                        <div class="row mt-0">
                            <div class="col-lg-3">
                                <b>Room Name</b>
                            </div>
                            <div class="col-lg-9">
                                {{ $room->title }}
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
                                {{ $room->tipe_kamar }}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3">
                                <b>Description</b>
                            </div>
                            <div class="col-lg-9">
                                {!! $room->desc !!}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3">
                                <b>Qty Room</b>
                            </div>
                            <div class="col-lg-9">
                                {{ $room->qty_room }}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3">
                                <b>Qty Tamu</b>
                            </div>
                            <div class="col-lg-9">
                                {{ $room->qty_tamu }}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3">
                                <b>Bed Type 1</b>
                            </div>
                            <div class="col-lg-9">
                                {{ $room->bed_type1 }}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3">
                                <b>Bed Type 2</b>
                            </div>
                            <div class="col-lg-9">
                                {{ $room->bed_type2 }}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3">
                                <b>Bed Type 3</b>
                            </div>
                            <div class="col-lg-9">
                                {{ $room->bed_type3 }}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3">
                                <b>Room Size</b>
                            </div>
                            <div class="col-lg-9">
                                {{ $room->room_size }}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3">
                                <b>Terrace room size</b>
                            </div>
                            <div class="col-lg-9">
                                {!! ($room->room_size_terrace ? '<i class="fa fa-check text-success"></i>' : '<i class="fa fa-times text-danger"></i>') !!}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3">
                                <b>Breakfast</b>
                            </div>
                            <div class="col-lg-9">
                                {!! ($room->breakfast ? '<i class="fa fa-check text-success"></i>' : '<i class="fa fa-times text-danger"></i>') !!}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3">
                                <b>Wi-Fi</b>
                            </div>
                            <div class="col-lg-9">
                                {!! ($room->wifi ? '<i class="fa fa-check text-success"></i>' : '<i class="fa fa-times text-danger"></i>') !!}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3">
                                <b>Smoking</b>
                            </div>
                            <div class="col-lg-9">
                                {!! ($room->smoking ? '<i class="fa fa-check text-success"></i>' : '<i class="fa fa-times text-danger"></i>') !!}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3">
                                <b>Has terrace</b>
                            </div>
                            <div class="col-lg-9">
                                {!! ($room->has_terrace ? '<i class="fa fa-check text-success"></i>' : '<i class="fa fa-times text-danger"></i>') !!}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3">
                                <b>Day use room</b>
                            </div>
                            <div class="col-lg-9">
                                {!! ($room->day_use_room ? '<i class="fa fa-check text-success"></i>' : '<i class="fa fa-times text-danger"></i>') !!}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3">
                                <b>Installment Available</b>
                            </div>
                            <div class="col-lg-9">
                                {!! ($room->installment ? '<i class="fa fa-check text-success"></i>' : '<i class="fa fa-times text-danger"></i>') !!}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3">
                                <b>Featured</b>
                            </div>
                            <div class="col-lg-9">
                                {!! ($room->featured ? '<i class="fa fa-check text-success"></i>' : '<i class="fa fa-times text-danger"></i>') !!}
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-lg-12">
                <h2>Today's Price</h2>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            {{--@forelse($room->allotments()->get() as $allotment)--}}
                                <div class="col-lg-6">
                                    <h3>{{ $room->allotment()->hari }}, {{ $room->allotment()->tanggal }}</h3>
                                </div>
                                <div class="col-lg-6">
                                    <h3 class="float-right">Rp {{ number_format($room->allotment()->harga) }}</h3>
                                </div>
                            {{--@empty--}}
                                {{--<div class="col-lg-12 text-center">--}}
                                    {{--<h3>Room has no allotment for today</h3>--}}
                                {{--</div>--}}
                            {{--@endforelse--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-lg-12">
                <h2>Facilities</h2>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            @forelse($room->facilities as $facility)
                                <div class="col-lg-4 my-2">
                                    <h5><i class="fa fa-check text-success"></i> {{ $facility->name }}</h5>
                                </div>
                            @empty
                                <div class="col-lg-12 text-center">
                                    <h3>Room has no facility</h3>
                                    <a href="{{ url('admin/rooms/'. $room->id .'/edit') }}" class="btn btn-primary"><i class="fe fe-plus"></i> Add Facility</a>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-lg-6">
                <h2>Images</h2>
            </div>
            <div class="col-lg-6">
                <div class="float-right">
                    <a href="{{ url('admin/rooms/'. $room->id .'/images') }}" class="btn btn-success"><i class="fe fe-image"></i> Manage</a>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                        @forelse($room->images as $image)
                            <div class="col-lg-4">
                                <img src="{{ asset('uploads') . '/rooms/'.$room->id.'/'.$image->image }}" class="img-fluid">
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
        <div class="row mt-3">
            <div class="col-lg-12">
                <a href="#" class="btn btn-danger btnDelete btn-block ml-5"><i class="fe fe-trash"></i> Delete this room</a>
                <form action="{{ url('admin/rooms/'.$room->id) }}" method="post" class="formDelete" style="display: none;">
                    {!! csrf_field() !!}
                    {!! method_field('delete') !!}
                </form>
            </div>
        </div>
    </div>
@endsection