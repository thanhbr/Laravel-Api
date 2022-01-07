@extends('components.form.create')
<style type="text/css">
  .app-view.app-view-create {max-width: 1141px;}
  .app-view.app-view-create input,
  .app-view.app-view-create select,
  .app-view.app-view-create textarea, 
  .app-view.app-view-create .singledate-picker,
  .app-view.app-view-create .control-field > .form-control,
  .app-view.app-view-create .select2,
  .app-view.app-view-create .control-field > .form-control,
  .app-view.app-view-create .form-group {max-width: 550px!important;}
  .app-view.app-view-create .col-md-6.att-district_id,
  .app-view.app-view-create .col-md-6.att-ward_id{width: 25%;}
</style>
@section('navbar-more')
  <div class="text-uppercase" >{{$pageTitle}}</div>
@endsection
@section('container-before')
  <div class="p-1">
    <div class=" text-uppercase"></div>
  </div>
@endsection
@section('scripts')
  @parent
  <script>
</script>
@endsection