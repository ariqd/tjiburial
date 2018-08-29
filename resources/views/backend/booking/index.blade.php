@extends('backend.templates.main')

@push('title')
    Bookings Page
@endpush

@push('css')
    <link href="{{ asset('backend') }}/assets/plugins/DataTables/datatables.min.css" rel="stylesheet" />
@endpush

@push('js')
    <script src="{{ asset('backend') }}/assets/plugins/DataTables/datatables.min.js"></script>
@endpush

@push('style')
    <style>
        .sorting_disabled{
            width: 5px !important;
        }
        .width50{
            width: 50px !important;
        }
        .label-danger{
            background: #e01f1f;
            color: #fff;
        }
        .label-success{
            background: #2bb13c;
            color: #fff;
        }
        .label{
            padding: 5px;
            border-radius: 5px;
        }
    </style>
@endpush

@push('script')
    <script>
        $(document).ready(function(){
            $('.data-table').dataTable({
                responsive: true,
                sort : false
            });

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
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <h1>Bookings</h1>
                            </div>
                            {{--<div class="col-lg-6">--}}
                                {{--<a href="{{ url('admin/rooms/create') }}" class="btn btn-primary float-right">--}}
                                    {{--<i class="fe fe-plus"></i>&nbsp;&nbsp;Add Room--}}
                                {{--</a>--}}
                            {{--</div>--}}
                        </div>
                        @include('backend.templates.feedback')
                        @if(!$bookings->isEmpty())
                            <div class="row mt-3">
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table card-table table-vcenter table-bordered data-table">
                                            <thead>
                                            <tr>
                                                {{--<th class="sorting_disabled width-50"></th>--}}
                                                <th>Booking Date</th>
                                                <th>Name</th>
                                                <th>Room</th>
                                                <th>Check In Date</th>
                                                <th>Payment Type</th>
                                                <th class="width50">Status</th>
                                                <th class="width50">Actions</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($bookings as $booking)
                                                <tr>
                                                    {{--<td class="sorting_disabled"></td>--}}
                                                    <td>{{ $booking->created_at->format('Y-m-d') }}</td>
                                                    <td>{{ $booking->title .' ' . $booking->name }}</td>
                                                    <td>{{ $booking->reservation->room->name }}</td>
                                                    <td>{{ $booking->reservation->check_in }}</td>
                                                    <td>{{ $booking->reservation->payment_type }}</td>
                                                    <td class="width50">
                                                        @switch($booking->reservation->status)
                                                            @case(0)
                                                            <span class="badge badge-danger">Not Paid</span>
                                                            @break

                                                            @case(1)
                                                            <span class="badge badge-success">Paid</span>
                                                            @break
                                                        @endswitch
                                                    </td>
                                                    <td class="width50">
                                                        <a href="#"><i class="fa fa-eye"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    {{--<div class="card room" id="roomIdDiv">--}}
                                    {{--<div class="card-body">--}}

                                    {{--<div class="expand">--}}
                                    {{--<div class="row">--}}
                                    {{--<div class="col-lg-3">--}}
                                    {{--<img class="img-fluid w-100" src="{{ asset('uploads') . '/rooms/'.$room->name.'/'.$room->photos()->first()->image }}">--}}
                                    {{--<a href="{{ url('admin/rooms/'. $room->id .'/images') }}" class="btn btn-warning btn-block mt-3"><i class="fe fe-image"></i> All Images ({{ $room->photos()->count() }})</a>--}}
                                    {{--</div>--}}
                                    {{--<div class="col-lg-6">--}}
                                    {{--<h3>{{ $room->name }}</h3>--}}
                                    {{--<p class="text-secondary">Max guests {{ $room->max_guest }} person(s)</p>--}}
                                    {{--<div class="text-secondary">--}}
                                    {{--<h5>Special Features:</h5>--}}
                                    {{--{!! $room->specials !!}--}}
                                    {{--</div>--}}
                                    {{--</div>--}}
                                    {{--<div class="col-lg-3 text-right">--}}
                                    {{--<h4>Rp {{ number_format($room->price, '0', ',', '.') }} <small> / night</small></h4>--}}
                                    {{--<p class="text-primary">Inclusive of taxes</p>--}}
                                    {{--@if($room->installment == 1)--}}
                                    {{--<p>Installment is available for credit cardholders</p>--}}
                                    {{--@else--}}
                                    {{--<p>No installment available</p>--}}
                                    {{--@endif--}}
                                    {{--<a href="#" class="btn btn-primary">Book Now</a>--}}
                                    {{--<div class="d-flex">--}}
                                    {{--<a href="{{ url('admin/rooms/'. $room->id .'/edit') }}" class="btn btn-primary"><i class="fe fe-settings"></i> Edit</a>--}}
                                    {{--<a class="btn btn-danger btnDelete" href="#"><i class="fe fe-trash"></i> Delete</a>--}}
                                    {{--<form action="{{ url('admin/rooms/'.$room->id) }}" method="post" class="formDelete" style="display: none;">--}}
                                    {{--{!! csrf_field() !!}--}}
                                    {{--{!! method_field('delete') !!}--}}
                                    {{--</form>--}}
                                    {{--</div>--}}
                                    {{--</div>--}}
                                    {{--</div>--}}
                                    {{--<div class="row">--}}
                                    {{--<div class="col-lg-12">--}}
                                    {{--<div class="text-center">--}}
                                    {{--<i class="fe fe-chevrons-down"></i>--}}
                                    {{--</div>--}}
                                    {{--</div>--}}
                                    {{--</div>--}}
                                    {{--</div>--}}

                                    {{--<div class="detail mt-3">--}}
                                    {{--<div class="row">--}}
                                    {{--<div class="col-lg-6">--}}
                                    {{--<img class="img-fluid w-100" src="{{ asset('uploads') . '/rooms/'.$room->name.'/'.$room->photos()->first()->image }}">--}}
                                    {{--</div>--}}
                                    {{--<div class="col-lg-6">--}}
                                    {{--<h4 class="text-bold">Room Overview</h4>--}}
                                    {{--{!! $room->overview !!}--}}
                                    {{--<ul class="simple">--}}
                                    {{--<li>Bed type : 2 Regular beds</li>--}}
                                    {{--</ul>--}}
                                    {{--<h4 class="text-bold">Basic Facilities</h4>--}}
                                    {{--{!! $room->facilities !!}--}}
                                    {{--<ul class="simple">--}}
                                    {{--<li>Breakfast included</li>--}}
                                    {{--</ul>--}}
                                    {{--<h4 class="text-bold">Amenities</h4>--}}
                                    {{--{!! $room->amenities !!}--}}
                                    {{--<ul class="simple">--}}
                                    {{--<li>Air Conditioning</li>--}}
                                    {{--<li>Coffee Maker</li>--}}
                                    {{--<li>Hot Water</li>--}}
                                    {{--</ul>--}}
                                    {{--</div>--}}
                                    {{--</div>--}}
                                    {{--</div>--}}

                                    {{--</div>--}}
                                    {{--</div>--}}
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection