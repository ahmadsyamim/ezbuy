@include('Bulma.partials.meta')
@include('Bulma.partials.header')

<div class="container">
  <div class="block">
    @yield('content')
  </div>
</div>


{{-- <main class="main-content">
    @yield('content')
</main> --}}

@include('Bulma.partials.footer')
