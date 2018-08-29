<div class="col-lg-3 push-down">
    <div class="list-group">
        <a href="{{ url('profile') }}" class="list-group-item list-group-item-action {{ Request::is('profile') ||
        Request::is('profile/edit') ? 'active' : '' }}">
            My Profile
        </a>
        <a href="{{ url('profile/reservations') }}" class="list-group-item list-group-item-action
        {{ Request::is('profile/reservations*') ? 'active' : '' }}">
            My Reservations
        </a>
    </div>
    <a href="{{ url('/logout') }}" class="btn btn-danger btn-block mt-3">Logout</a>
</div>