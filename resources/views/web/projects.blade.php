@php
$content = "Since the day TekTop was founded, as a moral commitment to our clients,
we always do our best to deliver highest-quality IT services to help them grow their
business at a world-class level. With talented teams full of software developing experts,
we put customers' satisfaction with the 1st priority. Thanks to our fine and affordable services,
we have gained a big reputation in the IT market and created a solid network of loyal customers. ";


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
        <div class="title white display-4">{{__("Projects")}} </div>
        <div class="content">
          {!! $content !!}
        </div>
      </div>
    </div>
  </div>

</x-block>
<x-block class="container-fluid bound ">
  <div class="content-header p-2 mb-2 text-xs-center">
    <h4 class="display-4 primary text-bold-600">{{ __('Typical projects') }}</h4>

  </div>
  <div class="container white pt-2 pb-2 ">

    <div class="row mb-2">
      <div class="col-md-6">
        <div class="mt-2">
          <h4 class=" display-4 text-bold-600">KingPang </h4>
        </div>
        <div class="font-medium-2 text-justify">
        As the linking platform between FREELANCER and CUSTOMERS, KINGPANG provides you with a flexible, safe and efficient working solution.

With KINGPANG, project implementation will become easy, helping you minimize risks, save costs and recruitment time. KINGPANG will bring you great experiences with outstanding advantages:

        </div>

      </div>
      <div class="col-md-6">
        <img src="{{ asset('theme/images/projects/kingpang.png')}} " loading="lazy" class="img-fluid" />
      </div>

    </div>
  </div>
  <div class="container white pt-2 pb-2 ">
    <div class="row mb-2">
      <div class="col-md-6">
        <img src="{{ asset('theme/images/projects/glife.png')}} " loading="lazy" class="img-fluid" />
      </div>

      <div class="col-md-6">
        <div class="mt-2">
          <h4 class=" display-4 text-bold-600">G Life </h4>
        </div>
        <div class="font-medium-2 text-justify">
          With G Life application, members can manage service packages for members that they have purchased,
          registered to use when needed; and receive supplier offers for G Life Member.
          Users also use G Life to check-in at events organized by G Life and service points exclusively for G Life members.

        </div>

      </div>

    </div>
  </div>
  <div class="container white pt-2 pb-2 ">
    <div class="row mb-2">
      <div class="col-md-6">
        <div class="mt-2">
          <h4 class=" display-4 text-bold-600">Kbvision Member </h4>
        </div>
        <div class="font-medium-2 text-justify">
        KBMember is an application for customers and agents of KBVISION Vietnam Trading Co., Ltd. to register for serials to accumulate points, exchange lottery tickets and exchange coins for cash. In addition, promotions and promotions are constantly updated on the application
        </div>

      </div>
      <div class="col-md-6">
        <img src="{{ asset('theme/images/projects/kbv.png')}} " loading="lazy" class="img-fluid" />
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