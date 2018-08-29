@extends('frontend.profile.index')

@section("profile")
    <h2>My Reservations</h2>
    <div class="table-reservation">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Reservation Date</th>
                <th>Check In Date</th>
                <th>Room</th>
                <th>Payment</th>
                <th>Status</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($reservations as $reservation)
                <tr>
                    <td>{{ $reservation->created_at->format('Y-m-d') }}</td>
                    <td>{{ $reservation->check_in }}</td>
                    <td>{{ $reservation->room->name }}</td>
                    <td>{{ $reservation->payment_type }}</td>
                    <td>
                        @switch($reservation->status)
                            @case(0)
                                <span class="badge badge-danger">Not Paid</span>
                                @break

                            @case(1)
                                <span class="badge badge-success">Paid</span>
                                @break
                        @endswitch
                    </td>
                    <td>
                        <a href="#" class="text-secondary"><i class="fa fa-eye"></i></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection