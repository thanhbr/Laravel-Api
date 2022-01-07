@push('css')
<link href="{{asset('theme/css/home.css')}}" rel="stylesheet">
@endpush
@push('script')
<script>
  $('#home-slide').carousel({
    interval: 2000,
  });
</script>
@endpush
@section('body')
<x-block id="sticky-wrapper" class="bg-tip white sticky-wrapper line-b">
  <x-layout.inc.header />
</x-block>

<x-block class="container-fluid">

  <!-- /horizontal menu content-->
  <div class="container">
    @include('web.home.banner')
  </div>
</x-block>
@foreach([

'mission',
'culture',
'client',
'team'] as $block)

@php
$tip = empty($tip) ? 'bg-tip' : '';
@endphp
<x-block class="container-fluid bound {{ $tip }}">
  @include("web.home.$block")
</x-block>
@endforeach
@endsection
@section('footer')
<x-layout.inc.footer />
@endsection

<x-layout.simple class="bg-tek" />