<aside class="sidebar">
    <div class="heading-side">
        <div class="logo center">
            <a href="{{ url('profile/project-information') }}"><img src="{{ asset('public/assets/site/images/base/logo.png') }}" srcset="{{ asset('public/assets/site/images/base/logo_2.png') }} 2x" alt="UDAI"></a>
        </div>
        <div class="user-info">
            <div class="welcome">Welcome</div>
            <div class="user-option">
                <nav class="profile-menu">
                    <ul>
                        <li>
                            <label for="menu-toggle" href="#">{{ auth()->user()->first_name . ' ' . auth()->user()->last_name }}</label>
                            <input id="menu-toggle" type="checkbox" class="menu-toggle">
                            <ul>
                                @if(auth()->user()->role == 'admin')
                                    <li><a href="{{ url('dashboard') }}">Dashboard</a></li>
                                @endif
                                <li><a href="{{ url('profile/your-account') }}">Edit Profile</a></li>
                                <li><a href="{{ url('/logout') }}">Sign Out</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
{{--            <div class="breadcrumb-dashboard">to your dashboard</div>--}}
        </div>
    </div>

    <nav class="dashboard-nav">
        <ul>
            <li><a href="{{ url('profile/project') }}"> <span class="icon icon-home"></span> <span class="text">Dashboard</span> </a>

                <ul class="sub-menu">
                    <li>
                        <a class="@if (Request::is('profile/project*')) {{ 'active' }}@endif" href="{{ url('profile/project') }}"><span class="icon icon-project_information"></span><span class="text">Project information</span></a>
                    </li>
                    <li>
                        <a class="@if (Request::is('profile/design*')) {{ 'active' }}@endif" href="{{ url('profile/design') }}"><span class="icon icon-design"></span><span class="text">Design</span></a>
                    </li>
                    <li><a class="@if (Request::is('profile/connect*')) {{ 'active' }}@endif" href="{{ url('profile/connect') }}"><span class="icon icon-connect"></span><span class="text">Connect</span></a>
                    </li>
                    <li><a class="@if (Request::is('profile/messages*')) {{ 'active' }}@endif" href="{{ url('profile/messages') }}"><span class="icon icon-message"></span><span class="text">Messages</span></a>
                    </li>
                    <li><a href="#" ><span class="icon icon-folder"></span><span class="text">File library</span></a>
                    </li>
                </ul>
            </li>

            <li><a class="@if (Request::is('profile/architectionary*')) {{ 'active' }}@endif" href="{{ url('profile/architectionary') }}"><span class="icon icon-architectionary"></span><span class="text">Architectionary</span></a>
            </li>
            <li><a href="#"><span class="icon icon-star-o"></span><span class="text">What's new?</span></a></li>
        </ul>
    </nav>
</aside>
