@php
$image = asset("theme/images/home/culture.png");
$title = __("Our culture");
$content= "At TekTop, we believe that a successful product must help clients resolve their business problem,
and furthermore, improve their business growth. Impactful products, satisfied customers, developmental
businesses are our service roadmap.";
@endphp

<div class="container white pt-2 pb-2">
  <div class="row">
    <div class="col-md-6">
      <img src="{{ $image }}" loading="lazy" class="img-fluid" />
    </div>
    <div class="col-md-6">
      <h4 class=" display-4 text-bold-600">{{ $title }}</h4>

      <div class="font-medium-2 text-justify">
        {!! $content !!}
      </div>

    </div>
  </div>


</div>