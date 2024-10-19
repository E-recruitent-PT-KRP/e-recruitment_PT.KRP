@extends('layoutadmin.main')

@section('content')
<div class="container">
    <h1>Edit Job</h1>

    <form action="{{ route('career.update', $job->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="job_name">Job Name</label>
            <input type="text" id="job_name" name="job_name" class="form-control" value="{{ $job->job_name }}" required>
        </div>

        <div class="form-group">
            <label for="maximum_age">Maximum Age</label>
            <input type="number" id="maximum_age" name="maximum_age" class="form-control" value="{{ $job->maximum_age }}" required>
        </div>

        <div class="form-group">
            <label for="minimum_education">Minimum Education</label>
            <select id="minimum_education" name="minimum_education" class="form-control" required>
                <option value="" disabled>Select Education Level</option>
                <option value="High School" {{ $job->minimum_education == 'High School' ? 'selected' : '' }}>High School</option>
                <option value="Associate's Degree" {{ $job->minimum_education == "Associate's Degree" ? 'selected' : '' }}>Associate's Degree</option>
                <option value="Bachelor's Degree" {{ $job->minimum_education == "Bachelor's Degree" ? 'selected' : '' }}>Bachelor's Degree</option>
                <option value="Master's Degree" {{ $job->minimum_education == "Master's Degree" ? 'selected' : '' }}>Master's Degree</option>
                <option value="Doctorate" {{ $job->minimum_education == 'Doctorate' ? 'selected' : '' }}>Doctorate</option>
            </select>
        </div>

        <div class="form-group">
            <label for="major">Major</label>
            <input type="text" id="major" name="major" class="form-control" value="{{ $job->major }}" required>
        </div>

        <div class="form-group">
            <label for="salary">Salary</label>
            <input type="text" id="salary" name="salary" class="form-control" value="{{ $job->salary }}" required>
        </div>

        <div class="form-group">
            <label for="open_date">Open Date</label>
            <input type="date" id="open_date" name="open_date" class="form-control" value="{{ $job->open_date }}" required>
        </div>

        <div class="form-group">
            <label for="close_date">Close Date</label>
            <input type="date" id="close_date" name="close_date" class="form-control" value="{{ $job->close_date }}" required>
        </div>

        <div class="form-group">
            <label for="job_desc">Job Description</label>
            <textarea id="job_desc" name="job_desc" class="form-control" rows="4" required>{{ $job->job_desc }}</textarea>
        </div>

        <div class="form-group">
            <label for="job_criteria">Job Criteria</label>
            <textarea id="job_criteria" name="job_criteria" class="form-control" rows="4" required>{{ $job->job_criteria }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update Job</button>
    </form>
</div>
@endsection
