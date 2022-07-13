<div>
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
<div class="row pricing col-mb-30 mb-4 d-flex justify-content-center">
    <div class="col-md-12 col-lg-12">
        <div class="pricing-box pricing-simple px-5 py-4 bg-light text-center text-md-start">
            @if (!$data->title)
                <div class="pricing-title">
                    <div class="ui active inverted dimmer">
                        <div class="ui text loader">Loading</div>
                    </div>
                </div>
            @else
                <div class="pricing-title">
                    {{-- <span class="text-danger">Most Popular</span> --}}
                    <h3>{{$data->title}}</h3>
                    @if ($data->image)
                    <img class="ui small image" src="{{$data->image}}">
                    @endif
                </div>
                <div class="pricing-price">
                    {{-- <span class="price-unit">€</span> --}}
                    {{money($data->sellprice, 'MYR')}}
                </div>
                <div class="pricing-features">
                    <ul class="iconlist">
                        {{-- <li><i class="icon-check text-smaller"></i> <strong>Premium</strong> Plugins</li> --}}
                        {{-- <li><i class="icon-check text-smaller"></i> <strong>SEO</strong> Features</li> --}}
                        <li><i class="icon-check text-smaller"></i> <strong>Full</strong> Access</li>
                        {{-- <li><i class="icon-check text-smaller"></i> <strong>100</strong> User Accounts</li> --}}
                        {{-- <li><i class="icon-check text-smaller"></i> <strong>1 Year</strong> License</li> --}}
                        {{-- <li><i class="icon-check text-smaller"></i> <strong>24/7</strong> Support</li> --}}
                    </ul>
                </div>
                @auth
                <div class="pricing-action d-flex justify-content-center"">
                    <div wire:click="createbill" wire:loading.class="loading" class="ui red button large">pay Here</div>
                </div>
                @else
                <div class="pricing-action d-flex justify-content-center"">
                <a href="{{route('login', ['intended' => route('ezbuy.item', ['id' => $data->id]) ])}}" class="btn btn-danger btn-lg">Login</a>
                </div>
                <div class="pricing-action d-flex justify-content-center"">
                <a href="{{route('register')}}" class="btn btn-danger btn-lg">Register</a>
                </div>
                @endauth
            @endif
        </div>
    </div>
</div>
</div>