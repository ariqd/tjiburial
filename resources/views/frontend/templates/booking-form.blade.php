<div class="row hotel-form">
    <div class="col-lg-2">
        <div class="form-row d-flex justify-content-between align-items-center p-2">
            <label for="checkin" class="hotel-form-label"><b><i class="fa fa-calendar"></i>&nbsp;&nbsp;Check
                    In</b></label>
            <input type="date" class="form-control" name="check_in_date" id="check_in_date"
                   min="{{ date('Y-m-d') }}" value="{{ !empty($_GET['check_in_date']) ? $_GET['check_in_date'] : '' }}">
        </div>
    </div>
    <div class="col-lg-2">
        <div class="form-row d-flex justify-content-between align-items-center p-2">
            <label for="duration" class="hotel-form-label"><b><img src="{{ asset('assets') }}/images/duration.png"
                                                                   alt="duration"
                                                                   width="15">&nbsp;&nbsp;Duration</b></label>
            <select name="duration" id="duration" class="form-control custom-select" required>
                @foreach($duration as $key => $value)
                    <option value="{{ $key + 1 }}" {{ (!empty($_GET['duration'])) && ($_GET['duration'] == $key + 1) ? 'selected' : '' }}>{{ $value }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-2">
        <div class="form-row d-flex justify-content-between align-items-center p-2">
            <label for="guest" class="hotel-form-label"><b><span
                            class="fa fa-male"></span>&nbsp;&nbsp;Guests</b></label>
            <select name="guest" id="guest" class="form-control custom-select" required>
                @foreach($guest as $key => $value)
                    <option value="{{ $key+1 }}" {{ (!empty($_GET['guest'])) && ($_GET['guest'] == $value) ? 'selected' : '' }}>{{ $value }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-2">
        <div class="form-row d-flex justify-content-between align-items-center p-2">
            <label for="child" class="hotel-form-label"><b><span class="fa fa-male"></span>&nbsp;&nbsp;Child < 6 yr old</b></label>
            <select name="child" id="child" class="form-control custom-select" required>
                <option value="0">None</option>
                @foreach($guest as $key => $value)
                    <option value="{{ $key+1 }}" {{ (!empty($_GET['child'])) && ($_GET['child'] == $value) ? 'selected' : '' }}>{{ $value }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-2">
        <div class="form-row d-flex justify-content-between align-items-center p-2">
            <label for="rooms" class="hotel-form-label"><b><i class="fa fa-bed"></i>&nbsp;&nbsp;Rooms</b></label>
            <select name="rooms" id="rooms" class="form-control custom-select">
                @foreach($rooms_count as $key => $value)
                    <option value="{{ $key + 1 }}" {{ (!empty($_GET['rooms'])) && ($_GET['rooms'] == $key + 1) ? 'selected' : '' }}>{{ $value }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-2 d-flex align-items-center mt-4">
        <label for="button" class="hotel-form-label"></label>
        @if(Request::is('book'))
            <h5>Choose a room <i class="fa fa-level-down text-tjiburial"></i></h5>
        @else
            <button type="submit" class="btn btn-tjiburial btn-block">BOOK NOW</button>
        @endif
    </div>
</div>