<ul style="display: block !important"
    class="nav nav-pills nav-justified flex-column bg-white rounded mt-4 shadow p-3 mb-0" id="pills-tab" role="tablist">
    <li class="nav-item">
        <a class="nav-link rounded {{ activeClassProfile('dashboard') }}" id="dashboard" data-bs-toggle="pill"
            href="#dash" role="tab" aria-controls="dash"
            aria-selected="{{ activeClassProfile('dashboad', false) }}">
            <div class="text-start py-1 px-3">
                <h6 class="mb-0"><i class="uil uil-dashboard h5 align-middle me-2 mb-0"></i>
                    داشبورد </h6>
            </div>
        </a>
        <!--end nav link-->
    </li>
    <!--end nav item-->

    <li class="nav-item mt-2">
        <a class="nav-link rounded {{ activeClassProfile('order') }}" id="order-history" data-bs-toggle="pill"
            href="#orders" role="tab" aria-controls="orders"
            aria-selected="{{ activeClassProfile('order', false) }}">
            <div class="text-start py-1 px-3">
                <h6 class="mb-0"><i class="uil uil-list-ul h5 align-middle me-2 mb-0"></i> سفارشات
                </h6>
            </div>
        </a>
        <!--end nav link-->
    </li>
    <!--end nav item-->

    <li class="nav-item mt-2">
        <a class="nav-link rounded {{ activeClassProfile('address') }}" id="addresses" data-bs-toggle="pill"
            href="#address" role="tab" aria-controls="address"
            aria-selected="{{ activeClassProfile('address', false) }}">
            <div class="text-start py-1 px-3">
                <h6 class="mb-0"><i class="uil uil-map-marker h5 align-middle me-2 mb-0"></i> آدرس
                </h6>
            </div>
        </a>
        <!--end nav link-->
    </li>
    <!--end nav item-->

    <li class="nav-item mt-2">
        <a class="nav-link rounded {{ activeClassProfile('info') }}" id="account-details" data-bs-toggle="pill"
            href="#account" role="tab" aria-controls="account"
            aria-selected="{{ activeClassProfile('info', false) }}">
            <div class="text-start py-1 px-3">
                <h6 class="mb-0"><i class="uil uil-user h5 align-middle me-2 mb-0"></i> جزئیات
                    حساب</h6>
            </div>
        </a>
        <!--end nav link-->
    </li>
    <!--end nav item-->

    <li class="nav-item mt-2">
        <a class="nav-link rounded" href="auth-login.html" aria-selected="false">
            <div class="text-start py-1 px-3">
                <h6 onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="mb-0">
                    <i class="uil uil-sign-out-alt h5 align-middle me-2 mb-0"></i>
                    خروج
                </h6>

                <form id="logout-form" action="{{ route('filament.auth.logout') }}" method="POST"
                    style="display: none;">
                    @csrf
                </form>
            </div>
        </a>
        <!--end nav link-->
    </li>
    <!--end nav item-->
</ul>
