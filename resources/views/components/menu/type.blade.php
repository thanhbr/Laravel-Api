<ul class="nav navbar-nav flex">
  @foreach( $menu as $item)
    <li  class="flex-1 font-medium-2 text-bold-600 ">
      <a class="nav-link" href='{{url($item->link->pretty)}}'>
              {{$item->name}}
            </a>
    </li>
  @endforeach
</ul>
