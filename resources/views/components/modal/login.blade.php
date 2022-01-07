<x-modal class="modal-sm" id="modal-login" >
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">×</span>
      </button>
      <h4 class="modal-title text-xs-center" >
        {{ __('Sign In') }}
      </h4>
    </div>
    <div class="modal-body">

      <div class="card">
        <div class="card-block">
          <div class="card-body">

            <div class="form-group row one">
                  <button type="button" id="btnFacebook" onclick="loginFacebook()"
                  name="login" value="facebook"
                  class="btn btn-facebook block">
                    <i class="fa fa-facebook"></i> <span class="ml-1">
                    {{ __('Continue with Facebook') }} </span>

                    </button>
            </div>

            <div class="form-group row one">
                <button type="button" id="btnGoogle" onclick="loginGoogle()"
                name="login" value="google" class="btn bg-google white  block">
                <i class="fa fa-google-plus"></i><span class="ml-1">
                {{ __('Continue with Google') }}
                </span>
                </button>
            </div>

           
            <div class="form-group row">
              <button type="button" data-backdrop="false" data-toggle="modal" data-target="#modal-login-email" class="btn btn-primary  block">
              <i class="fa fa-envelope-o mr-2"></i> {{ __('Continue with Email') }}
              </button>
            </div>

          </div>
        </div>
      </div>
           
    </div>      
    <div class="modal-footer text-xs-center">
      
        <label class="nav-link success" data-toggle="modal" data-target="#modal-register" >
        <i class="fa fa-envelope-o mr-1"></i> {{ Theme::title('create account with email')}}

        </label>
    </div>
  
    <x-form id="firebase_login" method="post" class="none" action="{{route('firebase.login')}}" >
      <input type="hidden" name="login_by" id="login_by" />
      <input type="hidden" name="name" id="name" />
      <input type="hidden" name="email" id="email" />
      <input type="hidden" name="firebase_uid" id="firebase_uid" />
      <input type="hidden" name="firebase_token" id="firebase_token" />
    </x-form>
  </div> 
</x-modal>
<x-modal.login_email />
