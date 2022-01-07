@php
  /**
   * @author toannguyen.dev
   * @todo
   */
  /*intial*/
  try{ 
    $viewModel = $viewModel ?? NUll;
    if(empty($viewModel)) throw new \Exception(" The viewModel was null ");
    $objectID = $viewModel->get('id');
    $rowTitle = $rowTitle ?? [];
    $splitColumn = min(4, max(0,$splitColumn ?? $_GET['split-col'] ?? 1));
    $classSplitCol = ' col-md-'.(12 / $splitColumn);
    $editLink = $editLink ?? '';
    $updateLink = $updateLink ?? $viewModel->route('update');
    $backLink = $backLink ?? ['href' => back()->getTargetUrl()];
    $listLink = $listLink ?? $viewModel->route('index');
    $titleHeading = $titleHeading ?? trans('app.edit');
    $editTitle = trans('app.'.($editTitle ?? 'edit'));
    $pageTitle = $pageTitle ?? '';
@endphp
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/forms/icheck/icheck.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/forms/icheck/custom.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/plugins/forms/checkboxes-radios.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/pickers/datetime/bootstrap-datetimepicker.css')}}">
<style type="text/css">
  .app-view{}
  .app-view.app-view-edit .card {max-width: 1141px;margin: 0px;}
  .app-view.app-view-edit input.form-control,
  .app-view.app-view-edit select.form-control,
  .app-view.app-view-edit textarea.form-control,
  .app-view.app-view-edit .singledate-picker{min-height: 43px; height: 43px}
  .app-view.app-view-edit .control-field > .select2,
  .app-view.app-view-edit .control-field > .form-control,
  .app-view.app-view-edit .control-field > .form-group{max-width: 550px;min-height: 43px;}
  .app-view.app-view-edit .control-field > textarea.form-control{min-height: 86px!important;}
  .app-view.app-view-edit .form-actions{max-width:{{$splitColumn * 550}}px;}
  .app-view.app-view-edit .form-actions .btn {min-width: 140px;font-size: 18px;}
  .app-view.app-view-edit .select2-container .select2-selection--multiple .select2-selection__rendered {display: inline!important;}
  {{-- @media screen and (max-width: 550px) { --}}
    /*.app-view .section-button .btn {min-width: 130px;}*/
  /*}*/
}
</style>
<div class="app-view app-view-edit">
  @if ($errors->any())
    <div class="alert alert-warning d-none">
      <ul class="m-0">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif
  <div class="app-view-title">
    @hasSection('container-before')
      {{-- @yield('container-before') --}}
    @else
      <div class="row">
        <div class="col-12 col-md-6 float-xs-left">
          <span class="btn text-uppercase">{{$pageTitle}}</span>
        </div>
        <div class="col-xs float-xs-right">
          @if(isset($backLink['href']))
          <a href="{{$backLink['href']}}" class="btn btn-back d-flex text-uppercase">
            <i class="fa fa-reply"></i>
            {{$backLink['label'] ?? 'Trang trước'}}
          </a>
          @endif
        </div>
      </div>
    @endif
  </div>
  <div class="container-fluid p-1">
    <form action="{{$updateLink}}" id="frm_edit" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      <div class="card card-upos">
        <div class="card-header d-none">
          <div class="heading-title"></div>
        </div>
        <div class="card-body" style="background-color: #fff;">
          <div class="card-block pt-0 pb-1">
            <div class="row">
              @foreach($viewModel->toArray() as $_attr => $_attrValue)
                @php
                  $classHide = '';
                  if(isset($_attrValue['attr']['hidden'])){$classHide = 'd-none';}
                  $classCol = 'att-'.$_attr;
                  $attrArray = $_attrValue['attr'] ?? [];
                  $attrLabel = empty($_attrValue['label']) ? $_attr : $_attrValue['label'];
                  $attrString = $_attrValue['attr_str'] ?? '';
                  $tag = $_attrValue['tag'] ?? 'input';
                  $option = (array) ($_attrValue['option'] ?? []);
                  $value = old($_attr) ?? $_attrValue['value'] ?? null;
                  $has_error = $errors->has($_attr) ? ' has-error ' : '';
                @endphp
                <div class="{{$classSplitCol}} {{$classHide}} {{$classCol}}">
                  <div class="{{$has_error}} as-row form-group row">
                    <label for="" class="col control-label">
                      {{$attrLabel}}:
                      @if(isset($_attrValue['attr']['required']))
                        <span class="color-upos">*</span>
                      @endif
                    </label>
                    <div class="col control-field">
                      @switch(1)
                        @case(!!preg_match('/amount/', $_attr))
                          <input class="form-control" {!!$attrString!!} value="{{is_numeric($value) ? number_format($value) : $value}}" />
                          @break;
                        @case(!!preg_match('/_date/', $_attr))
                          @php
                          if (!old($_attr)) {
                            $value = date_create($value) && !empty($value) ? date_create($value)->format('d/m/Y') : '';
                          }
                          $txtInputId = 'txt-input-date'.$_attr;
                          @endphp
                          <div class="form-group singledate-picker m-0">
                            <div class='input-group date' id='{{$txtInputId}}'>
                              <input type='text' class="form-control" value="{{$value}}" {!!$attrString!!} />
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
                                $url = $viewModel->getLink('update');
                              @endphp
                              <div class="btn-group row" style="display:flex;margin-bottom: .5rem">
                                  <div class="text-primary px-1" title="{{$_pathFile}}">
                                    <i class="fa fa-file-word-o fa-2x"></i>
                                    <span class="pl-1">{{$_pathFile}}</span>
                                  </div>
                                  <div class=" btn-delete-file text-danger" data="{{$_pathFile}}" href="{{$url}}" title="Xóa file">
                                    <i class="fa fa-window-close fa-2x"></i>
                                  </div>
                              </div>
                            @endforeach
                            {{-- <hr> --}}
                            <ul class="file-description m-0"></ul>
                            <label for="{{$_attr}}" class=""><i class="fa fa-cloud-upload fa-2x text-info px-1"></i> Tải hợp đồng lên</label>
                            <input type="file" id="{{$_attr}}" class="p-1 d-none" {!!$attrString!!}>
                          </div>
                          @break
                        @case(isset($attrArray['type']) && !!preg_match('/radio/', $attrArray['type']))
                            <div class="form-control">
                              <div class="row skin skin-line ">
                                @foreach($option as $_index => $_tagArr)
                                  @php
                                    $id_rio = 'rio-' . $_attr . $_index;
                                  @endphp
                                  <div class="col-md-12 col-sm-12">
                                    <fieldset>
                                      <input type="{{$attrArray['type']}}" name="{{$_attr}}" id="{{$id_rio}}" {{$_tagArr['checked']}} value="{{$_tagArr['value']}}" {{$attrString}}>
                                      {{-- <span class=" bg-primary"></span> --}}
                                      <label for="{{$id_rio}}">{{$_tagArr['label']}}</label>
                                    </fieldset>
                                  </div>
                                @endforeach
                              </div>
                            </div>
                            @break
                        @default
                            @if($tag === 'input')
                              <input class="form-control" {!!$attrString!!} value="{{$value}}" />
                            @elseif($tag === 'select' && !empty($option))
                              <select class="form-control select2" {!!$attrString!!}>
                                @foreach($option as $__k => $___v )
                                  <option value="{{$___v['value']}}" {{$___v['selected']}}>{{$___v['label']}}</option>
                                @endforeach
                              </select>
                            @else
                              <{{$tag}} class="form-control" {!!$attrString!!}>{{$value}}</{{$tag}}>
                            @endif
                      @endswitch
                    </div>
                    @error($_attr)
                      <smal class="has-error-message px-1">{{ $message }}</smal>
                    @enderror
                  </div>
                </div>
              @endforeach
            </div>
            @hasSection('form-actions')
                @yield('form-actions')
            @else
              <div class="form-actions right row">
                <input type="button" class="btn mr-1 btn-outline-dark btn-reload" value="Hủy" >
                <button type="submit" class="btn btn-md mr-1 btn-save " >Lưu</button>
              </div>
            @endif
            
          </div>
        </div>
      </div>
    </form>
  </div>
</div>
@section('scripts')
  <script src="{{asset('bootstrap/admintle/plugins/inputmask/jquery.inputmask.min.js')}}"></script>
  <script src="{{asset('app-assets/vendors/js/forms/icheck/icheck.min.js')}}" type="text/javascript"></script>
  <script src="{{asset('app-assets/js/scripts/forms/checkbox-radio.js')}}" type="text/javascript"></script>
  {{-- <script src="{{asset('app-assets/js/scripts/pickers/dateTime/picker-date-time.js')}}" type="text/javascript"></script> --}}
  <script type="text/javascript">
    $(document).ready(function() {
      @if (session('failed'))
        swalAlert("{!! session('failed') !!}", "error");
      @elseif(session('success'))
          swalConfirm("Cập nhật thành công!",'Bạn có muốn đến trang danh sách ?',function(r){
            if (r) {location.replace('{{$listLink}}')}
          },{
            imageUrl:'/images/site/accepted.png',
            confirmButtonText: "Có",
            cancelButtonText:" Không",
          });
      @endif
      $('.singledate-picker').on('click', function(e){});
      /*mask*/
      const borderInput = $('input[name=phone]').css('border');
      $('input[name=phone]').inputmask("999 999 99999",{
        placeholder:"",})
      .on('blur', function(e){
        let elem = $(this);
        let a = this.value.replace(/\D/g, "").length;
        if (a < 10) {
          this.setCustomValidity(this.title);
          $(this).css('border','2px solid #bfdeff');
        }else{
          this.setCustomValidity('');
          $(this).css('border',borderInput);
        }
      });
      /**/
      $('input[type=file]').on('change', function(evt){
          let input_file = this;
          let max = parseInt($(input_file).attr('max'));
          let maxSize = $(input_file).attr('max-size') != undefined ? $(input_file).attr('max-size') : 2;
              maxSize = Math.max(3, maxSize) * 1024;
          let fileList = this.files;
          let aceptFile = ['xls', 'xlsx'];
          /*check only one file*/
          let ext = getExt(fileList[0].name);
          // if (!aceptFile.includes(ext)) {
          //   toastFlash({icon:'warning',title:"Định dạng file ["+ext+"] không hỗ trợ"});
          //   return false;
          // }
          if (byteToKB(fileList[0].size) >= maxSize) {
            toastFlash({icon:'warning',title:"Dung lượng tệp quá lớn ("+byteToKB(fileList[0].size) +'/'+ maxSize+") KB!"});
            return false;
          }
          if (this.files.length > max) {
            toastFlash({icon:'warning',title:"Chọn quá số tệp !("+max+")"});
            return false;
          }
          // handleFileSelect(evt);
          $('ul.file-description').html('');
          $.each(fileList, function(i,file){
            $('ul.file-description').append($("<li>").text(file.name +' Size: '+ byteToKB(file.size) + ' KB'));
          });
        });
      /*delete*/
      $('.btn-delete-file').on('click', function(e){
        e.preventDefault();
        let this_btn = this;
        let data = $(this_btn).attr('data');
        let url = $(this_btn).attr('href');
        if(data === undefined) {swalAlert('Không xác định đối tượng !', 'error');return false;}
        if(url === '') {swalAlert('Không tìm thấy URL !', 'error');return false;}
        swalConfirm("Xóa " + data,"Bạn đã chắc chắn ?", function(r){
          if (r) {
            $.ajax({
              url: url,
              type:'POST',
              data: {_method:'PUT', _token:'{{csrf_token()}}', 'delete-file':data},
              dataType : "json",
              beforeSend: function(request) {
                request.setRequestHeader("X-CSRF-TOKEN",'{{csrf_token()}}');
              },
              success: function(response) {},
              statusCode: {
                301: function() {
                  let row = $(this_btn).closest('.row').remove();
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
    /*prevent set validation default*/    
    $('input').on('invalid', function (e) {
      e.preventDefault();
      e.target.required = false;
      $(this).closest('form').submit();
    });
    /*set autofocus the first input has error*/
    $('.has-error').first().find('input')[0].select();
  </script>
@endsection
@php
  }catch(\Throwable $e){logger($e);}
@endphp

