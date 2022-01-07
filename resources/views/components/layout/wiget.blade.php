@props(['title','id'])
@section('body')
<x-block class="container-fluid mb-1">
  <div class="col-md-10">
    <h4 class="card-title ml-1 mt-1">
      @if(isset($title))
      {{ Str::title(__($title)) }}
      @endif
    </h4>
  </div>
  <div class="col-md-2">
    <button type="button" class="btn btn-info mt-1 pull-right" onclick="parent.location.reload();">
      <span aria-hidden="true"> X </span>
    </button>
  </div>
</x-block>
<x-block class="container">
  @yield('content')
</x-block>
@endsection
@push('script')
  <script src="{{asset('theme/js/app-menu.min.js')}}"></script>
  <script src="{{asset('theme/js/app.js')}}"></script>
@endpush
<x-layout.simple />