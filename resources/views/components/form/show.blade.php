@php
    /**
     * @author toannguyen.dev
     * @todo
     */
    /*intial*/
    $viewModel = $viewModel ?? NUll;
    $pageTitle = $pageTitle ?? '';
    $splitColumn = min(4, max(0,$splitColumn ?? $_GET['split-col'] ?? 1));
    $classSplitCol = ' col-md-'.(12 / $splitColumn);
    $createLink = $createLink ?? '';
    $cardTitle = $cardTitle ?? '';
    $backLink = $backLink ?? ['href' => back()->getTargetUrl()];
    $editLink = $editLink ?? null;                  
    try{
      if(empty($viewModel)) throw new \Exception("");
@endphp
  <style>
    /*.app-view .app-page-title .page-title-icon img{width: 20px;height: 20px}*/
    .app-view input,select,textarea {max-width: 500px!important;min-height: 43px; height: 43px}
    .app-view textarea,select {}
    .app-view input[type=checkbox]{max-width: 22px;box-shadow: none!important;}
    .as-row{display: flex; border-bottom: 0px solid #00b5b8; margin: 0px!important}
    .as-row label {margin: 0px; padding: 12px; font-weight: 600; text-transform: capitalize; }
    .as-row .col-12{width: initial!important;}
    .as-row .form-control{border:none;}
    .app-view .show-detail .control-label{font-weight: 400;color: #7D9AC0;font-size: 14px}
    .app-view.app-view-show .container-fluid .control-label > .has-required{display: none;}
    .app-view.app-view-show .container-fluid .control-field > .form-control:disabled,
    .app-view.app-view-show .container-fluid .control-field > .form-control[readonly] {background-color: inherit;}
  </style>
  @section('navbar-more')
    <div class="text-uppercase">{{$pageTitle}}</div>
  @endsection
  <div class="app-view app-view-show">
    <div class="app-view-title">
      @hasSection('container-before')
        @yield('container-before')
      @else
        <div class="row px-1 d-none">
          <div class="col-12 col-md-6 float-xs-left">
            <span class="btn text-uppercase">
            </span>
          </div>
          <div class="col-xs float-xs-right">
            @if(isset($backLink['href']))
            <a href="{{$backLink['href']}}" class="btn-back d-flex text-uppercase">
              @if(isset($backLink['label']))
              @else
                <i class="fa fa-reply"></i>
                {{$backLink['label'] ?? 'Trang trước'}}
              @endif
            </a>
            @endif
          </div>
        </div>
      @endif
    </div>
    <div class="container-fluid">
      <div class="card mb-0">
        @if(!empty($cardTitle))
          <div class="card-header">
            <div class="heading-title">{{$cardTitle}}</div>
          </div>
        @endif
        <div class="card-body">
          <div class="card-block-">
            <div class="row show-detail">
              @foreach($viewModel->toArray() as $_attr => $_attrValue)
                @php
                  $value = $_attrValue['value'] ?? null;
                  $classHide = '';
                  if(isset($_attrValue['attr']['hidden'])){$classHide = 'd-none';}
                  $attrLabel = empty($_attrValue['label']) ? $_attr : $_attrValue['label'];
                  $attrString = $_attrValue['attr_str'] ?? '';
                  $tag = $_attrValue['tag'] ?? 'span';
                  $option = (array) ($_attrValue['option'] ?? []);
                @endphp
                <div class="{{$classSplitCol}} {{$classHide}} px-2">
                  <div class="as-row form-group row " >
                    <label class="col-12 control-label">
                      {{$attrLabel}}:@if(isset($_attrValue['attr']['required']))<span class="has-required color-upos">*</span>@endif
                    </label>
                    <div class="col-12 control-field">
                      @switch($_attr)
                        @case(!!preg_match('/_date/', $_attr))
                          @php
                            $value = date_create($value) && !empty($value) ? date_create($value)->format('d/m/Y H:i') : '';
                          @endphp
                          <span {!!$attrString!!} class="form-control" > {{($value)}} </span>
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
                                    {{-- <i class="fa fa-file-word-o fa-2x"></i> --}}
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
                            @if($tag === 'input')
                              <input class="form-control" value="{{($value)}}" {!!$attrString!!} />
                              }
                            @elseif($tag === 'select' && !empty($option))
                              <select class="form-control select2" readonly {!!$attrString!!}>
                                @foreach($option as $__k => $___v )
                                  <option value="{{$___v['value']}}" {{$___v['selected']}}>{{$___v['label']}}</option>
                                @endforeach
                              </select>
                            @else
                              <{{$tag}} class="form-control" {!!$attrString!!}>{{($value)}}</{{$tag}}>
                            @endif
                      @endswitch
                    </div>
                  </div>
                </div>
              @endforeach
            </div>
            <div class="row p-2 {{$splitColumn ==1 ? 'text-xs-left' :'text-xs-right'}} section-button">
              <div class="col-xs-12" style="display:inline-flex;">
                <span class="btn " style="min-width: 180px;">
                  @if(isset($backLink['href']))
                    <a href="{{$backLink['href']}}" class="btn-back d-flex text-uppercase">
                      @if(isset($backLink['label']))
                        {{$backLink['label']}}
                      @else
                        <i class="fa fa-reply"></i>
                        {{$backLink['label'] ?? 'Trang trước'}}
                      @endif
                    </a>
                  @endif
                </span>
                @if($editLink)
                  <a href="{{$editLink}}" class="btn btn-outline-warning mr-1">{{__('app.edit')}}</a>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
      @yield('more-container')
    </div>
  </div>
@section('scripts')
  <script type="text/javascript">
    $(document).ready(function() {
      @if(session('success'))
        toastFlash({title:"{!! session('success') !!}",timer:2000});
      @elseif(session('failed'))
        toastFlash({title:"{!! session('failed') !!}",timer:2000,icon:'warning'});
      @endif
    });
  </script>
@endsection
@php
  }catch(\Throwable $e){logger($e);}
@endphp
