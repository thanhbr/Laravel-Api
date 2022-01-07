<div id="home-slide" class="carousel-fade ">
  <x-block class="carousel-inner">

    @foreach( $slider as $banner )
    <div @if($banner->avatar)
      data-bg-img="{{url($banner->avatar->src)}}"
      @endif
      class="lazy carousel-item bg {{ $loop->first ? 'active' :'' }} " >
      <div class="col-xs-6 banner-header">
        <h2 class=" font-large-3 text-bold-700"> {{$banner->title }} </h2>
      </div>
    </div>
    @endforeach
  </x-block>
  <x-block class="search">

    <div class="col-xs-6">

      <fieldset class="form-group row position-relative">
        <input type="text" class="form-control form-control-xl input-xl" placeholder="Website Developer" />
        <div class="form-control-position">
          <i class="ft-search danger font-medium-4"></i>
        </div>
      </fieldset>
    </div>

  </x-block>
</div>
