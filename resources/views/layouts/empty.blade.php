@hasSection('content')
    @yield('content')
@endif
    @php
    try {
      $data = $data ?? [];
      echo view($view ?? '', $data);
    } catch (Exception $e) {logger($e->getMessage());}
@endphp