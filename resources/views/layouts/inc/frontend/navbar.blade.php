<nav class="navbar fixed-top navbar-expand-lg border-bottom bg-white navbar-light" aria-label="Offcanvas navbar large">
    <div class="container">
        <a class="navbar-brand" href="#"><img style="width:200px;"
                src="{{asset('uploads/logo/'.$option_nav->logo)}}"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar2"
            aria-controls="offcanvasNavbar2">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="offcanvas offcanvas-end text-bg-light" tabindex="-1" id="offcanvasNavbar2"
            aria-labelledby="offcanvasNavbar2Label">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasNavbar2Label"><img style="width:200px;"
                        src="{{asset('uploads/logo/'.$option_nav->logo)}}"></h5>
                <button type="button" class="btn-close btn-close-dark" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav justify-content-start flex-grow-1 pe-3 fs-6">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{url('/')}}">Home</a>
                    </li>
                    {{-- <li class="nav-item">
                        <a class="nav-link" href="#">Booking</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Layanan Darurat</a>
                    </li> --}}
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/contact')}}">Hubungi Kami</a>
                    </li>
                    {{-- <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle dropdown-plus" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Products
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li> --}}

                </ul>

                <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">

                    <a class="nav-link px-3" href="{{ url('cart') }}"><i class='bx bxs-shopping-bag-alt'></i> Cart
                        <span class="badge bg-primary rounded-pill">{{ count((array)
                            session('cart')) }}</span></a>



                    @guest
                    @if (Route::has('register'))
                    <li class="nav-item me-2">
                        <a class="nav-link" href="{{ route('register') }}"><i class='bx bx-user'></i>
                            {{
                            __('Register') }}</a>
                    </li>
                    @endif

                    @if (Route::has('login'))
                    <li class="nav-item">
                        <a class="nav-link btn btn-primary px-3" href="{{ route('login') }}"><i
                                class='bx bx-log-in'></i>
                            {{__('Login') }}
                        </a>
                    </li>
                    @endif
                    @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">


                            @if(Auth::user()->role == 1 || (Auth::user()->role == 2))
                            <a class="dropdown-item" href="{{ url('admin/dashboard') }}">
                                Dashboard
                            </a>
                            <a class="dropdown-item" href="{{ url('member/dashboard') }}">
                                Member Area
                            </a>
                            @else
                            <a class="dropdown-item" href="{{ url('member/dashboard') }}">
                                Member Area
                            </a>
                            @endif

                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                    @endguest


                </ul>

            </div>
        </div>
    </div>
</nav>