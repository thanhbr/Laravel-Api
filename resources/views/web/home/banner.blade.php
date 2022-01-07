@php
$title = "TekTop is the leading software development company in Ho Chi Minh City, Vietnam, 
founded in early 2016 with a team of professional and enthusiastic Web developers, 
Mobile developers, UI/UX designers and BA experts. 
Following a systematic approach, we intend to deliver the best and most cost-effective software services to our clients. ";

$banner= asset('theme/images/home/slider.png');
$avatar= asset('theme/images/home/global.png');
@endphp
<div id="home-banner">
  <div data-bg-img="{{  $banner }}" class="lazy bg  ">
    <div class="col-md-6 banner-header">
      <div class="title white display-4">{{__("About us")}}  </div>
      <div class="content">
        {!!$title!!} 
      </div>
    </div>
  </div>
  
</div>