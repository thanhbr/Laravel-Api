@php 
	/**
	* @author toannguyen.dev
	* @todo
	*/
@endphp
{{-- STYLE --}}
<style type="text/css">
  /*swal-upos*/
  .swal-upos{}
  .swal-upos .swal2-title{min-height: 70px; padding-top: 20px}
  .swal-upos .swal2-popup{padding: 0px!important;min-height: 300px; max-width: 400px; border-radius: 15px!important}
  .swal-upos .swal2-actions {border-radius: 0px 0px 15px 15px!important; background-color: #f7f9fc!important;width: 100%}
  /*.swal-upos .swal2-actions:hover{box-shadow: 0 0 0 3px #ff653e;}*/
  .swal-upos .swal2-actions button {
    /*width: 100%;*/
    background-color: unset!important; 
    color: #009da0!important;
    margin: 0px;
    border-radius: unset!important;
  }
  .swal-upos .swal2-actions button:hover {
    background-image: unset!important;
    box-shadow: 0 2px #ff673e inset,0 -0px #f7f9fc inset, -0px 0 #f7f9fc inset, 0px 0 #f7f9fc inset;
  }
  .swal-upos .swal2-actions button:first-child{
    /*border-radius: 0px 0px 0px 25px!important;*/
  }
  .swal-upos .swal2-actions button:last-child{
    /*border-radius: 0px 0px 25px 0px!important;*/
  }
  .swal-upos .swal2-actions button.swal2-styled.swal2-default-outline:focus,
  .swal-upos .swal2-actions button.swal2-styled.swal2-confirm:focus{
    box-shadow: unset;
  }
</style>
{{-- SCRIPT --}}
{{-- sweetalert2 --}}
<script src="{{asset('/bootstrap/admintle/plugins/sweetalert2/sweetalert2@11.js')}}"></script>
{{-- inputmask --}}
<script src="{{asset('bootstrap/admintle/plugins/inputmask/jquery.inputmask.min.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function() {
      $('.select2').select2();
      /**/
      $('.timepicker').each(function(i, ele){
        $(ele).datetimepicker({format: 'YYYY-MM-DD HH:mm:ss'})
      })
      /*select2*/
      $('select[multiple].select2').on('change', function(e){
        let this_select = this;
        let value = $(this_select).val();
        if (value === null || value.length == 0){
          $(this_select).val('').trigger('change.select2');
          return false;
        }
        value = value.filter(function(e) { return e !== ' ' });
        value = value.filter(function(e) { return e !== '' });
        $(this_select).val(value).trigger('change.select2');
      })
    });
    /**/
    $(document).on('change', '#province', function() {
      var province_id = $(this).val();
      $.ajax({
        url: "{{ route('api.get.district') }}",
        type:'GET',
        data: {province_id:province_id},
        success: function(data) {
          $('#district option').remove();
          $('#ward option').remove();
          $("#ward").attr('disabled', true);

          $("#district").attr('disabled', false);
          $('#district').html(data);
          $('#ward').html('<option value="">{{ trans('site.ward') }}</option>');
        }
      });
    });
    /**/
    $(document).on('change', '#district', function() {
      var province_id = $('#province').val();
      var district_id = $(this).val();
      $.ajax({
        url: "{{ route('api.get.ward') }}",
        type:'GET',
        data: {province_id:province_id, district_id:district_id},
        success: function(data) {
          $('#ward option').remove();
          $('#ward').html(data);
          $("#ward").attr('disabled', false);
        }
      });
    });
    /**/
    
    $('#btn-clear-form').on('click', function(e){
      let this_btn = this;
      swalConfirm("Hủy thêm mới","Bạn có muốn dừng thêm mới không ?", function(r){
        if (r) {
          $(this_btn).closest('form').find('input, textarea').not('input[type=hidden]').val("").trigger("change");
          console.log($(this_btn).closest('form').find('select'));
          $(this_btn).closest('form').find('select').val('').trigger("change");
        }
      },{
        confirmButtonText: "Đồng ý",
        cancelButtonText:"Đóng",
        icon:"warning",
      });
    })
    $('.btn-reload').on('click', function(e){
      let this_btn = this;
      swalConfirm("Hủy thay đổi ?","", function(r){
        if (r) {
          window.location.reload()
        }
      },{
        confirmButtonText: "Đồng ý",
        cancelButtonText:"Đóng",
        icon:"warning",
      });
    })
    /*dowload excel from export*/
    $('.btn-export-excel').on('click', function (e) {
      e.preventDefault();
      let url = $(this).attr('href') + window.location.search;
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4) {
          switch(this.status){
              case 200:case 201: case 201: case 301:
                let reader = new FileReader();
                reader.readAsDataURL(this.response);
                reader.onload = function (e) {
                  var a =  document.createElement ("a");
                  // a.download = name + ".xlsx";//custome name
                  a.href = e.target.result;
                  a.click();
                };
                break;
              case 204: case 302:
                  Swal.fire({
                      text: 'Not found data',
                      html: this.responseText
                  })
                  break;
              default: break;
          }
        }
      };
      xmlhttp.open("GET", url, true);
      xmlhttp.responseType = 'blob';
      xmlhttp.send();
    })
    /**/
    function toastFlash(_config = {}, _option = {}) {
      let Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
          toast.addEventListener('mouseenter', Swal.stopTimer)
          toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
      })
      _config.icon = _config.icon == undefined ? 'success' : _config.icon;
      _config.title = _config.title == undefined ? 'Thành công' : _config.title;
      // _config.imageUrl = imageUrl;
      _config.imageWidth = 45;
      _config.imageHeight = 45;
      if (_config.imageUrl != undefined) {_config.icon = '';}
      Toast.fire(_config)
    }
    /**/
    function swalConfirm(title, message = ' ', callback, _config = {}) {
      let imageUrl = '/images/site/warning.png';
      if (_config.imageUrl != undefined) {imageUrl = _config.imageUrl};
      if(_config.confirmButtonText != undefined) _config.confirmButtonText = "Đồng ý";
      if(_config.cancelButtonText != undefined) _config.cancelButtonText = 'Đóng';
      // _config.icon = '';
      _config.title = title;
      _config.text = message == "" ? ' ' : message;
      _config.showDenyButton = false;
      _config.showCancelButton = true;
      _config.confirmButtonColor ="#1175ab";
      _config.reverseButtons = true;
      _config.denyButtonText = "Don't save";
      _config.imageUrl = imageUrl;
      _config.imageWidth = 90;
      _config.imageHeight = 90;
      _config.customClass = {
        container:'swal-upos',
        actions: 'row',
        confirmButton:'col-xs-6',
        cancelButton:'col-xs-6 text-dark'
      };
      if (_config.icon != undefined) { _config.imageUrl = '';}
      Swal.fire(
      _config
      ).then((result) => {
          callback(result.value ? true : false);
      });
      $(document).on('keyup', function (e) {
        if (e.keyCode == 27) Swal.close();
      })
    }
    /*include swealert2*/
    function swalProgress(time_miliseconds = 30000) {
        let timerInterval;
        const progressbar = Swal.mixin({
          toast: true,
        }).fire({
          // title: '..',
          html: 'Đang xử lý. Tự đóng sau: <b class="milis">'+time_miliseconds/1000+'</b>',
          timer: time_miliseconds,
          timerProgressBar: true,
          showConfirmButton: false,
          confirmButtonText:'Ẩn',
          showClass: {
            popup: 'animate__animated animate__fadeInDown'
          },
          hideClass: {
            popup: 'animate__animated animate__fadeOutUp'
          },
          position: 'bottom-end',
          willOpen: () => {
            Swal.showLoading()
            timerInterval = setInterval(() => { 
                const content = Swal.getHtmlContainer();
                if (content) {
                    const b = content.querySelector('b.milis')
                    if (b) {
                        let milis = Swal.getTimerLeft();
                        if (isNaN(milis)) {
                          b.textContent = '...';
                        } else {
                          b.textContent = parseInt(milis/1000) + ' s';
                        }
                    }
                }
            }, 100)
          },
          willClose: () => {
            clearInterval(timerInterval)
          }
        }).then((result) => {
          /* Read more about handling dismissals below */
          if (result.dismiss === Swal.DismissReason.timer) {}
        });
        return progressbar;
    }
    /**/
    function swalAlert(_title = 'Successfully', _type = 'success', _config = {}) {
      let imageUrl = '/images/site/accepted.png';
      if(_type == 'error') imageUrl = '/images/site/denied.png';
      else if(_type == 'warning') imageUrl = '/images/site/warning.png';
      if (_config.imageUrl != undefined) {imageUrl = _config.imageUrl};
      _config.title = _title;
      _config.customClass = {
        container:'swal-alert-2 swal-upos',
        confirmButton:'col-12 col-xs-12',
      };
      _config.imageUrl = imageUrl;
      _config.imageWidth = 90;
      _config.imageHeight = 90;
      if (_config.icon !== undefined) { _config.imageUrl = '';}
      Swal.fire(_config);
    }
    /*copy table*/
    function copytable(el) {
        let urlField = document.getElementById(el);
        let range = document.createRange();
        range.selectNode(urlField);
        window.getSelection().addRange(range);
        document.execCommand('copy');
    }
    /*taphandle:: double tap*/
    var tapedTwice = false;
    function tapHandler(event) {
      if(!tapedTwice) {
          tapedTwice = true;
          setTimeout( function() { tapedTwice = false; }, 300 );
          return false;
      }
      event.preventDefault();
      //action on double tap goes below
      tapedTwice = false;
      return true;
    }
    /**/
    function showResponse(reponse){
      @if (env('APP_ENV')!='Production')
        if ($('#modal-default') == undefined) return false;
        $('#modal-default').find('.modal-body').html(reponse.responseText);
        $('#modal-default').modal();
        Swal.close();
      @endif
    }
    /*file*/
    function getExt(filename){
        var ext = filename.split('.').pop();
        if(ext == filename) return "";
        return ext;
      }
      function byteToMB(byte){
        return Math.round(byte/ (1024 *1024));
      }
      function byteToKB(byte){return Math.round(byte/(1024));}
</script>