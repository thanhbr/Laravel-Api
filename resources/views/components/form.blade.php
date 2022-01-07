@props(['method'=>'POST'])
<form {{ $attributes }} method="{{ ($method == 'GET') ? $method : 'POST' }}" >
  @csrf
  @method($method)

    {{ $slot }}
</form>
