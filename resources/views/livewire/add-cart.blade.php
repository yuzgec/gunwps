<div>
    <form wire:submit.prevent="add">
        @csrf
        <button type="submit" class="btn btn-rounded btn-outline btn-with-arrow btn-light mb-1">
            Add {{ (cartControl($product->id) == true) ? '('.cartControl($product->id).')' : null }} <br>
            <span><i class="fas fa-chevron-right"></i></span>
        </button>
    </form>
</div>
