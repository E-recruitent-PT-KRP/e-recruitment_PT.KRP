@extends('layoutadmin.main')

@section('content')
<div class="container">
    <h1>Create New Job</h1>

    <form action="{{ route('career.store') }}" method="POST">
        @csrf
        
        <div class="form-group">
            <label for="job_name">Job Name</label>
            <input type="text" id="job_name" name="job_name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="maximum_age">Maximum Age</label>
            <input type="number" id="maximum_age" name="maximum_age" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="minimum_education">Minimum Education</label>
            <select id="minimum_education" name="minimum_education" class="form-control" required>
                <option value="" disabled selected>Select Education Level</option>
                <option value="High School">High School</option>
                <option value="Associate's Degree">Associate's Degree</option>
                <option value="Bachelor's Degree">Bachelor's Degree</option>
                <option value="Master's Degree">Master's Degree</option>
                <option value="Doctorate">Doctorate</option>
            </select>
        </div>

        <div class="form-group">
            <label for="major">Major</label>
            <input type="text" id="major" name="major" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="salary">Salary</label>
            <input type="text" id="salary" name="salary" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="open_date">Open Date</label>
            <input type="date" id="open_date" name="open_date" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="close_date">Close Date</label>
            <input type="date" id="close_date" name="close_date" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="job_desc">Job Description</label>
            <textarea id="job_desc" name="job_desc" class="form-control" rows="4" required></textarea>
        </div>

        <div class="form-group">
            <label for="job_criteria">Job Criteria</label>
            <textarea id="job_criteria" name="job_criteria" class="form-control" rows="4" required></textarea>
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Create Job</button>
    </form>
</div>
<script>
    document.getElementById('createJobForm').addEventListener('submit', function() {
        var submitButton = document.getElementById('submitButton');
        submitButton.disabled = true; // Disable the button to prevent multiple submissions
        submitButton.innerHTML = 'Creating...'; // Change the button text to "Creating..."
    });
    </script>
@endsection