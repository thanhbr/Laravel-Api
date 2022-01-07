@php
  $menuData = [];
  $currentURL = url()->current();

@endphp
@role('admin')
  @php
  $menuData[] = [
    'icon' => '<svg width="20" height="16" viewBox="0 0 20 16" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M15.8499 7.72168H13.5999L11.7999 10.4217H8.1999L6.3999 7.72168H4.1499" stroke="#4D6E99" stroke-linecap="round" stroke-linejoin="round"/>
    <path d="M4.105 1.52073L1 7.72173V13.1217C1 13.5991 1.18964 14.057 1.52721 14.3945C1.86477 14.7321 2.32261 14.9217 2.8 14.9217H17.2C17.6774 14.9217 18.1352 14.7321 18.4728 14.3945C18.8104 14.057 19 13.5991 19 13.1217V7.72173L15.895 1.52073C15.746 1.22084 15.5163 0.968462 15.2317 0.79198C14.9471 0.615498 14.6189 0.521906 14.284 0.521729H5.716C5.38112 0.521906 5.05294 0.615498 4.76834 0.79198C4.48374 0.968462 4.25402 1.22084 4.105 1.52073V1.52073Z" stroke="#4D6E99" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>
    ',
    'link' => '#',
    'name' => trans('titles.customer'),
    'alias'=> 'customer',
    'sub-menu-alias' => 'customer',
    'childrens'=>[
      [
        'icon' => '<i class="fa fa-users"></i>',
        'link' => route('customers.index'),
        'name' => 'Danh sách',
        'childrens' => []
      ],
      [
        'icon' => '<i class="fa fa-tasks"></i>',
        'link' => route('history_contacts.index'),
        'name' => 'Lịch sử liên hệ',
        'childrens' => []
      ],
      [
        'icon' => '<i class="fa fa-tasks"></i>',
        'link' => route('customer_origins.index'),
        'name' => 'Nguồn khách hàng',
        'childrens' => []
      ],
    ],
  ];
    $menuData[] = [
    'icon' => '<svg width="20" height="16" viewBox="0 0 20 16" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M15.8499 7.72168H13.5999L11.7999 10.4217H8.1999L6.3999 7.72168H4.1499" stroke="#4D6E99" stroke-linecap="round" stroke-linejoin="round"/>
    <path d="M4.105 1.52073L1 7.72173V13.1217C1 13.5991 1.18964 14.057 1.52721 14.3945C1.86477 14.7321 2.32261 14.9217 2.8 14.9217H17.2C17.6774 14.9217 18.1352 14.7321 18.4728 14.3945C18.8104 14.057 19 13.5991 19 13.1217V7.72173L15.895 1.52073C15.746 1.22084 15.5163 0.968462 15.2317 0.79198C14.9471 0.615498 14.6189 0.521906 14.284 0.521729H5.716C5.38112 0.521906 5.05294 0.615498 4.76834 0.79198C4.48374 0.968462 4.25402 1.22084 4.105 1.52073V1.52073Z" stroke="#4D6E99" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>
    ',
    'link' => '#',
    'name' => trans('titles.contract'),
    'alias'=> 'contract',
    'sub-menu-alias' => 'contract, addendom',
    'childrens'=>[
      [
        'icon' => '<i class="fa fa-users"></i>',
        'link' => route('contracts.index'),
        'name' => trans('Danh sách hợp đồng'),
        'childrens' => []
      ],
      [
        'icon' => '<i class="fa fa-tasks"></i>',
        'link' => route('addendoms.index'),
        'name' => trans('Phụ lục hợp đồng'),
        'childrens' => []
      ],
    ],
  ];
  $menuData[] = [
    'icon' => '<svg width="20" height="16" viewBox="0 0 20 16" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M15.8499 7.72168H13.5999L11.7999 10.4217H8.1999L6.3999 7.72168H4.1499" stroke="#4D6E99" stroke-linecap="round" stroke-linejoin="round"/>
    <path d="M4.105 1.52073L1 7.72173V13.1217C1 13.5991 1.18964 14.057 1.52721 14.3945C1.86477 14.7321 2.32261 14.9217 2.8 14.9217H17.2C17.6774 14.9217 18.1352 14.7321 18.4728 14.3945C18.8104 14.057 19 13.5991 19 13.1217V7.72173L15.895 1.52073C15.746 1.22084 15.5163 0.968462 15.2317 0.79198C14.9471 0.615498 14.6189 0.521906 14.284 0.521729H5.716C5.38112 0.521906 5.05294 0.615498 4.76834 0.79198C4.48374 0.968462 4.25402 1.22084 4.105 1.52073V1.52073Z" stroke="#4D6E99" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>
    ',
    'link' => '#',
    'name' => trans('titles.administrator'),
    'alias'=> 'administrator',
    'sub-menu-alias' => 'roles,users,warehouse_types',
    'childrens'=>[
      [
        'icon' => '<i class="fa fa-users"></i>',
        'link' => url('users'),
        'name' => trans('Danh sách tài khoản'),
        'childrens' => []
      ],
      [
        'icon' => '<i class="fa fa-tasks"></i>',
        'link' => url('roles'),
        'name' => trans('Phân quyền'),
        'childrens' => []
      ],
    ],
  ];
  @endphp
@endrole
@role('customer')
  @php
    $menuData[] = [
      'icon' => '<svg width="20" height="16" viewBox="0 0 20 16" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path d="M15.8499 7.72168H13.5999L11.7999 10.4217H8.1999L6.3999 7.72168H4.1499" stroke="#4D6E99" stroke-linecap="round" stroke-linejoin="round"/>
      <path d="M4.105 1.52073L1 7.72173V13.1217C1 13.5991 1.18964 14.057 1.52721 14.3945C1.86477 14.7321 2.32261 14.9217 2.8 14.9217H17.2C17.6774 14.9217 18.1352 14.7321 18.4728 14.3945C18.8104 14.057 19 13.5991 19 13.1217V7.72173L15.895 1.52073C15.746 1.22084 15.5163 0.968462 15.2317 0.79198C14.9471 0.615498 14.6189 0.521906 14.284 0.521729H5.716C5.38112 0.521906 5.05294 0.615498 4.76834 0.79198C4.48374 0.968462 4.25402 1.22084 4.105 1.52073V1.52073Z" stroke="#4D6E99" stroke-linecap="round" stroke-linejoin="round"/>
      </svg>
      ',
      'link' => '#',
      'name' => 'Vận hành kho',
      'alias'=> 'administrator',
      'sub-menu-alias' => 'roles,users,warehouse_types',
      'childrens'=>[
        [
          'icon' => '<i class="fa fa-users"></i>',
          'link' => route('statisticses.index'),
          'name' => trans('Thống kê'),
          'childrens' => []
        ],
        [
          'icon' => '<i class="fa fa-users"></i>',
          'link' => route('categories.index'),
          'name' => trans('Danh mục (SP)'),
          'childrens' => []
        ],
        [
          'icon' => '<i class="fa fa-users"></i>',
          'link' => route('items.index'),
          'name' => trans('Sản phẫm'),
          'childrens' => []
        ],
        [
          'icon' => '<i class="fa fa-users"></i>',
          'link' => route('goodsnotes.index'),
          'name' => trans('Phiếu kho'),
          'childrens' => []
        ],
        [
          'icon' => '<i class="fa fa-tasks"></i>',
          'link' => route('warehouses.index'),
          'name' => trans('Kho hàng'),
          'childrens' => []
        ],
        [
          'icon' => '<i class="fa fa-tasks"></i>',
          'link' => route('packages.index'),
          'name' => trans('Kiện hàng'),
          'childrens' => []
        ],
      ],
    ];
  @endphp
@endrole
<div class="main-menu-content">
    <ul id="main-menu-navigation" data-menu="menu-navigation" class="navigation navigation-main">
      <li class=" navigation-header">
        <span class="d-none">System</span>
        {{-- <i data-toggle="tooltip" data-placement="right" data-original-title="System" class=" ft-minus"></i> --}}
      </li>
      @foreach($menuData as $_index => $_menuItem)
        @php
          $childrens = $_menuItem['childrens'] ?? [];
          $subMenuAlias = explode(',', $_menuItem['sub-menu-alias'] ?? '');
          $links = array_map(function ($k){return $k['link'] ?? null;}, $childrens);
          $hasOpen = (array_key_exists($currentURL, array_flip($links)) || array_key_exists(request()->segment(1), array_flip($subMenuAlias)) ) ? 'open' : '';
        @endphp
        <li class=" nav-item border-bottom- open {{$hasOpen}}">
          <a href="{{$_menuItem['link']}}">
            <div class="icon" >{!!$_menuItem['icon']!!}</div>
            <span data-i18n="" class="menu-title">{{$_menuItem['name']}}</span>
          </a>
          @if(!empty($_menuItem['childrens']))
            <ul class="menu-content">
              @foreach($_menuItem['childrens'] as $__index => $__menuItem)
              @php 
                $active = ($currentURL === $__menuItem['link'] ?? null) ? 'active' : '';
                $hr = (($__menuItem['icon'] ?? '') === '<hr>') ? 'hr' : '';
              @endphp
                <li class=" nav-item border-bottom-">
                  <a class="menu-item {{$active}} {{$hr}}" href="{{$__menuItem['link']}}">
                    <label class="icon pr-">{!!$__menuItem['icon']!!}</label>
                    <span class="">{{$__menuItem['name']}}</span>
                  </a>
                </li>
              @endforeach
            </ul>
          @endif
        </li>
      @endforeach
        <li class="nav-item" style="position: absolute; bottom: 39px;border-left: inherit;">
          <a href="#" id="menu-toggle-ext" class="">
            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M17 1V8C17 9.06087 16.5786 10.0783 15.8284 10.8284C15.0783 11.5786 14.0609 12 13 12H1L6 7M4 15L6 17" stroke="#4D6E99" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <span class="menu-title- ml-2">Ẩn bảng điều khiển</span>
          </a>
        </li>
    </ul>
</div>
<script type="text/javascript">
  $('#menu-toggle-ext').on('click', function (e) {
    $('#menu-toggle').trigger('click');
  })
</script>
