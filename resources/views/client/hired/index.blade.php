@extends('layouts.app')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-datatable table-responsive">
            <div class="dataTables_wrapper dt-bootstrap5 no-footer">
                <div class="card-header d-flex justify-content-between flex-md-row pb-3">
                    <div class="head-label text-center"><h5 class="card-title mb-0">Hired Applicants</h5></div>
                </div>
                <table class="datatables-basic table border-top dataTable no-footer dtr-column" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info" style="width: 1391px;">
                    <thead>
                        <tr>
                            <th class="sorting text-center">#</th>
                            <th class="sorting">Date Applied</th>
                            <th class="sorting">Job Title</th>
                            <th class="sorting">Applicant</th>
                            <th class="sorting">Date Hired</th>
                            <th class="sorting text-center">Status</th>
                            {{-- <th class="sorting_disabled text-center">Actions</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($applications as $key => $application)
                        <tr class="odd">
                            <td class="text-center">{{ $key+1 }}</td>
                            <td>{{ $application->created_date }}</td>
                            <td>{{ $application->job->job_title ?? '' }}</td>
                            <td>{{ $application->user->fullname ?? '' }}</td>
                            <td>{{ \Carbon\Carbon::parse($application->updated_at)->format('M d, Y') }}</td>
                            <td class="text-center">{{ $application->status }}</td>
                            {{-- <td class="text-center">
                                <a href="javascript:;" onclick="removeApplication({{ $application->id }})" class="btn btn-icon item-edit text-danger"><i class="bx bx-trash bx-md"></i></a>
                            </td> --}}
                        </tr>
                        @empty
                        <tr>
                            <td class="text-center" colspan="6">No data available</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection