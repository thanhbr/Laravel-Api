<ul class="nav navbar-nav float-xs-right">
    <li class="nav-item mr-1">
        <span class="avatar avatar-online">
            <img src="{{ asset('theme/images/portrait/small/avatar-s-1.png') }}" alt="avatar">
        </span>
        
    </li>
    <li class="nav-item ">
        <a class="nav-link" href="{{ route('logout') }}">
            <i class="icon-power"></i>
            <span class="menu-title">  {{  Theme::title('logout')  }}</span>
        </a>
    </li>
   
</ul>