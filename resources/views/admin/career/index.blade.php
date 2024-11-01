@extends('layoutadmin.main')

@section('content')
    <div class="container">
        <h1>Jobs List</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('career.create') }}" class="btn btn-primary mb-3">Create New Job</a>

        <div class="table-responsive">
            <table class="table text-start align-middle table-striped table-hover" id="dataTable" width="100%"
                cellspacing="0">
                <thead>
                    <tr>
                        <th>Job Name</th>
                        <th>Maximum Age</th>
                        <th>Minimum Education</th>
                        <th>Major</th>
                        <th>Salary</th>
                        <th>Open Date</th>
                        <th>Close Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($careers as $career)
                        <tr>
                            <td>{{ $career->job_name }}</td>
                            <td>{{ $career->maximum_age }}</td>
                            <td>{{ $career->minimum_education }}</td>
                            <td>{{ $career->major }}</td>
                            <td>{{ $career->salary }}</td>
                            <td>{{ $career->open_date }}</td>
                            <td>{{ $career->close_date }}</td>
                            <td>
                                @if (now()->between($career->open_date, $career->close_date))
                                    <span class="badge bg-success">Open</span>
                                @else
                                    <span class="badge bg-secondary">Close</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('career.edit', $career->id) }}" class="btn btn-warning btn-sm"><i
                                        class="fa fa-pencil fa-sm"></i></a>
                                <form action="{{ route('career.destroy', $career->id) }}" method="POST"
                                    style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"><i
                                            class="fa fa-trash fa-sm"></i></a>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center">No jobs available</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
