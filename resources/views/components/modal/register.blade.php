<x-modal class="modal-sm" id="modal-register" >
  <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title text-xs-center" >
          <i class="fa fa-envelope-o mr-1"></i> {{ Theme::title('create account with email') }}
        </h4>
      </div>
      <div class="modal-body">

        <div class="card">
          <div class="card-block">
            <div class="card-body">
            <livewire:auth.register />
            </div>
          </div>
        </div>
      </div>
  </div> 
 
</x-modal>
