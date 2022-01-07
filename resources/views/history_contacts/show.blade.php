@php
  /**
  * @todo
  */
  $pageTitle = $pageTitle ?? 'Chi tiết lịch sử liên hệ';
  $editLink = $editLink ?? '';
@endphp
@section('navbar-more')
  <div class="text-uppercase" >{{$pageTitle}}</div>
@endsection
  <style type="text/css">    
  </style>
<div class="app-view">
  <div class="container-fluid">
    <div class="row">
      <div class="col-xs-12 p-0">
        
      </div>
    </div>
  </div>
</div>
@section('scripts')
  @parent
  <script type="text/javascript"></script>
@endsection  
