@php
$content = "TekTop put customers' satisfaction on the top of our list.
After studying through users' needs, wants, and limitations,
we apply cutting-edge technologies to create functional, large-scale,
engaging mobile apps and responsive web designs. ";


@endphp

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
  <div class="container mb-2">
    <div class="row lazy">
      <div class="col-md-8 banner-header">
        <div class="title white display-4">{{__("Services")}} </div>
        <div class="content">
          {!! $content !!}
        </div>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="row match-height">
      <div class="col-md-4">
        <div class="card text-xs-center">
          <img src="{{asset('theme/images/home/about.png')}}" loading="lazy" class="img-fluid">
          <div class="card-header">
            <h2> Web development </h2>

          </div>
          <div class="card-body">
            <div class="card-block">
              <ul class="nav">
                <li class="nav-item"> Fully customized
                </li>
                <li class="nav-item"> Single page</li>
                <li class="nav-item"> Realtime</li>
                <li class="nav-item"> Responsive</li>
              </ul>
            </div>

          </div>
        </div>

      </div>
      <div class="col-md-4">
        <div class="card text-xs-center">
          <img src="{{asset('theme/images/home/about.png')}}" loading="lazy" class="img-fluid">
          <div class="card-header">
            <h2>Mobile application
            </h2>

          </div>
          <div class="card-body">
            <div class="card-block">
              <ul class="nav">
                <li class="nav-item"> Native
                </li>
                <li class="nav-item"> Cross-platform</li>
                <li class="nav-item"> Multi-device support</li>
                <li class="nav-item"> Security</li>
              </ul>
            </div>

          </div>
        </div>

      </div>
      <div class="col-md-4">
        <div class="card text-xs-center">
          <img src="{{asset('theme/images/home/about.png')}}" loading="lazy" class="img-fluid">
          <div class="card-header">
            <h2> Consultant Service </h2>

          </div>
          <div class="card-body">
            <div class="card-block">
              <ul class="nav">
                <li class="nav-item"> Solutions
                </li>
                <li class="nav-item"> Intergrations</li>
                <li class="nav-item"> System designing
                </li>
                <li class="nav-item">ERP</li>
              </ul>
            </div>

          </div>
        </div>

      </div>

    </div>
  </div>
</x-block>
<x-block class="container-fluid bound">
  @php

  $title = __("Our working process");

  $slogan= "Got an idea? We can help you make it better."
  @endphp

  <div class="container">
    <div class="content-header p-2 mb-2 text-xs-center">
      <h4 class="display-4 primary text-bold-600">{{ $title }}</h4>

    </div>
    <div class="p-2 mb-2">
      <img class="img-fluid mb-2" src="{{ asset('theme/images/home/progress.png') }}" />
    </div>
    <div class="slogan bg-tip font-large-1 box p-2 mb-2">
      <div class="pull-left">

        {!! $slogan !!}
      </div>
      <div class="pull-right">
        <a href="{{route('estimate')}}" class="btn btn-est btn-primary"> {{ __("Estimate project") }} </a>
      </div>
    </div>

  </div>
</x-block>

@endsection
@section('footer')
<x-layout.inc.footer />
@endsection

<x-layout.simple class="bg-tek" />