<ul class="nav navbar-nav font-medium-2 text-bold-400">
  <li class="nav-item mr-1"> 
      <a href="{{ route('home') }}" class="nav-link" > {{ Theme::title('about  us') }} </a>
  </li>
  <li class="nav-item mr-1"> 
      <a href="{{ route('service') }}" class="nav-link" > {{ Theme::title('service') }} </a>
  </li>
  <li class="nav-item mr-1"> 
      <a href="{{ route('project') }}" class="nav-link" > {{ Theme::title('project') }} </a>
  </li>
  <li class="nav-item mr-1"> 
      <a href="#" class="nav-link" > {{ Theme::title('careers') }} </a>
  </li>
  <li class="nav-item mr-1"> 
      <a href="#" class="nav-link" > {{ Theme::title('blog') }} </a>
  </li>
  <li class="nav-item mr-1"> 
      <a href="{{ route('contact') }}" class="nav-link" > {{ Theme::title('contact  us') }} </a>
  </li>
  <li class="nav-item">
    <a href="{{ route('estimate') }}" class="btn btn-primary btn-est" > {{Theme::title('estimate project')}} </a>
  </li>  
</ul>
