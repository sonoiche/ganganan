@php
    $currentUrl = Request::url();
    function checkUrl($arrayStrings) {
        foreach ($arrayStrings as $string) {
            if (Str::contains(Request::url(), $string)) {
                return 'active open';
            }
        }
    }
@endphp
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="index.html" class="app-brand-link">
            <img src="{{ url('site/images/logo.png') }}" style="width: 70%">
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm d-flex align-items-center justify-content-center"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <li class="menu-item {{ (strpos($currentUrl, 'home') !== false) ? 'active' : '' }}">
            <a href="{{ url('home') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-smile"></i>
                <div class="text-truncate" data-i18n="Dashboard">Dashboard</div>
            </a>
        </li>
        <li class="menu-item {{ checkUrl(['user-verify','users']) }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-group"></i>
                <div class="text-truncate" data-i18n="Users">Users</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ (strpos($currentUrl, 'user-verify') !== false) ? 'active' : '' }}">
                    <a href="{{ url('admin/user-verify') }}" class="menu-link">
                        <div class="text-truncate" data-i18n="For Verification">For Verification</div>
                    </a>
                </li>
                <li class="menu-item {{ (strpos($currentUrl, 'users') !== false) ? 'active' : '' }}">
                    <a href="{{ url('admin/users') }}" class="menu-link">
                        <div class="text-truncate" data-i18n="Verified Users">Verified Users</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item {{ (strpos($currentUrl, 'skills') !== false) ? 'active' : '' }}">
            <a href="{{ url('admin/skills') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-cube-alt"></i>
                <div class="text-truncate" data-i18n="Skills">Skills</div>
            </a>
        </li>
        <li class="menu-item {{ (strpos($currentUrl, 'payments') !== false) ? 'active' : '' }}">
            <a href="{{ url('admin/payments') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-credit-card-alt"></i>
                <div class="text-truncate" data-i18n="Payments">Payments</div>
            </a>
        </li>
        <li class="menu-item {{ checkUrl(['assessments']) }}">
            <a href="{{ url('admin/assessments') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-list-check"></i>
                <div class="text-truncate" data-i18n="Assessment Tests">Assessment Tests</div>
            </a>
        </li>
        <li class="menu-item {{ checkUrl(['payment-report','profit-chart','applicants']) }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bxs-bar-chart-alt-2"></i>
                <div class="text-truncate" data-i18n="Reports">Reports</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ (strpos($currentUrl, 'payment-report') !== false) ? 'active' : '' }}">
                    <a href="{{ url('admin/reports/payment-report') }}" class="menu-link">
                        <div class="text-truncate" data-i18n="Profit Reports">Profit</div>
                    </a>
                </li>
                <li class="menu-item {{ (strpos($currentUrl, 'profit-chart') !== false) ? 'active' : '' }}">
                    <a href="{{ url('admin/reports/profit-chart') }}" class="menu-link">
                        <div class="text-truncate" data-i18n="Profit Chart">Profit Chart</div>
                    </a>
                </li>
                <li class="menu-item {{ (strpos($currentUrl, 'applicants') !== false) ? 'active' : '' }}">
                    <a href="{{ url('admin/reports/applicants') }}" class="menu-link">
                        <div class="text-truncate" data-i18n="Applicants">Applicants</div>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</aside>