<div >
    <div  class="input-group" style="max-width:400px;">
        <div class="input-group-text"><i class="icon-calculator1"></i></div>
        <input wire:model="search" class="form-control required" type="text" placeholder="Enter your product link"/>
        {{-- <input type="text" name="link" class="form-control required" placeholder="Enter your product link"> --}}
        <button class="btn btn-danger btn-add-product" wire:click="add">Get Total Price</button>
    </div>
    <div>{{($message)}}</div>
    @if (!empty($message))
    <script>
        $('.mainDimmer').removeClass('active');
    </script>
    @endif
</div>

