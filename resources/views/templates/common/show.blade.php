@php
  /**
  * @todo
  */
  $pageTitle = $pageTitle ?? '';
  $modelDefault = $modelDefault ?? null;
  $editLink = $editLink ?? '';
  $backLink = $backLink ?? [];
@endphp
@section('navbar-more')
  <div class="text-uppercase" >{{$pageTitle}}</div>
@endsection
@section('css')
  @parent
  <style type="text/css">
    .app-view.app-view-show .container-fluid{}
    .app-view.app-view-show .card .card-block .section-action .btn {min-width: 120px;}
  </style>
@endsection
<div class="app-view app-view-show">
  <div class="container-fluid">
    <div class="card">
      <div class="card-body">
          <div class="card-block">
              @foreach($customAttribute as $_attr => $_attrValue)
            <div class="row show-detail">
                @php
                  $value = $modelDefault->__get($_attr);
                @endphp
                <div class="col-sm-12 col-md-8 col-lg-6">
                  <div class="form-group row" >
                    <label class="col-12 control-label">
                      @if(is_string($_attrValue)){{$_attrValue}}
                      @elseif(is_array($_attrValue)) {{$_attrValue['label'] ?? ''}}
                      @else {{$_attr}}
                      @endif
                    </label>
                    <div class="col-12 control-field">
                      @switch($_attr)
                        @case(!!preg_match('/_date/', $_attr))
                          @php
                            $value = date_create($value) && !empty($value) ? date_create($value)->format('d/m/Y H:i') : '';
                          @endphp
                          <span  class="form-control" > {{($value)}} </span>
                          @break
                        @case(!!preg_match('/path_file_upload/', $_attr))
                          <div class="path-file-upload form-control">
                            @foreach($value as $_k => $_pathFile)
                              @php
                                $url = url()->current() . '?download='.$_pathFile;
                              @endphp
                              <div class="btn-group" style="display:flex;margin-bottom: .5rem">
                                <button class="btn p-0" style="min-width: 300px;cursor:">
                                  <div class="text-primary px-1">
                                    {{$_pathFile}}
                                  </div>
                                </button>
                                <button class="btn btn-success">
                                  <a class="text-white" href="{{$url}}" title=" {{$_pathFile}}"> <i class="fa fa-download"></i>
                                  </a>
                                </button>
                              </div>
                            @endforeach
                          </div>
                          @break
                        @default
                          <div class="form-control" style="min-height: 44px">{{($value)}}</div>
                      @endswitch
                    </div>
                  </div>
                </div>
            </div>
              @endforeach
            <div class="row section-action">
              <div class="col-sm-12 col-md-8 col-lg-6 px-0">
                <span class="float-sm-right">
                  <span class="btn round btn-primary m-1">
                    @if(!empty($backLink))
                      <a href="{{$backLink['href'] ?? $backLink[0] ?? ''}}" class="btn-back d-flex text-uppercase">
                        <i class="fa fa-reply px-1 d-none"></i>{{$backLink['label'] ?? $backLink[1] ?? 'Trang trước'}}
                      </a>
                    @endif
                  </span>
                  @if($editLink)
                    <a href="{{$editLink}}" class="btn btn-outline-warning m-1">{{__('app.edit')}}</a>
                  @endif
                </span>
              </div>
            </div>
          </div>
        </div>
    </div>
  </div>
</div>
@section('scripts')
  @parent
  <script type="text/javascript"></script>
@endsection  
