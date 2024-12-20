<div class="border-end pb-5" id="sidebar-wrapper">
    <div class="sidebar-heading text-transparent"> </div>
    <div class="py-4 px-3">
        <div class="media">
            <img src="{{ asset('uploads/logo/default-avatar.jpg') }}" alt="..." width="65"
                class="mr-3 rounded-circle shadow-sm">
            <div class="media-body my-3">
                <h5 class="m-0 text-muted">{{ Auth::user()->name }}</h5>
                <small class="font-weight-light mb-0 text-success"><i class="fas fa-circle text-success"></i>
                    Online</small>
            </div>
        </div>
    </div>
    <p class="text-muted font-weight-bold text-uppercase px-3 small pb-2 mb-0"><b>Main</b></p>
    <ul class="nav flex-column  mb-0">

        @if (Auth::user()->role == 1)
            <li class="nav-item ">
                <a href="{{ url('admin/dashboard') }}" class="nav-link active">
                    <i class="feather-home  fa-fw"></i>
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('admin/category') }}" class="nav-link">
                    <i class="feather-tag mr-3  fa-fw"></i>
                    Category
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ url('admin/services') }}" class="nav-link">
                    <i class="feather-shopping-bag mr-3  fa-fw"></i>
                    Service
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('admin/orders') }}" class="nav-link">
                    <i class="feather-shopping-cart mr-3  fa-fw"></i>
                    orders
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('admin/customers') }}" class="nav-link">
                    <i class="feather-users mr-3  fa-fw"></i>
                    Customer
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('admin/invoices') }}" class="nav-link">
                    <i class="feather-file-text mr-3  fa-fw"></i>
                    Invoice
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('admin/brands') }}" class="nav-link">
                    <i class="feather-archive mr-3  fa-fw"></i>
                    Brand
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('admin/provinces') }}" class="nav-link">
                    <i class="feather-map-pin mr-3  fa-fw"></i>
                    Area
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('admin/inventories') }}" class="nav-link">
                    <i class="feather-box mr-3  fa-fw"></i>
                    Data Stock
                </a>
            </li>
            <p class="text-muted font-weight-bold text-uppercase px-3 small py-2 mb-0"><b>Web Front</b></p>

            <li class="nav-item">
                <a class="nav-link d-flex justify-content-between 
                
                "
                    data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false"
                    aria-controls="collapseExample">
                    <span><i class="feather-airplay mr-3  fa-fw"></i> Homepage </span> <i
                        class="feather-chevron-down me-3  fa-fw my-auto"></i>
                </a>
            </li>
            <ul class="collapse " id="collapseExample" class="alert alert-primary">
                <li class="nav-child">
                    <a href="{{ url('admin/sliders') }}" class=" nav-link">
                        <i class="fa-solid fa-caret-right mr-3  fa-fw"></i>
                        Slider
                    </a>
                </li>
            </ul>
            <p class="text-muted font-weight-bold text-uppercase px-3 small py-2 mb-0"> <b>Pengaturan</b></p>

            <li class="nav-item">
                <a href="{{ url('admin/options') }}" class="nav-link ">
                    <i class="feather-settings mr-3  fa-fw"></i>
                    Profile Web
                </a>
            </li>
        @elseif(Auth::user()->role == 2)
            <li class="nav-item">
                <a href="{{ url('admin/services') }}" class="nav-link">
                    <i class="feather-shopping-bag mr-3  fa-fw"></i>
                    Service
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('admin/orders') }}" class="nav-link">
                    <i class="feather-shopping-bag mr-3  fa-fw"></i>
                    Order
                </a>
            </li>
        @endif
    </ul>
</div>
