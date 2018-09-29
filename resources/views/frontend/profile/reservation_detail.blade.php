@extends('frontend.profile.index')

@push('style')
    <style>
        .details .row {
            margin: 20px 0;
        }
    </style>
@endpush

@section("profile")
    <h4>Reservation Detail</h4>
    <div class="details">
        <div class="row">
            <div class="col-lg-3">
                <b>Check in Date</b>
            </div>
            <div class="col-lg-9">
                {{ date('d M Y', strtotime($reservation->check_in)) }} ({{ Carbon\Carbon::parse($reservation->check_in)->diffForHumans() }})
            </div>
        </div>

        <div class="row">
            <div class="col-lg-3">
                <b>Duration</b>
            </div>
            <div class="col-lg-9">
                {{ $reservation->duration }} night(s)
            </div>
        </div>

        <div class="row">
            <div class="col-lg-3">
                <b>Check out Date</b>
            </div>
            <div class="col-lg-9">
                {{ date('d M Y', strtotime($reservation->check_out)) }} ({{ Carbon\Carbon::parse($reservation->check_out)->diffForHumans() }})
            </div>
        </div>

        <div class="row">
            <div class="col-lg-3">
                <b>Guest</b>
            </div>
            <div class="col-lg-9">
                {{ $reservation->guest_count }}
            </div>
        </div>

        <div class="row">
            <div class="col-lg-3">
                <b>Total</b>
            </div>
            <div class="col-lg-9">
                Rp {{ number_format($reservation->total, '0', ',', '.') }}
            </div>
        </div>

        <div class="row">
            <div class="col-lg-3">
                <b>Payment Type</b>
            </div>
            <div class="col-lg-9">
                {{ $reservation->payment_type }}
            </div>
        </div>

        <div class="row mb-0">
            <div class="col-lg-3">
                <b>Status</b>
            </div>
            <div class="col-lg-9">
                @switch($reservation->status)
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


@endsection