@extends('layouts.site')
@section('content')
<div class="pageTitle">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-6">
                <h1 class="page-heading">Register</h1>
            </div>
            <div class="col-md-6 col-sm-6">
                <div class="breadCrumb"><a href="#">Pangunahing Pahina</a> / <span>Job Name</span></div>
            </div>
        </div>
    </div>
</div>
<div class="listpgWraper">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-3 mx-auto">
                <div class="userccount">
                    <h5>User Registration</h5>
                    <form action="{{ route('register') }}" method="post">
                        @csrf
                        <div class="row mb-3" style="margin-top: 30px">
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="fname" class="form-label">First Name</label>
                                    <input type="text" name="fname" id="fname" class="form-control @error('fname') is-invalid @enderror" />
                                    @error('fname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="lname" class="form-label">Last Name</label>
                                    <input type="text" name="lname" id="lname" class="form-control @error('lname') is-invalid @enderror" />
                                    @error('lname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" />
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="row mb-3">
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" />
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="contact_number" class="form-label">Contact Number</label>
                            <input type="text" name="contact_number" id="contact_number" class="form-control @error('contact_number') is-invalid @enderror" value="{{ old('contact_number') }}" />
                            @error('contact_number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <div class="form-check @error('privacy') is-invalid @enderror">
                                <input class="form-check-input" type="checkbox" name="privacy" value="1" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault" style="margin-top: 3px">
                                    By checking the box, you agree to our <a href="javascript:;" id="privacy-policy">Privacy Policy</a>
                                </label>
                            </div>
                            @error('privacy')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-3 d-flex justify-content-center">
                            <button class="btn btn-primary" type="submit">Register</button>
                        </div>
                    </form>
                    <!-- sign up form -->
                    <div class="newuser">
                        <i class="fa fa-user" aria-hidden="true"></i> Alread have an account? <a href="{{ url('login') }}">Login Here</a>
                    </div>
                    <!-- sign up form end-->
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="privacy-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Privacy Policy</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="height: 600px; overflow-y: auto">
                <p>Privacy Policy for Skilled Workers Progressive Web App (PWA)</p>
                <br><br>
                <p>Effective Date: December 2024</p>
                <br><br>
                <p>Introduction<br>
                A Progressive Web Application for Skilled workers in Pangasinan ("we," "our," or "us") is committed to protecting your privacy. This Privacy Policy explains how we collect, use, disclose, and safeguard your information when you use our Progressive Web App (PWA) designed for skilled workers. Please read this policy carefully. If you do not agree with the terms, please refrain from using the app.</p>
                <br><br>
                <p>1. Information We Collect</p>
                <p>We may collect the following types of information:</p>
                <br><br>
                <p>a. Personal Information</p>
                <br><br>
                <p>
                    Name<br>
                    Contact details (email address, phone number)<br>
                    Professional ID's <br>
                    Employment history<br>
                </p>
                <br><br>
                <p>b. Usage Data</p>
                <p>
                    Device information (e.g., browser type, operating system)
                    App activity (e.g., pages visited, time spent on the app)
                </p>
                <br><br>
                <p>c. Location Information</p>
                <p>With your consent, we may collect your location to provide job opportunities nearby.</p>
                <br><br>
                <p>d. Uploaded Documents</p>
                <p>Resumes and  ID's uploaded for professional purposes.</p>
                <br><br>
                <p>2. How We Use Your Information</p>
                <br><br>
                <p>We use the collected information for the following purposes:</p>
                <br><br>
                <p>
                    To match skilled workers with job opportunities.<br>
                    To improve app functionality and user experience.<br>
                    To communicate updates, notifications, or promotional materials.<br>
                    To comply with legal obligations.
                </p>
                <br><br>
                <p>3. How We Share Your Information</p>
                <br><br>
                <p>
                    We do not sell your personal information. However, we may share your information with:<br>
                    Employers or Recruiters: For job-matching purposes.<br>
                    Service Providers: Trusted third-party vendors assisting with app operations.<br>
                    Legal Authorities: When required by law or to protect rights and safety.
                </p>
                <br><br>
                <p>4. Data Security</p>
                <br><br>
                <p>We use industry-standard encryption and security measures to protect your data. While we strive to secure your information, no method is 100% secure, and we cannot guarantee absolute security.</p>
                <br><br>
                <p>5. Your Rights</p>
                <br><br>
                <p>
                    You have the right to:<br>
                    Access, correct, or delete your personal information.<br>
                    Withdraw consent for data processing.<br>
                    Opt out of marketing communications.
                </p>
                <br><br>
                <p>To exercise these rights, contact us at 09666221738.</p>
                <br><br>
                <p>6. Cookies and Tracking</p>
                <br><br>
                <p>We use cookies and similar technologies to enhance your experience. You can adjust your browser settings to refuse cookies, but this may limit app functionality.</p>
                <br><br>
                <p>7. Third-Party Links</p>
                <br><br>
                <p>Our app may contain links to third-party websites or services. We are not responsible for their privacy practices.</p>
                <br><br>
                <p>8. Changes to This Policy</p>
                <br><br>
                <p>We may update this Privacy Policy from time to time. Updates will be posted on this page, and the effective date will be revised accordingly.</p>
                <br><br>
                <p>9. Contact Us</p>
                <br><br>
                <p>
                    If you have questions about this Privacy Policy, please contact us at:<br>
                    Email: Ganganan@gmail.com<br>
                    Phone: 09666221738
                </p>
                <br><br>
                <p>By using our PWA, you agree to this Privacy Policy and the terms of use.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function () {
    $('#privacy-policy').click(function (e) { 
        e.preventDefault();
        $('#privacy-modal').modal('show');
    });
});
</script>
@endpush