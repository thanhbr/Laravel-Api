
  @if ($errors->any() && (env('APP_ENV') === 'local'))
    <div class="alert alert-warning ">
      <div class="h4">Chỉ hiện thị khi ở chế độ {{env('APP_ENV')}}</div>
      <hr>
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif
