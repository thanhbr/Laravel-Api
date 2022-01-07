@props(['name','accept'])
<label {{ $attributes }} >
  <i class="icon-paper-clip"></i>
  <span> {{ Theme::title('attach file') }} </span>

  <input type="file" {{ $name ?? '' }} {{ empty($accept) ? '': "accept='$accept'" }} class="none"  />
</label>
