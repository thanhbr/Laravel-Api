@extends('layouts.default')
@section('template_title', trans('usersmanagement.showing-user', ['name' => $user->name]))
<style type="text/css">
  .nav-link {padding: .9rem .6rem !important;}
  .app-view-show .container-fluid .row .col {border-radius: 15px!important;}
  .app-view-show .container-fluid >.row .card {border: 2px solid #F2F6FF; border-radius: 6px;}
  .app-view-show .card .list-group .list-group-item {border-left: 0px;border-right: 0px; border-radius: 0px;}
</style>
@section('navbar-more')
  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="">
  <path d="M12 11C14.2091 11 16 9.20914 16 7C16 4.79086 14.2091 3 12 3C9.79086 3 8 4.79086 8 7C8 9.20914 9.79086 11 12 11Z" stroke="#223E62" stroke-linecap="round" stroke-linejoin="round"/>
  <path d="M16.0319 21.1421C17.4199 20.8922 18.5204 20.5115 19.0319 19.9999C19.1038 19.353 19.0319 18.3332 19.0319 18.3332C19.0319 17.4492 18.6105 16.6013 17.8604 15.9762C15.4914 14.0021 7.57247 14.0021 5.20352 15.9762C4.45337 16.6013 4.03195 17.4492 4.03195 18.3332C4.03195 18.3332 3.96007 19.353 4.03195 19.9999C4.54351 20.5115 5.64392 20.8922 7.03194 21.1421" stroke="#223E62" stroke-linecap="round" stroke-linejoin="round"/>
  </svg>
  <h4 class="text-uppercase d-inline">HỒ SƠ CỦA BẠN</h4>
@endsection
@section('content')
  <div class="app-view app-view-show">
    <div class="app-view-title row">
      <div class="col-12col-md-6 float-xs-left">
        <span class="h4 text-uppercase">
        </span>
      </div>
      <div class="col-xs float-xs-right"></div>
    </div>
    <div class="container-fluid">
      <div class="row" style="background-color:#f2f6ff;">
        <div class="col px-1 p-0 col-sm-12 " style="max-width: 768px;">
          <div class="card">
            <div class="text-xs-center">
                <div class="card-block">
                    <img src="/images/avatars/avatar_default.png" class="rounded-circle  height-150" alt="Card image">
                </div>
                <div class="card-block">
                    <h4 class="card-title">{{$user->name ??''}}</h4>
                    <h6 class="card-subtitle text-muted"></h6>
                </div>
                <div class="text-xs-center">
                    <a href="#" class="btn btn-social-icon mr-1 mb-1 btn-outline-facebook"><span class="fa fa-facebook"></span></a>
                    <a href="#" class="btn btn-social-icon mr-1 mb-1 btn-outline-twitter"><span class="fa fa-twitter"></span></a>
                    <a href="#" class="btn btn-social-icon mb-1 btn-outline-linkedin"><span class="fa fa-linkedin font-medium-4"></span></a>
                </div>
            </div>
            <div class="list-group">
                {{-- <a href="#" class="list-group-item"><i class="fa fa-briefcase"></i><span class="pl-1"></span></a> --}}
                <a href="mailto:{{$user->email ?? ''}}" class="list-group-item"><i class="ft-mail"></i><span class="pl-1">{{$user->email ?? ''}}</span></a>
                <a href="#" class="list-group-item">
                  <i class="ft-check-square"></i><span class="pl-1">Vai trò</span>
                  <div class="pl-1">
                    <table class="pl-1">
                      @foreach($user->roles as $_index => $role)
                        <tr>
                          <td><span class="pl-1 text-uppercase btn- btn-outline-info">{{$role->name}}</span></td>
                          <td><span class="px-1">{{$role->description ?? ''}}</span></td>
                        </tr>
                      @endforeach
                    </table>
                  </div>
                </a>
                <a href="#" class="list-group-item"> <i class="ft-comment-square"></i> ...</a>
            </div>
            <div class="text-xs-right m-1">
              <a class="btn btn-outline-warning" href="{{$user->route('edit')}}"><i class="fa fa-edit"></i><span class="px-1">Chỉnh sửa</span></a>              
            </div>
          </div>
        </div>
        <div class="col px-1 p-0 col-sm-12 col-md-8">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <img src="">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
