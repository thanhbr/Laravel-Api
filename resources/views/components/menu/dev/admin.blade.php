<ul id="main-menu-navigation" data-menu="menu-navigation" class="navigation navigation-main">

  <li class="navigation-header">
    <span>{{ Theme::title('work place') }}</span>
    <i data-toggle="tooltip" data-placement="right" data-original-title="{{ Theme::title('work place') }}" class="ft-minus"></i>
  </li>
  <li class="nav-item">
    <a href="{{ route('dev.index')  }}">
      <i class="icon-graph"></i>
      <span class="menu-title">{{ Theme::title('dashboard')  }}</span>
    </a>
  </li>

  <li class="nav-item">
    <a href="{{ route('blocks.index') }}">
      <i class="icon-pin"></i>
      <span class="menu-title">{{ Theme::title('pin')  }}</span>
    </a>
  </li>

  <li class="nav-item">
    <a href="{{ route('users.index',['is'=>'admin','open'=>'account'])  }}">
      <i class="icon-ghost"></i>
      <span class="menu-title">{{ Theme::title('admin') }}</span>
    </a>
  </li>

  <li class="navigation-header">
    <span>{{ Theme::title('post') }}</span>
    <i data-toggle="tooltip" data-placement="right" data-original-title="{{ Theme::title('post') }}" class="ft-minus"></i>
  </li>

  <li class="nav-item">
    <a href="{{ route('posts.index',['open'=>'post']) }}">
      <i class="icon-docs"></i>
      <span class="menu-title">{{ Theme::title('page')  }}</span>
    </a>
  </li>

  <li class="nav-item">
    <a href="{{ route('categories.index')  }}">
      <i class="icon-layers"></i><span class="menu-title">{{ Theme::title('categories')  }}</span>
    </a>
  </li>
  <li class="nav-item sub-post has-sub open">
    <a href="#">
      <i class="icon-list"></i>
      <span class="menu-title">{{ Theme::title('list')  }}</span>
    </a>
    <x-menu.dev.side.post />
  </li>

</ul>