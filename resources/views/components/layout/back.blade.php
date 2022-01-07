@php 
    $user = Auth::user();
    //$role = $user->role;
    $role = 'admin';
    session(['menuOpenSub' => request('open','')]);
@endphp
@section('body')
  <x-block tag="nav" class="header-navbar navbar-fixed-top navbar-light">
    <div class="navbar-wrapper">
      <div class="navbar-header">
        <ul class="nav navbar-nav">

            <li class="nav-item"><x-logo />
            </li>
            <li class="nav-item hidden-sm-down float-xs-right">
              <a href="#" class="nav-link fixed nav-menu-main menu-toggle hidden-xs">
                <i class="ft-menu font-large-1"></i>
              </a>
              </li>
          </ul>
        </div>
      </div>
      <div class="fixed top-0 right-0 px-6 py-4 sm:block">
        <x-menu.dev.topright/>
      </div>

  </x-block>
  <x-block class="main-menu menu-fixed menu-light">
      <div class="main-menu-content menu-accordion">
        @switch($role)
          @case('editor')
              editor
            @break
          @default
            <x-menu.dev.admin />
        @endswitch
      </div>
  </x-block>


  <div class="app-content content container-fluid">
    <div class="content-wrapper">
      <x-block class="content-header row">
        @yield('title')
      </x-block>
      <x-block class="content-body">
        @yield('content')
      </x-block>
    </div>
  </div>

@endsection
@push('x-script')
  @if(session('menuOpenSub'))
    $('.sub-{{session('menuOpenSub')}}').addClass('open');
  @endif
@endpush
@push('script')
  <script src="{{asset('theme/js/app-menu.min.js')}}"></script>
  <script src="{{asset('theme/js/app.js')}}"></script>
@endpush
@push('outer')
  <x-modal class="modal-xl h-100 mt-0" id="modal-src"></x-modal>
@endpush
<x-layout.simple 
  data-open="click" 
  data-menu="vertical-menu" data-col="2-columns"
  class="vertical-layout vertical-menu 2-columns fixed-navbar" />
