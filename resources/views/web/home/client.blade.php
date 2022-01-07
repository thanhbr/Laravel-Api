@php

$title = __("Make it better");
$content= "We deliver outsourcing solutions to start-ups and businesses
in all sectors such as finance, logistic, healthcare, media, education, ecommerce, etc.
Clients come to us with their ideas and we develop gorgeous, memorable branding.";

$slogan= "Got an idea? We can help you make it better."
@endphp

<div class="container">
  <div class="content-header p-2 text-xs-center">
    <h4 class="display-4 primary text-bold-600">{{ $title }}</h4>

  </div>
  <div class="row">
    <div class="offset-md-2 p-2 mb-2 col-md-8 font-medium-2 text-justify">

      {!! $content !!}

    </div>
  </div>
  <div class="slogan bg-tek font-large-1 box p-2">
    <div class="pull-left">

      {!! $slogan !!}
    </div>
    <div class="pull-right">
      <button class="btn btn-est btn-primary"> {{ __("Estimate project") }} </button>
    </div>
  </div>

</div>