@inject('Str', 'Illuminate\Support\Str')
@php
  /**/
  $filter = $filter ?? null;
  $dataRows = $dataRows ?? [];
  $colTitle = $colTitle ?? [];
  $pageTitle = $pageTitle ?? '';
  $importLink = $importLink ?? '';
  $exportLink = $exportLink ?? '';
  $addLink = $addLink ?? '';
@endphp
<style type="text/css">
  .app-view.app-view-index {}
  /*.app-view table tbody tr td {padding: .5rem}*/
  .app-view.app-view-index table thead tr th.th-no,
  .app-view.app-view-index table tbody tr td.td-no {max-width: 30px!important;padding-right:7px!important;padding-left:7px!important;}
  .app-view.app-view-index table tbody tr td >div.lbl-description{max-height: 100px;overflow-y: auto;}
  .app-view.app-view-index table tbody tr td.td-description{min-width: 300px}
  /*customize*/
  /*@media screen and (max-width: 1366px) and (min-width: 480px) {.app-view table.datatable tbody tr td{max-width: 136px!important}}*/
  
</style>
<div class="app-view app-view-index">
  <div class="app-view-title">
    <form method="GET" action="{{url()->current()}}">
      @hasSection('container-before')
        @yield('container-before')
      @else
        @section('navbar-more')
            <div class="text-uppercase">{{$pageTitle}}</div>
        @endsection
        <div class="row">
          <div class="col col-xs-12 col-md-6 float-xs-left">
            <div class="btn-">
              @if($filter->isEmptyData())
                @include('components.form.search')
              @else
                @include('components.form.filter')
              @endif
            </div>
          </div>
          <div class="col col-xs float-xs-left float-md-right">
            @if(!empty($exportLink))
              <a class="btn btn-export-excel export-list-" href="{{$exportLink}}" target="_blank">
                <span class="" >{!! trans('app.export-excel') !!}</span>
                <i class="fa fa-file-excel-o fa-1x mr-1" aria-hidden="true" title="{!! trans('app.export-excel') !!}"></i>
              </a>
            @endif
            @if(!empty($addLink))
            <a class="btn btn-add " href="{{$addLink}}">Thêm mới<i class="fa fa-plus ml-1"></i></a>
            @endif
          </div>
        </div>
      @endif
    </form>
  </div>
  <div class="container-fluid">
    <div class="row">
      <div class="col-xs-12 p-0">
        @if(!empty($dataRows))
          <div class="card card-upos mb-0">
            <div class="card-body">
              <div class="table-responsive form-group mb-0">
                <table class="datatable align-middle nowarp mb-0 table table-borderless table-striped- table-hover ">
                  <thead class="border-bottom text-uppercase">
                    @foreach($colTitle as $_tt_k => $_tt_v)
                      <th class="{{'th-'.$_tt_k}}">{!!$_tt_v!!}</th>
                    @endforeach
                  </thead>
                  <tbody>
                    @foreach($dataRows as $_key => $_item)
                      @php
                        $id = $_item['id'] ?? '';
                      @endphp
                      <tr id="tr-{{$id}}" style="border-radius: 25px">
                        @foreach($colTitle as $_tt_k => $_tt_v)
                          @php
                            $value = $_item[$_tt_k] ?? '';
                            $slugAtt = str_replace('_', '-', $_tt_k);
                            $tdClass = 'lbl-'.$slugAtt;
                          @endphp
                          <td class="td-{{$slugAtt}}">
                            @switch(1)
                              @case(!!preg_match('/^code-link$/', $_tt_k))
                                <div class="{{$tdClass}}">
                                  <a class=" text-info btn-utmddf-" href="{{$value['href'] ?? ''}}">{{$value['label']??''}}</a>
                                </div>
                                @break
                              @case(!!preg_match('/-link$/', $_tt_k))
                                <div class="{{$tdClass}}">
                                  <a class=" text-info btn-utmddf-" href="{{$value['href'] ?? ''}}">{{$value['label']??''}}</a>
                                </div>
                                @break
                              @case(!!preg_match('/smalltool/', $_tt_k))
                                <div class="{{$tdClass}} row">
                                  @if(is_array($value)) 
                                    @foreach ($value as $t_key => $tool)
                                     {!!$tool!!}
                                    @endforeach
                                  @endif
                                </div>
                                @break
                               @case(!!preg_match('/^_action$/', $_tt_k) && is_array($value))
                                <div class="{{$tdClass}} row">
                                    @foreach ($value as $t_key => $url)
                                        @switch($t_key)
                                          @case('show')
                                            <a href="{{$url}}" class="{{$_tt_k.$t_key}}" title="{{__('app.'.$t_key)}}">
                                              <span class="fonticon-wrap pr-1 text-info"><i class="fa fa-eye"></i></span>
                                            </a>
                                            @break
                                          @case('edit')
                                            <a href="{{$url}}" class="{{$_tt_k.$t_key}}" title="{{__('app.'.$t_key)}}">
                                              <span class="fonticon-wrap pr-1 text-warning"><i class="fa fa-edit"></i></span>
                                            </a>
                                            @break
                                          @case('destroy')
                                            <a href="{{$url}}" label="{{$_item['code'] ?? ''}}" class="btn-delete {{$_tt_k.$t_key}}" title="{{__('app.'.$t_key)}}">
                                              <span class="fonticon-wrap pr-0 text-danger"><i class="fa fa-trash"></i></span>
                                            </a>
                                            @break
                                          @default
                                        @endswitch
                                    @endforeach
                                </div>
                                @break
                              @case(!!preg_match('/(_date|datetime|created_at|updated_at|deleted_at)$/', $_tt_k))
                                @if(empty($value) || !date_create($value)) @break @endif
                                <div class="{{$tdClass}}">{{date('d/m/Y H:i',strtotime($value))}}</div>
                                @break
                              @case(!!preg_match('/^type$/', $_tt_k))
                                @if(is_string($value))
                                  <div class=" {{$tdClass}} {{$Str::slug($value)}}">{{$value}}</div>
                                @elseif(is_array($value))
                                  <div class=" {{$tdClass}} {{$Str::slug($value['code']??'')}}">{{$value['name']??''}}</div>
                                @endif
                                @break
                              @case(!!preg_match('/^status$/', $_tt_k))
                                @if(is_string($value))
                                  <div class="tag {{$tdClass}} {{$Str::slug($value)}}">{{$value}}</div>
                                @elseif(is_array($value))
                                  <div class="tag {{$tdClass}} {{$Str::slug($value['code']??'')}}">{{$value['name']??''}}</div>
                                @endif
                                @break
                              @default
                                @if(!is_array($value) && !is_object($value))
                                  <div class="{{$tdClass}}">{{$value}}</div>
                                @endif
                            @endswitch
                          </td>
                        @endforeach
                      </tr>
                    @endforeach
                  </tbody>
                </table>
                @if(isset($pagination))
                  <div class="px-3">
                    {{ $pagination->appends(request()->input())->render('partials.pagination') }}
                  </div>
                @endif
              </div>
            </div>
          </div>
        @endif
      </div>
    </div>
  </div>
  @yield('container-after')
</div>
@section('scripts')
  <script>
    let dataTable = null;
    $(document).ready(function() {
      @if(session('success'))
        toastFlash({title:"{!! session('success') !!}",timer:2000});
      @elseif(session('failed'))
        toastFlash({title:"{!! session('failed') !!}",timer:2000,icon:'warning'});
      @endif
      /*datatable*/
      let config = {
          sDom: 'tb',
          paging: false,
          oLanguage: {
            sLengthMenu: "_MENU_",
            sInfo: "_START_ - _END_ of _TOTAL_ ",
            oPaginate: {
              "sFirst": '<i class="fas fa-step-backward"></i>',"sLast": '<i class="fas fa-step-forward"></i>',
              "sNext": '<i class="fas fa-chevron-right"></i>',
              "sPrevious": '<i class="fas fa-chevron-left"></i>'},
            sSearch: "",
          },
          language:{
            infoFiltered:" / _MAX_ ",
            select: { rows: '<span class="px-1"> Đã chọn %d </span>'},
          },
          colReorder: true,
        }
      dataTable = $('.datatable').DataTable(config);
      dataTable.on( 'order.dt search.dt', function () {
        dataTable.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {cell.innerHTML = '<div class="lbl-no text-center px-1">' + (i+1) + '</div>';});
        }).draw(false);
      /**/
      $('input[type=reset]').on('click', function(e){
        $('#search_range_date').val("");
      })
      /**/
      $('#btn-clear-filter').on('click', function(e){
        $(this).closest('form').find('input[type=text], select').val("");
        $(this).closest('form').submit();
      })
      /*delete*/
      $('.btn-delete').on('click', function(e){
        e.preventDefault();
        let this_btn = this;
        let label = $(this_btn).attr('label');
        let url = $(this_btn).attr('href');
        if(label === undefined) {swalAlert('Không xác định đối tượng !', 'error');return false;}
        if(url === '') {swalAlert('Không tìm thấy URL !', 'error');return false;}
        swalConfirm("Xóa " + label,"Bạn đã chắc chắn ?", function(r){
          if (r) {
            $.ajax({
              url: url,
              type:'POST',
              data: {_method:'DELETE', _token:'{{csrf_token()}}'},
              dataType : "json",
              beforeSend: function(request) {
                request.setRequestHeader("X-CSRF-TOKEN",'{{csrf_token()}}');
              },
              success: function(response) {},
              statusCode: {
                301: function() {
                  let row = $(this_btn).closest('tr');
                  console.log(row);
                  dataTable.row(row).remove().draw();
                  const totalPage = $('.total-page').first().find('span');
                  if (totalPage != undefined) {
                    totalPage.html(parseInt(totalPage.html()) - 1 )
                  }
                  toastFlash({title:"{{trans('titles.deleted_success')}}",timer:2000});
                },
                302: function(){
                  toastFlash({title:"{{trans('titles.deleted_failure')}}",timer:2000,icon:"warning"});
                }
              }
            });
          }
        },{
          confirmButtonText: "Xóa",
          cancelButtonText:"Đóng",
          icon:"warning",
        });
      })
    });
  </script>
  @yield('scripts-more')
@endsection
