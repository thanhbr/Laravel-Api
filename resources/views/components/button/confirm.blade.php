@props(['out'])
<button {{ $attributes }}
  data-toggle='modal'
  data-target='#{{ Auth::check() ? "modal-confirm": "modal-login" }}'>
{{$out}}
</button>
