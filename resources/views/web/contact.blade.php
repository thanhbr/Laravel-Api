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
        <div class="title white display-4">{{__("Contact us")}} </div>
        <div class="content">
          <ul class="nav">
            <li class="nav-item"><i class="icon-pointer"></i> 339/34A2 To Hien Thanh street, 12 ward, District 10, Ho Chi Minh City</li>
            <li class="nav-item"> <i class="icon-call-end "></i>+84 3 9999 8910</li>
            <li class="nav-item"><i class="icon-envelope-open"></i> info@tektop.vn</li>
          </ul>
        </div>
      </div>
    </div>
  </div>

</x-block>
<x-block class="container-fluid bound">
  <div class="container white pt-2 pb-2 ">

    <div class="row mb-2">
      <div class="col-md-6">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.4420914753996!2d106.66238997010673!3d10.777412743353018!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752edb2a904977%3A0x9ce7b098e14a3bf3!2zMzM5LzM0QTIgVMO0IEhp4bq_biBUaMOgbmgsIFBoxrDhu51uZyAxMiwgUXXhuq1uIDEwLCBUaMOgbmggcGjhu5EgSOG7kyBDaMOtIE1pbmgsIFZp4buHdCBOYW0!5e0!3m2!1svi!2s!4v1626715437579!5m2!1svi!2s" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
      </div>
      <div class="col-md-6">
        <div class="mt-2 mb-2">
          <h2 class="text-bold-600">{{__("Got an idea?")}} </h2>
          <h2 class="text-bold-600">{{__("We can help you make it better")}} </h2>
        </div>
        <div class="font-medium-2 text-justify">
          <div class="form-group">

            <input type="text" class="form-control bg-tip" placeholder="{{__('Your name')}}" />
          </div>

          <div class="form-group">

            <input type="email" class="form-control bg-tip" placeholder="{{__('Your email')}}" />
          </div>
          <div class="form-group">
            <textarea class="form-control bg-tip" rows="6" placeholder="{{__('Tell us about it')}}"></textarea>

          </div>
          <div class="form-footer">

            <button class="btn btn-est btn-primary pull-right">{{__('Send message')}}</button>

          </div>

        </div>

      </div>


    </div>
  </div>
</x-block>

@endsection
@section('footer')
<x-layout.inc.footer />
@endsection

<x-layout.simple class="bg-tek" />