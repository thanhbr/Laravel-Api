@extends('layouts.default')
@section('template_title', __('usersmanagement.editing-user', ['name' => $user->name]))
@section('navbar-more')
  <span class=" text-uppercase"> Chỉnh sửa thông tin người dùng</span>
@endsection
<style type="text/css">
  .app-view .container-fluid .card{max-width: 530px;}
  .app-view .container-fluid .card #btn-save,
  .app-view .container-fluid .card #btn-update {min-width: 140px;}
  .app-view .container-fluid .card .nav.nav-tabs.nav-underline .nav-item a.nav-link {color: black; min-width: 100px;}
  .app-view .container-fluid .card .nav.nav-tabs.nav-underline .nav-item a.nav-link.active {color: #2DCEE3;}
  .app-view .container-fluid .card .form-change-pass .form-group >label{ padding: 10px; }
</style>
@section('content')
<div class="app-view">
    @if ($errors->any())
    <div class="alert alert-warning d-non">
      <ul class="m-0">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif
  <div class="container-fluid">
    <div class="row">
      <div class="col-xs-12">
        <div class="card mb-0 mt-1" id="change-info">
          <div class="card-body">
            <div class="card-block p-1">
              <form method="POST" action="{{$user->route('update')}}" class="form-change-pass" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group has-feedback row {{ $errors->has('first_name') ? ' has-error ' : '' }}">
                  {!! Form::label('first_name', trans('forms.create_user_label_firstname'), array('class' => 'col-md-3 control-label')); !!}
                  <div class="col-md-9">
                    <div class="input-group">
                      {!! Form::text('first_name', $user->first_name, array('id' => 'first_name', 'class' => 'form-control', 'placeholder' => trans('forms.create_user_ph_firstname'))) !!}
                      <div class="input-group-append input-group-addon">
                        <label class="input-group-text" for="first_name">
                          <i class="fa fa-fw {{ trans('forms.create_user_icon_firstname') }}" aria-hidden="true"></i>
                        </label>
                      </div>
                    </div>
                    @if($errors->has('first_name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('first_name') }}</strong>
                      </span>
                    @endif
                  </div>
                </div>
                
                <div class="form-group has-feedback row {{ $errors->has('last_name') ? ' has-error ' : '' }}">
                  {!! Form::label('last_name', trans('forms.create_user_label_lastname'), array('class' => 'col-md-3 control-label')); !!}
                  <div class="col-md-9">
                    <div class="input-group">
                      {!! Form::text('last_name', $user->last_name, array('id' => 'last_name', 'class' => 'form-control', 'placeholder' => trans('forms.create_user_ph_lastname'))) !!}
                      <div class="input-group-append input-group-addon">
                        <label class="input-group-text" for="last_name">
                          <i class="fa fa-fw {{ trans('forms.create_user_icon_lastname') }}" aria-hidden="true"></i>
                        </label>
                      </div>
                    </div>
                    @if($errors->has('last_name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('last_name') }}</strong>
                      </span>
                    @endif
                  </div>
                </div>

                <div class="form-group has-feedback row {{ $errors->has('email') ? ' has-error ' : '' }}">
                  {!! Form::label('email', trans('forms.create_user_label_email'), array('class' => 'col-md-3 control-label')); !!}
                  <div class="col-md-9">
                    <div class="input-group">
                      {!! Form::text('email', $user->email, array('id' => 'email', 'class' => 'form-control ', ''=>'', 'placeholder' => trans('forms.create_user_ph_email'))) !!}
                      <div class="input-group-append input-group-addon">
                        <label for="email" class="input-group-text">
                          <i class="fa fa-fw {{ trans('forms.create_user_icon_email') }}" aria-hidden="true"></i>
                        </label>
                      </div>
                    </div>
                    @if ($errors->has('email'))
                      <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                      </span>
                    @endif
                  </div>
                </div>

                {{-- <div class="form-group has-feedback row {{ $errors->has('role') ? ' has-error ' : '' }}">
                  {!! Form::label('role', trans('forms.create_user_label_role'), array('class' => 'col-md-3 control-label')); !!}
                  <div class="col-md-9">
                    <div class="input-group">
                      <select class="custom-select form-control" name="role" id="role">
                        <option value="">{{ trans('forms.create_user_ph_role') }}</option>
                        @if ($roles)
                          @foreach($roles as $role)
                            @if(!Auth::user()->isAdmin() &&  $role->slug === 'admin') @continue @endif
                            <option value="{{ $role->id }}" {{ $currentRole->id == $role->id ? 'selected="selected"' : '' }}>{{ __('site.'.$role->name) }}</option>
                          @endforeach
                        @endif
                      </select>
                      <div class="input-group-append input-group-addon">
                        <label class="input-group-text" for="role">
                          <i class="{{ trans('forms.create_user_icon_role') }}" aria-hidden="true"></i>
                        </label>
                      </div>
                    </div>
                    @if ($errors->has('role'))
                      <span class="help-block">
                        <strong>{{ $errors->first('role') }}</strong>
                      </span>
                    @endif
                  </div>
                </div> --}}

                
                <div class="row">
                  <div class="col-md-3 col-sm-12 mb-2 "></div>
                  <div class="col-md-9 col-sm-12 mx-auto row text-xs-right">
                    <button type="button" id="btn-save" class="btn btn-outline-success">Lưu</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')  
  <script>
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
      /**/
      $('#btn-save, #btn-update').on('click', function(){
        let btn_this = this;
        swalConfirm("Thông tin sẽ được lưu ?","", function(ok){
          if (ok) {
            $(btn_this).closest('form').submit();
          }
        })
      })
      /*active tab*/
        $('#change-info .nav-link').removeClass('active');
        $($('#change-info .nav-link')[{{(int)(old('_tab-active') ?? request()->input('_tab-active') ?? 0)}}]).addClass('active');
        $($('#change-info .tab-pane')[{{(int)(old('_tab-active') ?? request()->input('_tab-active') ?? 0)}}]).addClass('active');
      
    });
  </script>
@endsection