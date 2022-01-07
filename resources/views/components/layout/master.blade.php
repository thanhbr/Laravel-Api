
@push('css')
  <style>
    .ph{
      padding-top: 10rem;
    }
  </style>
@endpush

@section('body')
  <div id="sticky-wrapper" class="bg-white sticky-wrapper line-b">
      <x-layout.inc.header />
      @stack('sticky')
  </div>

  <div class="content-wrapper ph">
    @yield('content')
  </div>
@endsection
@section('footer')
  <x-layout.inc.footer />
@endsection

@push('script')
  <script src="{{asset('theme/js/firebase.js')}}" ></script>
@endpush
@push('outer')
  <x-modal.login />
  <x-modal.register />
@endpush
<x-layout.simple class="bg-white" />
