@props([
  'id'    =>  uniqid('tmp_'),
  'accept'=>  'image/*',
  'name'  =>  'avatar',
  'src'   =>   asset('theme/images/upload.png'),
  ])

<div id="{{$id}}"  >
  <button class="none" type="button"> 
    <i class="ft-x"></i> 
  </button>

  <label>
    <img {{$attributes}}  src="{{ $src }}" />
    <input type="file" class="none" accept="{{ $accept}}" name="{{$name}}">
  </label>

</div>
@push('x-script')

  temp('{{$id}}');
@endpush
