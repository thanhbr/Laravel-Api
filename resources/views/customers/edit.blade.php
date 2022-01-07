@php
  // $storeLink  = $storeLink ?? '#';
  $customer = $customer ?? null;
@endphp
<style type="text/css">
  .app-view .card .card-footer .btn {min-width: 120px;}
</style>
@section('navbar-more')  
  <div class=" text-uppercase">THÊM THÔNG TIN KHÁCH HÀNG</div>
@endsection
<div class="app-view">
  <div class="app-view-top">
  </div>
  <div class="container-fluid">
    @include('components.show-validation')
    <form class="form" action="{{$storeLink}}" id="frm_create" enctype="multipart/form-data" method="POST">
      @csrf
      @method('PUT')
      <div class="row">
        <div class="col-xl-7 col-md-8 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-block">
                      <div class="row">
                        <div class="col-xl-8 col-lg-8 col-sm-12 mb-1">
                          @php
                            $class_fieldset = '';
                            $class_NameTag = '';
                              if ($errors->has('name')) {
                                $class_fieldset = ' has-warning';
                                $class_NameTag = ' form-control-warning';
                              }elseif (old('name')) {
                                $class_fieldset = ' has-success';
                                $class_NameTag = ' form-control-success';
                              }
                            @endphp
                          <fieldset class="form-group mb-0 {{$class_fieldset}}">
                            <label for="">Label:</label>
                            <input type="text" name="name" class="form-control {{$class_NameTag}}" placeholder="Name" value="{{old('name') ?? $customer->name ?? ''}}">
                              <p class="has-error-message">
                                @foreach ($errors->get('name') as $message)
                                  <small>{{$message}} </small><br>
                                @endforeach
                              </p>
                          </fieldset>
                        </div>
                      </div>
                    </div>
                </div>
                <div class="card-footer">
                  <div>
                    <input type="button" class="btn mr-1 btn-outline-dark btn-reload" value="Hủy" >
                    <button type="submit" class="btn btn-warning btn-save"> {{__('app.update')}}</button>
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
  <script>
    $(document).ready(function() {
        @if (session('failed'))
          swalAlert("{!! session('failed') !!}", "error");
        @elseif(session('success'))
          let title ="{{session('success')}}", text = '{{session('text')}}';
          if(text === '' || text == undefined){
            text = "Bạn có muốn đến trang danh sách ?";
          }
          swalConfirm(title, text, function(r){
            if (r) {location.replace('{{$customer->route('index')}}')}
          },{
            imageUrl:'/images/site/accepted.png',
            confirmButtonText: "Có",
            cancelButtonText:" Không",
          });
        @endif
    })
</script>
@endsection