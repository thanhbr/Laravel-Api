
<x-block tag="ul" class="nav">
  @foreach($categories as $category )
    <li class="nav-item">
      <a  class="nav-link"  href='{{url($category->link->pretty)}}'>
          {{$category->name}} </a>
    </li>
  @endforeach
</x-block>
