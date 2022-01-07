@php
  /**
  * @todo
  */
  $pageTitle = $pageTitle ?? 'Chi tiết khách hàng';
  $classSplitCol = ' col-md-'.(12 / 1);
  $addLink = $addLink ?? '';
  $editLink = $editLink ?? '';
  $addLogLink = $addLogLink ?? '';
@endphp
@section('navbar-more')
  <div class="text-uppercase" >{{$pageTitle}}</div>
@endsection
  <style type="text/css">
    .app-view .content-customer .detail-body .row{
      padding: .5rem
    }
    /* .app-view .content-show .mx-1{margin: 0px .2rem}
    .app-view .f700{font-weight: 700; font-size: 14pt}
    .app-view .form-control:disabled, .app-view .form-control[readonly] {
      background-color: #ffffff;
      border: none;
    }
    .app-view .select2-container--default.select2-container--disabled .select2-selection--single {
      background-color: #fff;
      border: none;
      cursor: default;
    }
    .app-view .select2-container .select2-selection__arrow {display: none}
    .app-view .show-detail .as-row {padding: 0px 16px}
    .app-view .show-detail .control-label{font-weight: 400;color: #7D9AC0;font-size: 14px} */
    /*timle*/
    #timeline .timeline-line {border:1px solid #B5CBE8; width: 2px; margin: 4px 20px -4px 20px;}
    #timeline .timeline-item{position: absolute; margin: 0px 15px}
    #timeline .time-group{padding: 0px 1rem; margin-bottom: .5rem}
    #timeline .point {display: flex;}
    #timeline .point .item-title{font-weight: 700; font-size: 14px}
    /*#timeline .point .timeline-badge .badge-icon{background-color:#B5CBE8; color: #fff }*/
    #timeline .item-content{font-weight: 400; font-size: 14px}
    #timeline .item-time{font-weight: 400; font-size: 12px;color: #7D9AC0}
    #timeline .timeline-badge {right: -15px;top: 0px;}
    #timeline .timeline-badge {
        position: absolute;
        /*top: 12px;*/
        z-index: 1;
    }
    #timeline .timeline-badge > span {
      display: inline-block;
      width: 18px;
      height: 18px;
      border-radius: 50%;
      text-align: center;
      text-decoration: none;
      transition: all ease .3s;
      /*background-color: #B5CBE8;*/
      color: white;
    }
  </style>
<div class="app-view">
  <div class="row px-2">
    <div class="col-12 col-md-7 px-0 content-customer">
      <div class="bg-white p-1">
        <div class="detail-head">
          <div class="row">
            <div class="col-sm-6 " style="padding: .25rem 0px"><span class="p-1 h3 f700 text-uppercase">Thông tin cửa hàng</span></div>
            <div class="px-1 float-right float-xs-right"><a href="{{$customer->route('edit')}}" class="btn btn-edit"><i class="fa fa-pencil pr-1"></i>Chỉnh sửa</a></div>
          </div>
        </div>
        <div class="detail-body">
          <div class="row">
            <div class="col-sm-12 col-md-4">Mã khách hàng:</div><div class="col-sm-12 col-md-8">123</div>
          </div>
          <div class="row">
            <div class="col-sm-12 col-md-4">Khách Hàng:</div><div class="col-sm-12 col-md-8">123</div>
          </div>
          <div class="row">
            <div class="col-sm-12 col-md-4">Tên Cửa Hàng:</div><div class="col-sm-12 col-md-8">ád</div>
          </div>
          <div class="row">
            <div class="col-sm-12 col-md-4">Điện Thoại:</div><div class="col-sm-12 col-md-8"></div>
          </div>
          <div class="row">
            <div class="col-sm-12 col-md-4">Hộp Thư Điện Tử:</div><div class="col-sm-12 col-md-8"></div>
          </div>
          <div class="row">
            <div class="col-sm-12 col-md-4">Địa Chỉ:</div><div class="col-sm-12 col-md-8"></div>
          </div>
          <div class="row">
            <div class="col-sm-12 col-md-4">Khu Vực:</div><div class="col-sm-12 col-md-8"></div>
          </div>
          <div class="row">
            <div class="col-sm-12 col-md-4">Tỉnh/TP:</div><div class="col-sm-12 col-md-8"></div>
          </div>
          <div class="row">
            <div class="col-sm-12 col-md-4">Quận/Huyện/Thị Xã:</div><div class="col-sm-12 col-md-8"></div>
          </div>
          <div class="row">
            <div class="col-sm-12 col-md-4">Xã/Phường/Thị Trấn:</div><div class="col-sm-12 col-md-8"></div>
          </div>
          <div class="row">
            <div class="col-sm-12 col-md-4">Đơn Vị Vận Chuyển:</div><div class="col-sm-12 col-md-8"></div>
          </div>
          <div class="row">
            <div class="col-sm-12 col-md-4">Nguồn Khách Hàng:</div><div class="col-sm-12 col-md-8"></div>
          </div>
          <div class="row">
            <div class="col-sm-12 col-md-4">Lĩnh Vực Kinh Doanh:</div><div class="col-sm-12 col-md-8"></div>
          </div>
          <div class="row">
            <div class="col-sm-12 col-md-4">Nhân Viên Phụ Trách:</div><div class="col-sm-12 col-md-8"></div>
          </div>
          <div class="row">
            <div class="col-sm-12 col-md-4">Ngày Đăng Kí:</div><div class="col-sm-12 col-md-8"></div>
          </div>
          <div class="row">
            <div class="col-sm-12 col-md-4">Trạng Thái Khách Hàng:</div><div class="col-sm-12 col-md-8"></div>
          </div>
          <div class="row">
            <div class="col-sm-12 col-md-4">Chi Chú:</div><div class="col-sm-12 col-md-8"></div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-12 col-md-5 content-log">
      <div class="bg-white">
        <div class="row p-1">
          <div class="col-sm-7 " style="padding: .25rem 0px">
            <span class="p-1 h3 f700 text-uppercase">Các hoạt động</span>
          </div>
          <div class="px-1 float-right float-xs-right">
            <div href="{{$addLogLink}}" class="btn-utmddf touch-once btn btn-add"><i class="fa fa-plus pr-1"></i>Thêm mới</div>
          </div>
        </div>
        <div id="timeline" class="timeline">
          @php
            $time_label = '';
            $history = $history ?? [];
          @endphp
          @foreach($history as $_index => $log)
            @php
              $log_id = $log['id'] ?? '';
              $created_at = $log['created_at'] ?? null;
              $created_at_string = date_create($created_at)->format('d-M-Y');
              // $created_at_time = date_create($created_at)->format('H:i');
              $created_at_time = date('H:i', strtotime((string)$created_at));
              $time_label_print = false;
              if (date_create($created_at) && $time_label !== $created_at_string) {
                $time_label_print = true;
              }
              $time_label = $created_at_string;
              $user_id = $log['user_code'] ?? '';
              $staff_name = $log['staff_name'] ?? '';
              $staff_code = empty($user_id) ? '' : " ($user_id)";

              $action = (string)($log['log_type'] ?? '');
              $action_strip = str_replace('_', '-', $action);
              $action_trans = trans('site.'.$action);
              $log_title = $log['title'] ?? '';
              $content = $log['content'] ?? '';
              $content = is_array($content) ? '' : $content;
              $method = $log['method'] ?? '';
              $method = str_replace('site.','', __('site.'.$method));
              $detailLogLink = url('/customer_logs/'.$log_id.'?split-col=1');
              $log_type_icon = $log['log_type_icon'] ?? '';
              $log_type_icon = empty($log_type_icon) ? '<i class="fa fa-sticky-note"></i>' : $log_type_icon;
            @endphp
            <div class="">
              @if($time_label_print)
              <div class="row time-group" style="padding:1.2rem 2rem .4rem 2rem;">
                <span class="" style="font-weight:bold;font-size: 18px;">
                  {{$viewModel->getWeekDay($created_at,'full')}}
                </span>
                <span style="font-weight:400;font-size: 14px; color: #223E62;">
                  {{$time_label}}
                </span>
              </div>
              @endif
              <div class="row px-2 point">
                <div class="timeline-line" style=""></div>
                  <div class="timeline-item" style="">
                    <div class="timeline-badge">
                      <span class="badge-icon bg-lighten-1" data-toggle="tooltip" data-placement="right" title="" data-original-title="">
                        @if($_index == 0)
                          <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect width="18" height="18" rx="9" fill="#3CD6B7"/>
                            <path d="M12.75 6.75L7.59375 11.9062L5.25 9.5625" stroke="white" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                          </svg>
                        @else
                          <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect width="14" height="14" rx="7" fill="#B5CBE8"/>
                            <path d="M9.91732 5.25L5.9069 9.26042L4.08398 7.4375" stroke="white" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                          </svg>
                        @endif
                      </span>
                    </div>
                  </div>
                <div class="col-xs-12 px-0 pr-2">
                  <div class="col-12 col-md-8 px-0">
                    <div class="item-title">{{$log_title}}</div>
                    <div class="item-content">
                      @switch(true)
                        @case(!!preg_match('/^(add_contactlog)$/', $action))
                          {{-- <a class="btn-utmddf disabled" href="{{$detailLogLink}}"> --}}
                            <div class="text-primary" >{{($method)}}</div>
                            <div class="b" >{{($content)}}</div>
                          {{-- </a> --}}
                          @break;
                        @default
                          <div class="">
                            <span class="b" >{{($content)}}</span>
                          </div>
                        @endswitch
                    </div>
                    <div class="item-time">Thời gian {{$created_at_time}}</div>
                  </div>
                  <div class="col-12 col-md-4 px-0" style="float: right">
                    <span title="{{$staff_code}}">{{$staff_name}}{{$staff_code}}</span>
                  </div>
                </div>
              </div>
            </div>
          @endforeach
          <div>
            <i class="fa fa-clock bg-gray"></i>
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
