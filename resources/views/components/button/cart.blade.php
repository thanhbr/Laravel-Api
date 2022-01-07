@props(['id','out'])
<button {{ $attributes }}
  data-toggle='modal'
  data-target='#{{ Auth::check() ? "modal-cart-$id": "modal-login" }}'>
  {{$out}}
</button>
