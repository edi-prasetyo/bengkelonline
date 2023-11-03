<nav class="navbar navbar-expand-lg navbar-light bg-white rounded shadow-sm mb-3">
    <div class="w-100">
        <div class="user-avatar-section mb-3 d-flex justify-content-center p-3">

            <div class="avatar avatar-xl me-2 avatar-online">
                <span class="avatar-initial rounded-circle bg-label-success">
                    <i class="bx bx-user"></i>
                </span>
            </div>
            <div class="user-info text-center">
                <h5 class="mb-2">{{Auth::user()->name}}</h5>
                <span class="badge bg-label-secondary">
                    @if(Auth::user()->role == 1)
                    Superadmin
                    @elseif(Auth::user()->role == 2)
                    Admin
                    @elseif(Auth::user()->role == 3)
                    Seller
                    @else
                    Member
                    @endif
                </span>
            </div>

        </div>
        <div class="divider my-4">
            <div class="divider-text">Menu</div>
        </div>

        {{-- <a class="navbar-brand p-3" style="width: 100%" href="#">Menu Member</a> --}}
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
            aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav me-auto mb-2 mb-md-0 flex-column p-2 w-100">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{url('member/dashboard')}}"><i
                            class='bx bx-home-alt'></i>
                        Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('member/orders')}}"><i class='bx bx-cart'></i> My Orders</a>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link" href="{{url('member/wallets')}}"><i class='bx bx-wallet'></i> Deposit</a>
                </li> --}}
                <li class="nav-item">
                    <a class="nav-link" href="{{url('member/orders')}}"><i class='bx bx-user'></i> Profile</a>
                </li>
            </ul>

        </div>
    </div>
</nav>