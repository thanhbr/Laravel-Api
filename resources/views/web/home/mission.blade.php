@php
$image = asset("theme/images/home/about.png");
$title = Theme::title("our mission");
$slogan= "Make it better";
$short = "Our mission is to help startups and businesses transform their ideas into real and impactful products.
We always work to offer you the best software solutions. ";

$content= "At TekTop, we believe that a successful product must help clients resolve their business problem,
and furthermore, improve their business growth. Impactful products, satisfied customers, developmental
businesses are our service roadmap.";
@endphp

<div class="container white pt-2 pb-2 ">

  <div class="row">
    <div class="col-md-6">
      <div class="mt-2">
        <h4 class="display-4 text-bold-600">{{ $title }}</h4>
      </div>
      <div class="font-medium-2 text-justify">
        {!! $content !!}

      </div>

    </div>
    <div class="col-md-6">
      <img src="{{ $image }}" loading="lazy" class="img-fluid" />
    </div>

  </div>

</div>