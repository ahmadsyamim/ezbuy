<div class="col-md-5"  style="border: 1px solid rgba(0,0,0,0.075); border-radius: 10px; background-color: #F9F9F9; padding:20px 20px 50px 20px;">
    <div id="job-apply" class="heading-block highlight-me">
        <h2>Inquiry Now</h2>
        <span>And we'll get back to you within a few minutes.</span>
    </div>
    @if (!$data) 
    <p>Paste your product URL below and we will return to you the Total Price.</p>
    @endif
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
            <div class="form-widget">
                <div class="form-result"></div>

                <form id="widget-subscribe-form3" class="row mb-0">

                    <div class="form-process">
                        <div class="css3-spinner">
                            <div class="css3-spinner-scaler"></div>
                        </div>
                    </div>

                    <div class="col-12 form-group">
                        <label for="template-jobform-application">Product URL <small>*</small> :</label>
                        <textarea wire:model="search" name="template-jobform-application" id="template-jobform-application" rows="6" tabindex="11" class="sm-form-control required" placeholder="https://jp.mercari.com/item/m74143617649"></textarea>
                        <span class="text-danger">Currently, Auto Quotation is only working with mercari.jp</span>
                    </div>

                    <div class="col-12 form-group d-none">
                        <input type="text" id="template-jobform-botcheck" name="template-jobform-botcheck" value="" class="sm-form-control" />
                    </div>

                    <div class="col-12 form-group">
                        <button class="ui red button btn-add-product" wire:loading.class="loading" wire:click="add">Quote For Me</button>
                    </div>

                    <input type="hidden" name="prefix" value="template-jobform-">

                </form>
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

    {{-- <div class="input-group" style="max-width:400px;">
        <div class="input-group-text"><i class="icon-calculator1"></i></div>
        <input type="text" name="link" class="form-control required" placeholder="Enter your product link">
        <button class="btn btn-danger" type="submit">Get Total Price</button>
    </div> --}}
    {{-- <form id="widget-subscribe-form3" action="include/subscribe.php" method="post" class="mb-0">
    </form> --}}
</div>