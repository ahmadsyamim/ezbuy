<div >
    
    {{-- <div>{{($message)}}</div> --}}
    {{-- @if (!empty($message))
    <script>
        $('.mainDimmer').removeClass('active');
    </script>
    @endif --}}
    {{-- @if ($message == 'Success' && $url)
    <script>
        //window.location.href = "{{$url}}";
    </script>
    @endif --}}
    {{-- <button class="btn" wire:click="test">test</button> --}}
    @if ($data) 
        @livewire('show-product', ['data' => $data])
    @else
        <div  class="input-group" style="max-width:400px;">
            <div class="ui action input">
                <input wire:model="search" class="form-control required" type="text" placeholder="Enter your product link"/>
                <button class="ui button btn-add-product @if($loading) loading @endif" wire:click="add">Get Total Price</button>
            </div>
            {{-- <div class="input-group-text"><i class="icon-calculator1"></i></div>
            <input wire:model="search" class="form-control required" type="text" placeholder="Enter your product link"/>
            <button class="btn btn-danger btn-add-product" wire:click="add">Get Total Price</button> --}}
        </div>
    @endif
    <script>
        window.addEventListener('loadUrl', (e) => {
            console.log('loadUrl');
            $('.btn-add-product').addClass('loading');
        });
        window.addEventListener('contentChanged', (e) => {
            console.log('e',e.detail.data);
            if (e.detail.data.title) {
                $('.btn-add-product').removeClass('loading');
            }
            interval = setInterval(function() {
                console.log('interval');
                Livewire.emit('refreshComponent')
            }, 5000);
        });
    </script>
</div>

