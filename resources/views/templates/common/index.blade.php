@extends('components.form.index')
@php
  /**
  * @todo
  */
  $pageTitle = $pageTitle ?? '';
  $addLink = $addLink ?? '';
  $importLink = $importLink ?? '';
  $exportLink = $exportLink ?? '';
@endphp
@section('navbar-more')
  <div class=" text-uppercase">{{$pageTitle}}</div>
@endsection
@section('container-before')
<style type="text/css">
  
</style>
<form method="GET" action="{{url()->current()}}" class="page-heading">
  <div class="row">
    <div class="col-xs-8 col-md-6 " >
      @if(!empty($filterData))
        @include('components.form.filter')
      @else
        @include('components.form.search')
      @endif
    </div>
    <div class="col-xs float-xs-right">
      <div class="d-inline">
        <a class="btn btn-secondary btn-export-excel export-list" href="{{$exportLink}}" target="_blank">
          <span class="" >{!! trans('app.export-excel') !!}</span>
          <i class="fa fa-file-excel-o fa-1x mr-1" aria-hidden="true" title="{!! trans('app.export-excel') !!}"></i>
        </a>
      </div>
      <div class="d-inline" >
        <a class="btn btn-secondary" href="{{$importLink}}" target="_self" >
          <span class="d-xs-none" >{!! trans('app.import-excel') !!}</span>
          <i class="icon-cloud-upload mr-1" aria-hidden="true" title="{!! trans('app.import-excel') !!}"></i>
        </a>
      </div>
      <div class="d-inline">
        <a class="btn btn-primary btn-utmddf" href="{{$addLink}}" target="_self" title="{!! trans('app.add') !!}">
          <span class="d-inline" >{!! trans('app.add') !!}</span>
          <i class="fa fa-plus" aria-hidden="true"></i>
        </a>
      </div>
    </div>
  </div>
</form>
@endsection
@section('scripts')
  @parent
@endsection