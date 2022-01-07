@php
$address = "339/34A2, Tô Hiến Thành, Phường 12, Quận 10, Thành phố Hồ Chí Minh, Việt Nam";
$name = "CÔNG TY TNHH CÔNG NGHỆ TEKTOP";
$tel = "+84. 9999.8910";
$email = "info@tektop.vn";
$worktime= "from 9:00 to 18:00";
$right = "Copyright @ 2021 TekTop lnc. All rights reserved";
$menu_1 =[
url('#about') => 'about us',
url('#service') => 'service',
url('#project') => 'project',

];

$menu_2 =[

url('#careers') => 'careers',
url('#blog') => 'blog',
url('#contact') => 'contact',
];



$social= [
"#facebook" => asset('theme\images\logo\facebook.png'),
"#youtube" => asset('theme\images\logo\youtube.png'),
"#zalo" => asset('theme\images\logo\zalo.png'),
];
@endphp

<x-block tag="footer" id="footer" class="footer bg-tip footer-static">
  <div class="container p-2">
    <div class="row">
      <div class="col-md-2">
        <x-logo />
      </div>
      <div class="col-md-4 text-justify">
        <h4 class="mb-1 text-bold-600">{{$name}}</h4>
        <div class="card-body">

          <div class="row">
            <label class="col-xs-3"> Tel:</label> {{ $tel }}
          </div>

          <div class="row">
            <label class="col-xs-3">Email : </label> {{ $email }}
          </div>
          {{ $address }}
        </div>

      </div>


      <div class="col-md-2">

        <ul class="nav ml-1">
          @foreach($menu_1 as $link => $item)
          <li class="nav-item">
            <a href="{{ $link }}" class="nav-link">{{ Theme::title($item) }} </a>
          </li>
          @endforeach
        </ul>

      </div>
      <div class="col-md-2">

        <ul class="nav ml-1">
          @foreach($menu_2 as $link => $item)
          <li class="nav-item">
            <a href="{{ $link }}" class="nav-link">{{ Theme::title($item) }} </a>
          </li>
          @endforeach
        </ul>

      </div>

      <div class="col-md-2">

        <h4 class="card-title">
          {{ __('Follow TekTop')}}
        </h4>
        @foreach( $social as $link=> $item)
        <a href="{{$link}}">
          <img loading="lazy" class="ic" src="{{ $item }}" />
        </a>
        @endforeach
     
      </div>




    </div>
  </div>
  <div class="container-fluid p-1 line-t">
    <div class="text-xs-center">
      {{__($right)}}
    </div>
  </div>
</x-block>