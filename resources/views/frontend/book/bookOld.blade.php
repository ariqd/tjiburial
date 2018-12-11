<div class="expand">
    <div class="row">
        <div class="col-lg-3">
            @if(!empty($room->photos()->where('main', 1)->first()->image))
                <img class="img-fluid w-100"
                     src="{{ asset('uploads') . '/rooms/'.$room->name.'/'.$room->photos()->where('main', 1)->first()->image }}">
            @else
                <div class="border p-5">
                    <h4 class="text-center">Coming Soon</h4>
                </div>
            @endif
        </div>
        <div class="col-lg-6">
            <h3>{{ $room->name }}</h3>
            <p class="text-secondary">
                Max guests {{ $room->max_guest }} person
                @if($room->room_count - $room->reservation->count() > 0)
                    | Rooms available: {{ ($room->room_count - $room->reservation->count()) }}
                @else
                    | <span class="text-danger">Rooms available: 0</span>
                @endif
            </p>
            <div class="text-secondary">
                <h5>Special Features:</h5>
                {!! $room->specials !!}
            </div>
        </div>
        <div class="col-lg-3 text-right">
            @if(isWeekend(date('Y-m-d')))
                <h4>Rp {{ number_format($room->price_weekend, '0', ',', '.') }}
                    <small> / night</small>
                </h4>
            @else
                <h4>Rp {{ number_format($room->price, '0', ',', '.') }}
                    <small> / night</small>
                </h4>
            @endif
            <p class="text-primary">Inclusive of taxes</p>
            @if($room->installment == 1)
                <p>Installment is available for credit cardholders</p>
            @else
                <p>No installment available</p>
            @endif
            <input type="hidden" name="room_id" value="{{ $room->id }}" class="inputId{{ $room->id }}" disabled>
            @if($room->room_count - $room->reservation->count() > 0)
                <button class="btn btn-tjiburial text-light btnSubmit"
                        data-id="{{ $room->id }}">Book Now
                </button>
            @else
                <button class="btn btn-tjiburial text-light disabled" disabled>Book Now</button>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="text-center">
                <i class="fa fa-chevron-down"></i>
            </div>
        </div>
    </div>
</div>
<div class="detail mt-3">
    <div class="row">
        <div class="col-lg-6">
            @if($room->photos->count() != 0)
                <div class="px-3">
                    <div class="slick slick-slider">
                        @foreach(@$room->photos as $key => $photo)
                            <div class="slick-slide">
                                <img class="d-block img-fluid w-100"
                                     src="{{ asset('uploads') . '/rooms/' . $room->name . '/' . $photo->image }}"
                                     alt="Image {{ $key + 1 }}">
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <div class="border p-5">
                    <h4 class="text-center">Coming Soon</h4>
                </div>
            @endif
        </div>
        <div class="col-lg-6">
            <h4 class="text-bold">Room Overview</h4>
            {!! $room->overview !!}
            <h4 class="text-bold">Basic Facilities</h4>
            {!! $room->facilities !!}
            <h4 class="text-bold">Amenities</h4>
            {!! $room->amenities !!}
        </div>
    </div>
</div>