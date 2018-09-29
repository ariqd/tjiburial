@extends('backend.templates.main')

@push('title')
    {{ $booking->title }} {{ $booking->name }}'s Booking
@endpush

@push('style')
    <style>
        .details .row {
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

@section("content")
<div class="container">
    <div class="row">
        <div class="col-lg-6">
            <h1>{{ $booking->name }}'s Booking</h1>
        </div>
        <div class="col-lg-6">
            <div class="float-right">
                <a href="{{ url('admin/bookings') }}" class="btn btn-secondary btn-raised btn-sm"><i class="fe fe-chevron-left"></i> Back</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <h4>Reservation Detail</h4>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body details">

                    <div class="row mt-0">
                        <div class="col-lg-3">
                            <b>Name</b>
                        </div>
                        <div class="col-lg-9">
                            {{ $booking->title }} {{ $booking->name }}
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-3">
                            <b>Booking Date</b>
                        </div>
                        <div class="col-lg-9">
                            {{ date('d M Y', strtotime($booking->created_at)) }} ({{ $booking->created_at->diffForHumans() }})
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-3">
                            <b>Check in Date</b>
                        </div>
                        <div class="col-lg-9">
                            {{ date('d M Y', strtotime($booking->reservation->check_in)) }} ({{ Carbon\Carbon::parse($booking->reservation->check_in)->diffForHumans() }})
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-3">
                            <b>Duration</b>
                        </div>
                        <div class="col-lg-9">
                            {{ $booking->reservation->duration }} night(s)
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-3">
                            <b>Check out Date</b>
                        </div>
                        <div class="col-lg-9">
                            {{ date('d M Y', strtotime($booking->reservation->check_out)) }} ({{ Carbon\Carbon::parse($booking->reservation->check_out)->diffForHumans() }})
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-3">
                            <b>Guest</b>
                        </div>
                        <div class="col-lg-9">
                            {{ $booking->reservation->guest_count }}
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-3">
                            <b>Total</b>
                        </div>
                        <div class="col-lg-9">
                            Rp {{ number_format($booking->reservation->total, '0', ',', '.') }}
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-3">
                            <b>Payment Type</b>
                        </div>
                        <div class="col-lg-9">
                            {{ $booking->reservation->payment_type }}
                        </div>
                    </div>

                    <div class="row mb-0">
                        <div class="col-lg-3">
                            <b>Status</b>
                        </div>
                        <div class="col-lg-9">
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
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <h4>Booking Detail - <small>{{ $booking->title }} {{ $booking->name }}</small></h4>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body details">

                    <div class="row mt-0">
                        <div class="col-lg-3">
                            <b>Email</b>
                        </div>
                        <div class="col-lg-9">
                            {{ $booking->email }}
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-3">
                            <b>Date of Birth</b>
                        </div>
                        <div class="col-lg-9">
                            {{ date('d M Y', strtotime($booking->dob)) }} ({{ \Carbon\Carbon::parse($booking->dob)->age }} years old)
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-3">
                            <b>Nationality</b>
                        </div>
                        <div class="col-lg-9">
                            {{ $booking->nationality }}
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-3">
                            <b>Country</b>
                        </div>
                        <div class="col-lg-9">
                            {{ $booking->country }}
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-3">
                            <b>Address</b>
                        </div>
                        <div class="col-lg-9">
                            {{ $booking->address }}, {{ $booking->city }}, {{ $booking->state }}
                        </div>
                    </div>

                    <div class="row mb-0">
                        <div class="col-lg-3">
                            <b>Phone</b>
                        </div>
                        <div class="col-lg-9">
                            {{ $booking->phone_code }} {{ $booking->phone_no }}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>
@endsection