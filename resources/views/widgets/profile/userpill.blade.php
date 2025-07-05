@php
    $currentUrl = Request::url();
    function navPill($arrayStrings) {
        foreach ($arrayStrings as $string) {
            if (Str::contains(Request::url(), $string)) {
                return 'active';
            }
        }
    }
@endphp
<div class="nav-align-top">
    <ul class="nav nav-pills flex-column flex-md-row mb-6">
        <li class="nav-item">
            <a class="nav-link {{ navPill(['profile']) }} d-flex justify-content-start" href="{{ url('client/profile') }}"><i class="bx bx-user bx-sm me-1_5"></i>Account</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ navPill(['identifications']) }} d-flex justify-content-start" href="{{ url('client/identifications') }}"><i class="bx bx-user-pin bx-sm me-1_5"></i>Identifications</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ navPill(['employments']) }} d-flex justify-content-start" href="{{ url('client/employments') }}"><i class="bx bx-briefcase bx-sm me-1_5"></i>Employments</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ navPill(['skills']) }} d-flex justify-content-start" href="{{ url('client/skills') }}"><i class="bx bx-star bx-sm me-1_5"></i>Skills</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ navPill(['subscription']) }} d-flex justify-content-start" href="{{ url('client/subscription') }}"><i class="bx bx-money bx-sm me-1_5"></i>Subscription</a>
        </li>
    </ul>
</div>