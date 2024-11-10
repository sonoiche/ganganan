<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="{{ url('assets/vendor/fonts/boxicons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ url('assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ url('assets/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ url('assets/css/demo.css') }}" />
</head>
<body>
    <div class="card email-card-last mx-sm-6 mx-3 mt-4">
        <div class="card-header d-flex justify-content-between align-items-center flex-wrap border-bottom">
            <div class="d-flex align-items-center mb-sm-0 mb-3">
                <img src="../../assets/img/avatars/1.png" alt="user-avatar" class="flex-shrink-0 rounded-circle me-4" height="38" width="38" />
                <div class="flex-grow-1 ms-1">
                    <h6 class="m-0 fw-normal">{{ config('app.name') }} Team</h6>
                    <small class="text-body">info@ganganan.site</small>
                </div>
            </div>
            <div class="d-flex align-items-center">
                <p class="mb-0 me-4 text-muted">{{ $user->created_date_time }}</p>
            </div>
        </div>
        <div class="card-body pt-6">
            <p class="fw-medium">Greetings!</p>
            <p>
                Welcome to {{ config('app.name') }}! We’re excited to have you join our community. To complete your registration and secure your account, please use the following One-Time Password (OTP):
            </p>
            <p><h4><b>Your OTP: {{ $user->otp_password ?? '120332' }}</b></h4></p>
            <p>If you did not request this, please contact our support team immediately.</p>
            <p class="mb-0">Sincerely yours,</p>
            <p class="fw-medium mb-0">{{ config('app.name') }} Team</p>
        </div>
    </div>    
</body>
</html>