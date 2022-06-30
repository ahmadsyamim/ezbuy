{{-- <button wire:click="$emit('refreshComponent')"> --}}

<div class="row pricing col-mb-30 mb-4 d-flex justify-content-center">
    <div class="col-md-6 col-lg-4">
        <div class="pricing-box pricing-simple px-5 py-4 bg-light text-center text-md-start">
            @if (!$data->title)
                @push('scripts')
                <script>
                    console.log('sc');
                    $(document).ready(function() {
                        interval = setInterval(function() {
                            console.log('interval');
                            Livewire.emit('refreshComponent')
                        }, 5000);
                    });
                </script>
                @endpush
                <div class="pricing-title">
                    <div class="ui active inverted dimmer">
                        <div class="ui text loader">Loading</div>
                    </div>
                </div>
            @else
                @push('scripts')
                <script>
                    $(document).ready(function() {
                        if (typeof interval !== 'undefined') {
                            clearInterval(interval);
                        }
                    });
                </script>
                @endpush
                <div class="pricing-title">
                    {{-- <span class="text-danger">Most Popular</span> --}}
                    <h3>{{$data->title}}</h3>
                    @if ($data->image)
                    <img src="{{$data->image}}" class="img-thumbnail">
                    @endif
                </div>
                <div class="pricing-price">
                    {{-- <span class="price-unit">€</span> --}}
                    {{$data->sellprice}}
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
                    <a href="#" class="btn btn-danger btn-lg">Get Started</a>
                </div>
                @else
                <div class="pricing-action d-flex justify-content-center"">
                <a href="{{route('login')}}" class="btn btn-danger btn-lg">Login</a>
                </div>
                <div class="pricing-action d-flex justify-content-center"">
                <a href="{{route('register')}}" class="btn btn-danger btn-lg">Register</a>
                </div>
                @endauth
            @endif
        </div>
    </div>
</div>