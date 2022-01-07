@php
$image = asset("theme/images/home/about.png");
$title = __("About us");
$content= "TekTop is the leading software development company in Ho Chi Minh City, Vietnam,
founded in early 2016 with a team of professional and enthusiastic Web developers,
Mobile developers, UI/UX designers and BA experts.
Following a systematic approach, we intend to deliver the best and most cost-effective software services to our clients. ";
@endphp

<div class="container" style="padding-top: 8rem;">
  <div class="row">
    <div class="col-md-6">
      <img src="{{ $image }}" loading="lazy" class="img-fluid" />
    </div>
    <div class="col-md-6">
      <div class="card-header">
        <h4 class=" display-4 text-bold-600">{{ $title }}</h4>
      </div>

      <div class="card-block font-medium-2 text-justify">
        {!! $content !!}

      </div>

    </div>
  </div>


</div>