<!-- Document Wrapper
	============================================= -->
	<div id="wrapper" class="clearfix">

		<!-- Top Bar
		============================================= -->
		<div id="top-bar">
			<div class="container">

				<div class="row justify-content-between align-items-center">
					<div class="col-12 col-md-auto">
						<p class="mb-0 py-2 text-center text-md-start"><strong>Call:</strong> {{setting('site.phone_number')}} | <strong>Email:</strong> {{setting('site.email')}}</p>
					</div>

					<div class="col-12 col-md-auto">

						<!-- Top Links
						============================================= -->
						<div class="top-links on-click">
							<ul class="top-links-container">
								{{--<li class="top-links-item"><a href="#">MYR</a>
									 <ul class="top-links-sub-menu">
										<li class="top-links-item"><a href="#">EUR</a></li>
										<li class="top-links-item"><a href="#">AUD</a></li>
										<li class="top-links-item"><a href="#">GBP</a></li>
									</ul> 
								</li>--}}
								{{--<li class="top-links-item"><a href="#">EN</a>
									<ul class="top-links-sub-menu">
										<li class="top-links-item"><a href="#"><img src="images/icons/flags/french.png" alt="French"> FR</a></li>
										<li class="top-links-item"><a href="#"><img src="images/icons/flags/italian.png" alt="Italian"> IT</a></li>
										<li class="top-links-item"><a href="#"><img src="images/icons/flags/german.png" alt="German"> DE</a></li>
									</ul> 
								</li>--}}
								@if (Auth::guest())
								<!-- <li class="top-links-item"><a href="{{ route('login') }}">Login</a></li>
								<li class="top-links-item"><a href="{{ route('register') }}">Register</a></li> -->
								@else
									<!-- <li class="top-links-item">
										<a href="{{ route('voyager-frontend.account') }}">Update Account</a>
									</li> -->
									<li class="top-links-item">
										@if (Session::has('original_user.id'))
											<a href="#"
											onclick="document.getElementById('impersonate-form').submit();return false;">
												Switch back to {{ Session::get('original_user.name') }}
											</a>
											<form id="impersonate-form"
												action="{{ route('voyager-frontend.account.impersonate', Session::get('original_user.id')) }}"
												method="POST"
												style="display: none;">
												@csrf
											</form>
										@else
											<!-- <a href="#" onclick="document.getElementById('logout-form').submit();return false;">
												Logout
											</a>
											<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
												@csrf
											</form> -->
										@endif
									</li>
								@endif
								{{-- <li class="top-links-item"><a href="#">Login</a>
									<div class="top-links-section">
										<form id="top-login" autocomplete="off">
											<div class="form-group">
												<label>Username</label>
												<input type="email" class="form-control" placeholder="Email address">
											</div>
											<div class="form-group">
												<label>Password</label>
												<input type="password" class="form-control" placeholder="Password" required="">
											</div>
											<div class="form-group form-check">
												<input class="form-check-input" type="checkbox" value="" id="top-login-checkbox">
												<label class="form-check-label" for="top-login-checkbox">Remember Me</label>
											</div>
											<button class="btn btn-danger w-100" type="submit">Sign in</button>
										</form>
									</div>
								</li> --}}
							</ul>
						</div><!-- .top-links end -->

					</div>
				</div>

			</div>
		</div><!-- #top-bar end -->

		<!-- Header
		============================================= -->
		<header id="header">
			<div id="header-wrap">
				<div class="container">
					<div class="header-row">

						<!-- Logo
						============================================= -->
						<div id="logo">
							<a href="{{url('/')}}" class="standard-logo" data-dark-logo="{{url("images/logo-dark.png")}}"><img src="{{url("images/logo.png")}}" alt="Canvas Logo"></a>
							<a href="{{url('/')}}" class="retina-logo" data-dark-logo="{{url("images/logo-dark@2x.png")}}"><img src="{{url("images/logo@2x.png")}}" alt="Canvas Logo"></a>
						</div><!-- #logo end -->

						<div class="header-misc">

							<!-- Top Search
							============================================= -->
							<div id="top-search" class="header-misc-icon">
								@if (Auth::guest())
								<a href="{{ url('/login') }}"><i class="icon-user-circle"></i><i class="icon-line-cross"></i></a>
								<!-- <a href="{{ url('/login') }}" id="top-search-trigger"><i class="icon-user-circle"></i><i class="icon-line-cross"></i></a> -->
								@else
								<a onclick="document.getElementById('logout-form').submit();return false;"><i class="icon-sign-out-alt"></i><i class="icon-line-cross"></i></a>
								<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
									@csrf
								</form>
								@endif
							</div>
							<!-- #top-search end -->

							<!-- Top Cart
							============================================= -->

						</div>

						<div id="primary-menu-trigger">
							<svg class="svg-trigger" viewBox="0 0 100 100"><path d="m 30,33 h 40 c 3.722839,0 7.5,3.126468 7.5,8.578427 0,5.451959 -2.727029,8.421573 -7.5,8.421573 h -20"></path><path d="m 30,50 h 40"></path><path d="m 70,67 h -40 c 0,0 -7.5,-0.802118 -7.5,-8.365747 0,-7.563629 7.5,-8.634253 7.5,-8.634253 h 20"></path></svg>
						</div>

						<!-- Primary Navigation
						============================================= -->
						<nav class="primary-menu">

							<ul class="menu-container">
								@if (Auth::guest())
								<li class="menu-item"><a class="menu-link" href="#"><div>Home</div></a></li>
								<li class="menu-item"><a class="menu-link" href="{{ url('/contactus') }}"><div>Contact Us</div></a></li>
								@elseif(Auth::user()->role_id)
								<li class="menu-item"><a class="menu-link" href="{{ url('/manualorderlist') }}"><div>Manual_Order</div></a></li>
								<li class="menu-item"><a class="menu-link" href="{{ url('/allorderlist') }}"><div>All_Order</div></a></li>
								@else
								<li class="menu-item"><a class="menu-link" href="{{ url('/watchlist') }}"><div>Watch List</div></a></li>
								<li class="menu-item"><a class="menu-link" href="{{ url('/orderlist') }}"><div>Order List</div></a></li>
								<li class="menu-item"><a class="menu-link" href="{{ url('/contactus?subject=inquiry') }}"><div>Inquiry</div></a></li>
								<li class="menu-item"><a class="menu-link" href="{{ route('voyager-frontend.account') }}"><div>Account</div></a></li>
								@endif
							</ul>

						</nav><!-- #primary-menu end -->

						<form class="top-search-form" action="search.html" method="get">
							<input type="text" name="q" class="form-control" value="" placeholder="Type &amp; Hit Enter.." autocomplete="off">
						</form>

					</div>
				</div>
			</div>
			<div class="header-wrap-clone"></div>
		</header><!-- #header end -->
{{-- <div class="off-canvas position-right" id="offCanvas" data-off-canvas data-transition="push">
    <a href="#" class="close-button off-canvas-menu-icon-close" data-close="offCanvas">
        <span aria-hidden="true">&times;</span>
    </a>

    <ul class="vertical menu" data-dropdown-menu>
        {{ menu('primary', 'default.partials.menu-left') }}
    </ul>

    <hr>

    <ul class="vertical menu">
        @include('default.partials.menu-right')
    </ul>

    <hr>

    <ul class="menu social-icons align-center">
        {{ menu('social', 'default.partials.social') }}
    </ul>
</div>

<div class="off-canvas-content" data-off-canvas-content>
    <div class="header-site-search" data-toggle-search>
        <div class="grid-container">
            <div class="grid-x">
                <div class="cell medium-8 medium-offset-2">
                    @include('default.partials.search-box')
                </div>
            </div>
        </div>
    </div>

    <div class="top-bar">
        <div class="top-bar-left">
            <a href="#" class="off-canvas-menu-icon float-right hide-for-medium" data-open="offCanvas">
                <i class="fas fa-bars"></i> <span>Menu</span>
            </a>

            <a href="#" class="search-icon-mobile float-right hide-for-medium" data-toggle-search-trigger>
                <i class="fas fa-search"></i>
            </a>

            <div class="header-logo float-left">
                <a href="{{ url('/') }}">
                    <img src="{{ url('/') }}/images/logo.png" alt="{{ setting('site.title') }}" title="{{ setting('site.title') }}" />
                </a>
            </div>

            <ul class="dropdown menu show-for-medium" data-dropdown-menu>
                {{ menu('primary', 'default.partials.menu-left') }}
            </ul> <!-- /.menu -->
        </div>

        <div class="top-bar-right show-for-medium">
            <ul class="dropdown menu" data-dropdown-menu>
                @include('default.partials.menu-right')
            </ul>
        </div>
    </div> --}}
