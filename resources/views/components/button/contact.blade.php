@props(['id','out'])
<button {{ $attributes }}
  data-toggle='modal'
  data-target='#{{ Auth::check() ? "modal-contact-$id": "modal-login" }}'>
{{$out}}
</button>
