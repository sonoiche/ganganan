@extends('layouts.app')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-datatable table-responsive">
            <div class="dataTables_wrapper dt-bootstrap5 no-footer">
                <div class="card-header d-flex justify-content-between flex-md-row pb-3">
                    <div class="head-label text-center"><h5 class="card-title mb-0">Assessment Tests</h5></div>
                </div>
                <table class="datatables-basic table border-top dataTable no-footer dtr-column" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info" style="width: 1391px;">
                    <thead>
                        <tr>
                            <th class="sorting text-center">#</th>
                            <th class="sorting">Assessment</th>
                            <th class="sorting text-center">Number of Items</th>
                            <th class="sorting text-center">Status</th>
                            <th class="sorting text-center">Score</th>
                            <th class="sorting_disabled text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($assessments as $key => $assessment)
                        <tr class="odd">
                            <td class="text-center">{{ $key+1 }}</td>
                            <td>{{ $assessment->name }}</td>
                            <td class="text-center">{{ $assessment->items }}</td>
                            <td class="text-center {{ (isset($assessment->client->status) && $assessment->client->status == 'Failed') ? 'text-danger' : 'text-success' }}">{{ $assessment->client->status ?? '--' }}</td>
                            <td class="text-center">{{ (isset($assessment->client->score)) ? $assessment->client->score.'%' : 'NA' }}</td>
                            <td class="text-center">
                                @if (isset($assessment->client->id) && $assessment->client->id)
                                    <span class="text-success">Already Taken</span>
                                @else
                                    <a href="{{ url('client/assessments', $assessment->id) }}" class="btn btn-icon item-edit text-primary"><i class="bx bx-file bx-md"></i></a>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td class="text-center" colspan="5">No data available</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection