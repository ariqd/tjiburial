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
            <div class="col-lg-6">
                <h1>Bookings</h1>
            </div>
            {{--<div class="col-lg-6">--}}
            {{--<a href="{{ url('admin/rooms/create') }}" class="btn btn-primary float-right">--}}
            {{--<i class="fe fe-plus"></i>&nbsp;&nbsp;Add Room--}}
            {{--</a>--}}
            {{--</div>--}}
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">

                        @include('backend.templates.feedback')
                        @if(!$bookings->isEmpty())
                            <div class="row mt-3">
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table card-table table-vcenter table-bordered data-table">
                                            <thead>
                                            <tr>
                                                <th class="sorting_disabled"></th>
                                                <th>Booking Date</th>
                                                {{--<th>Reserved By</th>--}}
                                                <th>Name</th>
                                                <th>Room</th>
                                                {{--<th>Check In Date</th>--}}
                                                {{--<th>Duration</th>--}}
                                                {{--<th>Check Out Date</th>--}}
                                                <th>Payment Type</th>
                                                <th class="width50">Status</th>
                                                <th class="width50"></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($bookings as $booking)
                                                <tr>
                                                    <td class="sorting_disabled"></td>
                                                    <td>{{ date('d M Y', strtotime($booking->created_at)) }} ({{ $booking->created_at->diffForHumans() }})</td>
{{--                                                    <td>{{ $booking->reservation->user->name }}</td>--}}
                                                    <td>{{ $booking->title .' ' . $booking->name }}</td>
                                                    <td>
                                                        <a href="{{ url('admin/rooms/'.@$booking->reservation->room->id) }}">
                                                            {{ @$booking->reservation->room->name }}
                                                        </a>
                                                    </td>
                                                    {{--<td>--}}
                                                        {{--{{ date('d M Y', strtotime($booking->reservation->check_in)) }} ({{ Carbon\Carbon::parse($booking->reservation->check_in)->diffForHumans() }})--}}
                                                    {{--</td>--}}
                                                    {{--<td>--}}
                                                        {{--{{ $booking->reservation->duration }} night(s)--}}
                                                    {{--</td>--}}
                                                    {{--<td>--}}
                                                        {{--{{ date('d M Y', strtotime($booking->reservation->check_out)) }} ({{ Carbon\Carbon::parse($booking->reservation->check_out)->diffForHumans() }})--}}
                                                    {{--</td>--}}
                                                    <td>{{ $booking->reservation->payment_type }}</td>
                                                    <td class="width50">
                                                        @switch($booking->reservation->status)
                                                            @case(0)
                                                            <span class="badge badge-danger">Not Paid</span>
                                                            @break

                                                            @case(1)
                                                            <span class="badge badge-success">Paid</span>
                                                            @break

                                                            @default
                                                            <span class="badge badge-primary">Paid at Check in</span>

                                                        @endswitch
                                                    </td>
                                                    <td class="width50">
                                                        <a href="{{ url('admin/bookings/'.$booking->id) }}" class="btn btn-icon btn-primary"><i class="fa fa-eye"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        @else
                            <h3 class="text-secondary text-center">No Bookings or Reservations yet.</h3>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection