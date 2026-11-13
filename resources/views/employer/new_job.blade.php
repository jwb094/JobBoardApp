@extends('layouts.layout')
@push('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-bs5.min.css" rel="stylesheet">
@endpush
@section('title', 'Create a Job')
@section('content')
<x-job-form.wizard
    title="Create a job"
    description="Share the role details and find your next great hire."
    :action="route('employer.newjobdesc')"
    submit-label="Publish job"
>
    <div class="step job-form-step active">
        <h2>Role details</h2>
        <div class="job-form-grid">
            <div class="job-form-field job-form-field--full">
                <x-form.label for="job_title">Job title</x-form.label>
                <x-form.form-input type="text" value="{{ old('title') }}" name="title" id="job_title" class="job-form-input" placeholder="e.g. Product Designer" required />
            </div>

            <div class="job-form-field job-form-field--full">
                <x-form.label for="category_id">Category</x-form.label>
                <select name="category_id" id="category_id" class="job-form-input" required>
                    <option value="">Choose a category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="job-form-field">
                <x-form.label for="salary_min">Minimum salary (£)</x-form.label>
                <x-form.form-input type="number" value="{{ old('salary_min') }}" name="salary_min" id="salary_min" class="job-form-input" placeholder="e.g. 30000" min="0" />
            </div>
            <div class="job-form-field">
                <x-form.label for="salary_max">Maximum salary (£)</x-form.label>
                <x-form.form-input type="number" value="{{ old('salary_max') }}" name="salary_max" id="salary_max" class="job-form-input" placeholder="e.g. 45000" min="0" />
            </div>

            <div class="job-form-field">
                <x-form.label for="job_type">Job type</x-form.label>
                <x-form.select name="job_type" id="job_type" class="job-form-input" :formdata="$jobTypes" :recordFieldData="null" fieldname="job_type" />
            </div>
            <div class="job-form-field">
                <x-form.label for="status">Status</x-form.label>
                <x-form.select name="status" id="status" class="job-form-input" :formdata="$jobStatuses" :recordFieldData="null" fieldname="status" />
            </div>

            <div class="job-form-field job-form-field--full">
                <x-form.label for="job_expiry_date">Closing date</x-form.label>
                <x-form.form-input type="date" name="expires_at" value="{{ old('expires_at') }}" id="job_expiry_date" class="job-form-input" />
            </div>
        </div>
    </div>

    <div class="step job-form-step">
        <h2>Company and location</h2>
        <div class="job-form-grid">
            <div class="job-form-field job-form-field--full">
                <x-form.label for="company_Desc">Company background</x-form.label>
                <x-form.form-textarea name="company_background_info" id="company_Desc" class="summernote job-form-input">{{ old('company_background_info') }}</x-form.form-textarea>
            </div>
            <div class="job-form-field job-form-field--full">
                <x-form.label for="company_location">Location</x-form.label>
                <x-form.form-input type="text" value="{{ old('location') }}" name="location" id="company_location" class="job-form-input" placeholder="e.g. Hybrid, London" />
            </div>
            <div class="job-form-field">
                <x-form.label for="company_city">City</x-form.label>
                <x-form.form-input type="text" value="{{ old('city') }}" name="city" id="company_city" class="job-form-input" placeholder="City" />
            </div>
            <div class="job-form-field">
                <x-form.label for="company_post_code">Post code</x-form.label>
                <x-form.form-input type="text" value="{{ old('post_code') }}" name="post_code" id="company_post_code" class="job-form-input" placeholder="Post code" />
            </div>
            <div class="job-form-field job-form-field--full">
                <x-form.label for="company_address">Address</x-form.label>
                <x-form.form-input type="text" name="address" value="{{ old('address') }}" id="company_address" class="job-form-input" placeholder="Company address" />
            </div>
        </div>
    </div>

    <div class="step job-form-step">
        <h2>Describe the opportunity</h2>
        <div class="job-form-grid">
            <div class="job-form-field job-form-field--full">
                <x-form.label for="description">Job description</x-form.label>
                <x-form.form-textarea name="description" id="description" class="summernote job-form-input">{{ old('description') }}</x-form.form-textarea>
            </div>
            <div class="job-form-field job-form-field--full">
                <x-form.label for="skillset_About">Skills and experience</x-form.label>
                <x-form.form-textarea name="skillset_About" id="skillset_About" class="summernote job-form-input">{{ old('skillset_About') }}</x-form.form-textarea>
            </div>
            <div class="job-form-field job-form-field--full">
                <x-form.label for="benefits">Benefits</x-form.label>
                <x-form.form-textarea name="benefits" id="benefits" class="summernote job-form-input">{{ old('benefits') }}</x-form.form-textarea>
            </div>
        </div>
    </div>
</x-job-form.wizard>
@endsection
@push('other-scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-bs5.min.js"></script>
<script src="{{ URL::asset('js/multi-step-form.js') }}"></script>
<script>
    $(function () {
        $('.summernote').summernote({
            height: 150,
            placeholder: 'Write something...',
            toolbar: [
                ['style', ['bold', 'italic', 'underline']],
                ['para', ['ul', 'ol']],
                ['insert', ['link']],
                ['view', ['codeview']]
            ]
        });
    });
</script>
@endpush
