@props(['product'])
<x-modal id="modal-cart-{{$product->id}}" class="modal-dialog modal-xl" >
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
        <h2 class="modal-title text-bold-600">{{ Theme::title('customize your package') }}</h2>

        </div>
        <div class="modal-body row ">
          <livewire:cart.custom :product="$product" />
        </div>
    </div>
</x-modsl>
