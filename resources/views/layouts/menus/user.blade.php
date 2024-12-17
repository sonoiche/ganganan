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
        <a href="{{ url('home') }}" class="app-brand-link">
            <img src="{{ url('site/images/logo.png') }}" style="width: 100%" />
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
        <li class="menu-item {{ checkUrl(['jobs']) }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bxs-briefcase"></i>
                <div class="text-truncate" data-i18n="Jobs">Jobs</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ (strpos($currentUrl, 'jobs') !== false) ? 'active' : '' }}">
                    <a href="{{ url('client/jobs') }}" class="menu-link">
                        <div class="text-truncate" data-i18n="Job Lists">Job Lists</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item {{ checkUrl(['profile','identifications','employments']) }}">
            <a href="{{ url('client/profile') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-user-badge"></i>
                <div class="text-truncate" data-i18n="Profile">Profile</div>
            </a>
        </li>
        <li class="menu-item {{ checkUrl(['applications']) }}">
            <a href="{{ url('client/applications') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-briefcase-alt-2"></i>
                <div class="text-truncate" data-i18n="My Applications">My Applications</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{ url('jobs') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-globe"></i>
                <div class="text-truncate" data-i18n="Browse Jobs">Browse Jobs</div>
            </a>
        </li>
        {{-- <li class="menu-item {{ checkUrl(['applicants']) }}">
            <a href="{{ url('client/applicants') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-group"></i>
                <div class="text-truncate" data-i18n="Applicants">Applicants</div>
            </a>
        </li> --}}
        <li class="menu-item {{ checkUrl(['hired']) }}">
            <a href="{{ url('client/hired') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-group"></i>
                <div class="text-truncate" data-i18n="Hired Applicants">Hired Applicants</div>
            </a>
        </li>
        <li class="menu-item {{ checkUrl(['assessments']) }}">
            <a href="{{ url('client/assessments') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-file"></i>
                <div class="text-truncate" data-i18n="Assessment Test">Assessment Test</div>
            </a>
        </li>
    </ul>
</aside>