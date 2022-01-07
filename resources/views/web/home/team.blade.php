@php
$image = asset("theme/images/home/global.png");
$avatar_1 = asset("theme/images/home/team/thach.png");
$avatar_2 = asset("theme/images/home/team/long.png");
$avatar_3 = asset("theme/images/home/team/duy.png");

$title = __("TekTop's team");
$content= "TekTop is the leading software development company in Ho Chi Minh City, Vietnam,
founded in early 2016 with a team of professional and enthusiastic Web developers,
Mobile developers, UI/UX designers and BA experts.
Following a systematic approach, we intend to deliver the best and most cost-effective software services to our clients. ";
@endphp

<div class="container white">
  <div class="content-header p-2 text-xs-center">
    <h4 class=" display-4 text-bold-600">{{ $title }}</h4>

  </div>
  <div class="card-block">
    <div class="row">

      <div class="col-md-4 text-xs-center">
        <img src="{{ $avatar_1 }}" loading="lazy" class="rounded-circle img-border box-shadow-1" style="width:70%" />
        <h2 class="card-title text-bold-700 p-2"> CEO </h2>
      </div>


      <div class="col-md-4 text-xs-center">
        <img src="{{ $avatar_2 }}" loading="lazy" class="rounded-circle img-border box-shadow-1" style="width:70%" />
        <h2 class="card-title text-bold-700 p-2"> CTO </h2>
      </div>


      <div class="col-md-4 text-xs-center">
        <img src="{{ $avatar_3 }}" loading="lazy" class="rounded-circle img-border box-shadow-1" style="width:70%" />
        <h2 class="card-title text-bold-700 p-2"> CCO </h2>
      </div>

    </div>
  </div>


</div>