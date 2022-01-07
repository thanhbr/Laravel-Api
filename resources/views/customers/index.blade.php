@extends('components.form.index')

@section('css')
  @parent
  <style type="text/css">
    .app-view .container-fluid table.datatable .tag.lbl-status.new{ background-color: #08e7a4; }
    .app-view .container-fluid table.datatable .tag.lbl-status.contracted{ background-color: #22c2dc; } 
    .app-view .container-fluid table.datatable .tag.lbl-status.consulting{ background-color: #08e7a4; } 
    .app-view .container-fluid table.datatable .tag.lbl-status.lossed{ background-color: #08e7a4; } 
    .app-view .container-fluid table.datatable .tag.lbl-status.refuse{ background-color: #08e7a4; } 
    .app-view .container-fluid table.datatable .tag.lbl-status.trial{ background-color: #08e7a4; } 
    .app-view .container-fluid table.datatable .tag.lbl-status.tried{ background-color: #08e7a4; } 
  </style>
@endsection
@section('scripts')
  @parent
@endsection