
{{-- <button wire:click="$emit('refreshComponent')"> --}}
@push('scripts')
<script>
    document.addEventListener('livewire:load', function () {
        // Get the value of the "count" property
        var data = @this.data
 
        // Set the value of the "count" property
        //@this.count = 5
 
        // Call the increment component action
        //@this.increment()
 
        // Run a callback when an event ("foo") is emitted from this component
        //@this.on('foo', () => {})
        console.log('data',data)
    })
    document.addEventListener("DOMContentLoaded", () => {
        Livewire.hook('component.initialized', (component) => {
            console.log('component.initialized');
        })
        Livewire.hook('element.initialized', (el, component) => {
            console.log('element.initialized');
        })
        Livewire.hook('element.updating', (fromEl, toEl, component) => {
            console.log('element.updating');
        })
        Livewire.hook('element.updated', (el, component) => {
            console.log('element.updated');
        })
        Livewire.hook('element.removed', (el, component) => {
            console.log('element.removed');
        })
        Livewire.hook('message.sent', (message, component) => {
            console.log('message.sent');
        })
        Livewire.hook('message.failed', (message, component) => {
            console.log('message.failed');
        })
        Livewire.hook('message.received', (message, component) => {
            console.log('message.received');
        })
        Livewire.hook('message.processed', (message, component) => {
            console.log('message.processed');
            var data = @this.data
            console.log('data',data);
        })
    });
</script>
@endpush


@if (!$data->title)

<div class="pricing-title">
    <div class="ui active inverted dimmer">
        <div class="ui text loader">Loading</div>
    </div>
</div>

@else

<div class="form-widget">
    <div class="form-result"></div>

        <div class="form-process">
            <div class="css3-spinner">
                <div class="css3-spinner-scaler"></div>
            </div>
        </div>

        <div class="col-md-6 form-group">
            <div class="product-image">
                @if ($data->image)
                <a href="{{$data->image}}"><img src="{{$data->image}}" style="max-height:152px; object-fit:contain;" alt=""></a>
                @endif
            </div>
        </div>

        @if($data->status != '4')
        <div class="col-md-6 form-group">
            <div style="padding: 2rem 0;">
                <ul class="iconlist" style="justify-content: center; display: grid;">
                    <li><i class="icon-line-box"></i> <strong>MYR</strong> &nbsp;{{$data->sellprice * config('app.rate') }}</li>
                    <li><i class="icon-shipping-fast"></i> <strong>MYR</strong> &nbsp;{{!empty($data->shippingfee) ? $data->shippingfee : '??' }}</li>
                    <li><i class="icon-coffee1"></i> <strong>MYR</strong> &nbsp;{{!empty($data->shippingfee) ? $data->servicefee : '??' }}</li>
                </ul>
            </div>
        </div>
        @endif

        <div class="w-100"></div>

        @if(!empty($data->shippingfee))
        <div class="col-12 form-group">
            <label for="template-jobform-email">Total <small>(All Included)</small></label>
            <h2>MYR &nbsp;{{ ($data->sellprice * config('app.rate')) + $data->shippingfee + $data->servicefee }}</h2>
        </div>
        @endif

        @if(!empty($data->shippingfee))
            @auth
            <div class="col-12 form-group">
                <button class="ui blue button btn-add-product" wire:click="createbill" wire:loading.class="loading">Buy for me</button>
            </div>
            @else
            <p>Please <a href="{{route('login', ['intended' => route('ezbuy.item', ['id' => $data->id]) ])}}">Login</a>/<a href="{{route('register')}}">Register</a> to buy.</p>
            @endauth
        @elseif($data->status == '4')
            <h2 class="text-danger">Item Sold Out.</h2>
        @else
            <p>Item Category is untraceable.
                @guest
                <br>Please <a href="{{route('login', ['intended' => route('ezbuy.item', ['id' => $data->id]) ])}}">Login</a> to log this inquiry.
                @endguest
                <br>Our Team will return to you the price immediately.
            </p>
        @endif
</div>

@endif