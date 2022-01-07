@php
  /**
  * @todo
  */
  $pageTitle = $pageTitle ?? '';
  $modelDefault = $modelDefault ?? null;
  $storeLink = $storeLink ?? $modelDefault->route('update');
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
    @include('components.show-validation')
    <form class="form" action="{{$storeLink}}" id="frm_create" enctype="multipart/form-data" method="POST">
      @csrf
      @method('PUT')
      <div class="card">
        <div class="card-body">
            <div class="card-block">
              <div class="row">
                <div class="col-sm-12 col-md-8 col-lg-4">
                  @foreach($customAttribute as $_attr => $_attrValue)
                    <div class="row show-detail">
                      @php
                      $value = $modelDefault->__get($_attr);
                      $class_fieldset = '';
                      $class_NameTag = '';
                        if ($errors->has($_attr)) {
                          $class_fieldset = ' has-warning';
                          $class_NameTag = ' form-control-warning';
                        }elseif (old($_attr)) {
                          $class_fieldset = ' has-success';
                          $class_NameTag = ' form-control-success';
                        }
                      @endphp
                        {{-- <div class="col-sm-12 col-md-8 col-lg-4"> --}}
                          {{-- <div class="form-group row" > --}}

                        <fieldset class="form-group mb-0 {{$class_fieldset}}">
                          <label class="col-12 control-label">
                            @if(is_string($_attrValue)){{$_attrValue}}
                            @elseif(is_array($_attrValue)) {{$_attrValue['label'] ?? ''}}
                            @else {{$_attr}}
                            @endif
                          </label>
                          {{-- <div class="col-12 control-field"> --}}
                            @switch($_attr)
                              @case(!!preg_match('/(_date|created_at|updated_at|deleted_at)/', $_attr))
                                {{-- @php
                                  $value = date_create($value) && !empty($value) ? date_create($value)->format('d/m/Y H:i') : '';
                                @endphp
                                <span  class="form-control" > {{($value)}} </span> --}}
                                 @php
                                  if (!old($_attr)) {
                                    $value = date_create($value) && !empty($value) ? date_create($value)->format('d/m/Y') : '';
                                  }
                                  $txtInputId = 'txt-input-date'.$_attr;
                                  @endphp
                                  <div class="form-group singledate-picker m-0">
                                    <div class='input-group date' id='{{$txtInputId}}'>
                                      <input type='text' class="form-control" name="{{$_attr}}" value="{{$value}}" } />
                                      <span class="input-group-addon">
                                        <span class="fa fa-calendar-o"></span>
                                      </span>
                                    </div>
                                  </div>
                                  <script type="text/javascript">
                                  $(document).ready(function() {
                                    $('#{{$txtInputId}}').datetimepicker({format: 'DD/MM/YYYY'});
                                  })
                                  </script>
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
                              {{-- <fieldset class="form-group mb-0 {{$class_fieldset}}"> --}}
                                {{-- <label for="">Label:</label> --}}
                                <input type="text" name="{{$_attr}}" class="form-control {{$class_NameTag}}" placeholder="Name" value="{{old($_attr) ?? $modelDefault->{$_attr} ?? ''}}">
                                  <p class="has-error-message">
                                    @foreach ($errors->get($_attr) as $message)
                                      <small>{{$message}} </small><br>
                                    @endforeach
                                  </p>
                              {{-- </fieldset> --}}
                            @endswitch
                              </fieldset>
                          {{-- </div> --}}
                          {{-- </div> --}}
                        {{-- </div> --}}
                    </div>
                  @endforeach
                </div>
              </div>             
              <div class="row section-action">
                <div class="col-sm-12 col-md-8 col-lg-4 pt-2">
                  <span class="float-sm-right">
                    @if(!empty($backLink))
                      <span class="btn round btn-primary mx-2">
                          <a href="{{$backLink['href'] ?? $backLink[0] ?? ''}}" class="btn-back d-flex text-uppercase">
                            <i class="fa fa-reply px-1 d-none"></i>{{$backLink['label'] ?? $backLink[1] ?? 'Trang trước'}}
                          </a>
                      </span>
                    @endif
                    <button  type="submit" class="btn btn-warning btn-save mr-1">{{__('app.update')}}</button>
                  </span>
                </div>
              </div>
            </div>
          </div>
      </div>
    </form>
  </div>
</div>
@section('scripts')
  @parent
  <script type="text/javascript">
    $(document).ready(function() {
        @if (session('failed'))
          swalAlert("{!! session('failed') !!}", "error");
        @elseif(session('success'))
          let title ="{{session('success')}}", text = '{{session('text')}}';
          if(text === '' || text == undefined){
            text = "Bạn có muốn đến trang danh sách ?";
          }
          swalConfirm(title, text, function(r){
            if (r) {location.replace('{{$modelDefault->route('index')}}')}
          },{
            imageUrl:'/images/site/accepted.png',
            confirmButtonText: "Có",
            cancelButtonText:" Không",
          });
        @endif
    })
  </script>
@endsection  
