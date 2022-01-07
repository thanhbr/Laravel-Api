
<ul class="nav navbar-nav">
  @foreach($categories as $category )
    <li class="nav-item font-medium-2 text-bold-600 ">
      <a href='{{url($category->link->pretty)}}' >
          {{ Theme::title($category->name) }}
      </a>
    </li>
  @endforeach
</ul>
