<div class="header collapse d-lg-flex p-0" id="headerMenuCollapse">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg order-lg-first">
                <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
                    {{--<li class="nav-item">--}}
                        {{--<a href="{{ url('admin') }}"--}}
                           {{--class="nav-link {{ (Request::is('admin')) ? 'active' : '' }}">Home</a>--}}
                    {{--</li>--}}
                    <li class="nav-item">
                        <a href="{{ url('admin/bookings') }}"
                           class="nav-link {{ (Request::is('admin/bookings*')) ? 'active' : '' }}">Bookings</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('admin/rooms') }}"
                           class="nav-link {{ (Request::is('admin/rooms*')) ? 'active' : '' }}">Rooms</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('admin/promotions') }}"
                           class="nav-link {{ (Request::is('admin/promotions*')) ? 'active' : '' }}">Promotions</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('admin/messages') }}"
                           class="nav-link {{ (Request::is('admin/messages*')) ? 'active' : '' }}">Messages</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('admin/banners') }}"
                           class="nav-link {{ (Request::is('admin/banners*')) ? 'active' : '' }}">Banners</a>
                    </li>
                    {{--<li class="nav-item">--}}
                        {{--<a href="{{ url('admin/blog') }}"--}}
                           {{--class="nav-link {{ (Request::is('admin/blog*')) ? 'active' : '' }}">Blog</a>--}}
                    {{--</li>--}}
                    <li class="nav-item">
                        <a href="{{ url('admin/settings') }}"
                           class="nav-link {{ (Request::is('admin/settings*')) ? 'active' : '' }}">Settings</a>
                    </li>
                    <li class="nav-item float-right">
                        <a href="{{ url('/') }}" class="nav-link"><i class="fe fe-home"></i> Front Page</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>