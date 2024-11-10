<div class="col-xl-4 col-lg-5 order-1 order-md-0">
    <!-- User Card -->
    <div class="card mb-6">
        <div class="card-body pt-12">
            <div class="user-avatar-section">
                <div class="d-flex align-items-center flex-column">
                    <img class="img-fluid rounded mb-4" src="{{ $user->display_photo }}" height="120" width="120" alt="User avatar" />
                    <div class="user-info text-center">
                        <h5>{{ $user->fullname }}</h5>
                        <span class="badge bg-label-secondary">Member Since : {{ $user->created_date }}</span>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-around flex-wrap my-6 gap-0 gap-md-3 gap-lg-4">
                <div class="d-flex align-items-center me-5 gap-4">
                    <div class="avatar">
                        <div class="avatar-initial bg-label-primary rounded w-px-40 h-px-40">
                            <i class="bx bx-check bx-lg"></i>
                        </div>
                    </div>
                    <div>
                        <h5 class="mb-0">{{ $user->works_count ?? 0 }}</h5>
                        <span>Works Done</span>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-4">
                    <div class="avatar">
                        <div class="avatar-initial bg-label-primary rounded w-px-40 h-px-40">
                            <i class="bx bx-star bx-lg"></i>
                        </div>
                    </div>
                    <div>
                        <h5 class="mb-0">{{ $user->rating ?? 0 }}</h5>
                        <span>Reviews</span>
                    </div>
                </div>
            </div>
            <h5 class="pb-4 border-bottom mb-4">Details</h5>
            <div class="info-container">
                <ul class="list-unstyled mb-6">
                    <li class="mb-2">
                        <span class="h6">Fullname:</span>
                        <span>{{ $user->fullname }}</span>
                    </li>
                    <li class="mb-2">
                        <span class="h6">Email:</span>
                        <span>{{ $user->email }}</span>
                    </li>
                    <li class="mb-2">
                        <span class="h6">Status:</span>
                        <span>{{ $user->status }}</span>
                    </li>
                    <li class="mb-2">
                        <span class="h6">Contact:</span>
                        <span>{{ $user->contact_number }}</span>
                    </li>
                    <li class="mb-2">
                        <span class="h6">Complete Address:</span>
                        <span>{{ $user->complete_address ?? '' }}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- /User Card -->
</div>