@props(['freelancer'])
<x-modal id="modal-contact-{{ $freelancer->id }}" >
<div class="modal-content">
  <x-form class="form"
    enctype="multipart/form-data" method="post">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">×</span>
				</button>
        <h4 class="modal-title">
          <i class='fa fa-road2'></i>{{ Theme::title('send a message')}}
        </h4>
			</div>
		  <div class="modal-body card">
          <div class="form-body row">
            <div class="col-xs-3 text-xs-center">
              <div class="media profil-cover-details">
                  <div class="media-left">
                      @if($freelancer->avatar)
                        <a href="{{ url($freelancer->link->pretty) }}" class="profile-image">
                          <img loading="lazy" class="rounded-circle img-border x100"
                            src="{{ url($freelancer->avatar->src) }}" />
                        </a>
                      @endif
                  </div>
              </div>
                <a href="{{ url($freelancer->link->pretty) }}">
                  <h4 class="card-title mt-2" >
                      {{ $freelancer->name }}
                  </h4>
                </a>
            </div>
            <div class="col-xs-9">
                <div class="form-group">
                    <textarea name="content"
                      placeholder="{{__('something write')}}"
                     rows="8" class="form-control">{{old('content')}}</textarea>
                </div>
            </div>
          </div>
		  </div>
  		<div class="modal-footer">
  				<button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>
  				<button type="button" class="btn btn-outline-primary">{{__('send')}}</button>
  		</div>
    </x-form>
	</div>
</x-modal>
