@extends('layouts.layout')
@push('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-bs5.min.css" rel="stylesheet">
@endpush
@section('title', 'Edit ' . $job->title)
@section('content')
<x-job-form.wizard
    title="Edit job"
    description="Update the role details and keep your opportunity current."
    :action="route('employer.updatejobdesc', $job->id)"
    method="PUT"
    submit-label="Save changes"
>
    <section class="step employer-job-form__step active" aria-label="Role details">
        <h2 class="employer-job-form__step-title">Role details</h2>
        <div class="employer-job-form__grid grid grid-cols-1 gap-4 md:grid-cols-2">
            <div class="employer-job-form__field employer-job-form__field--full">
                <x-form.label for="job_title">Job title</x-form.label>
                <x-form.form-input type="text" value="{{ old('title', $job->title) }}" name="title" id="job_title" class="employer-job-form__input w-full rounded-xl" placeholder="e.g. Product Designer" required />
            </div>

            <div class="employer-job-form__field employer-job-form__field--full">
                <x-form.label for="job_category">Category</x-form.label>
                <select name="category_id" id="job_category" class="employer-job-form__input w-full rounded-xl" required>
                    <option value="">Choose a category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @selected(old('category_id', $job->category_id) == $category->id)>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="employer-job-form__field">
                <x-form.label for="salary_min">Minimum salary (£)</x-form.label>
                <x-form.form-input type="number" value="{{ old('salary_min', $job->salary_min) }}" name="salary_min" id="salary_min" class="employer-job-form__input w-full rounded-xl" placeholder="e.g. 30000" min="0" />
            </div>
            <div class="employer-job-form__field">
                <x-form.label for="salary_max">Maximum salary (£)</x-form.label>
                <x-form.form-input type="number" value="{{ old('salary_max', $job->salary_max) }}" name="salary_max" id="salary_max" class="employer-job-form__input w-full rounded-xl" placeholder="e.g. 45000" min="0" />
            </div>

            <div class="employer-job-form__field">
                <x-form.label for="job_type">Job type</x-form.label>
                <x-form.select name="job_type" id="job_type" class="employer-job-form__input w-full rounded-xl" :formdata="$jobTypes" :recordFieldData="$job->job_type" fieldname="job_type" />
            </div>
            <div class="employer-job-form__field">
                <x-form.label for="status">Status</x-form.label>
                <x-form.select name="status" id="status" class="employer-job-form__input w-full rounded-xl" :formdata="$jobStatuses" :recordFieldData="$job->status" fieldname="status" />
            </div>

            <div class="employer-job-form__field employer-job-form__field--full">
                <x-form.label for="job_expiry_date">Closing date</x-form.label>
                <x-form.form-input type="date" name="expires_at" value="{{ old('expires_at', optional($job->expires_at)->toDateString()) }}" id="job_expiry_date" class="employer-job-form__input w-full rounded-xl" />
            </div>
        </div>
    </section>

    <section class="step employer-job-form__step" aria-label="Company and location">
        <h2 class="employer-job-form__step-title">Company and location</h2>
        <div class="employer-job-form__grid grid grid-cols-1 gap-4 md:grid-cols-2">
            <div class="employer-job-form__field employer-job-form__field--full">
                <x-form.label for="company_Desc">Company background</x-form.label>
                <x-form.form-textarea name="company_background_info" id="company_Desc" class="employer-job-form__input employer-job-form__input--rich summernote w-full rounded-xl">{{ old('company_background_info', $job->company_background_info) }}</x-form.form-textarea>
            </div>
            <div class="employer-job-form__field employer-job-form__field--full">
                <x-form.label for="company_location">Location</x-form.label>
                <x-form.form-input type="text" value="{{ old('location', $job->location) }}" name="location" id="company_location" class="employer-job-form__input w-full rounded-xl" placeholder="e.g. Hybrid, London" />
            </div>
            <div class="employer-job-form__field">
                <x-form.label for="company_city">City</x-form.label>
                <x-form.form-input type="text" value="{{ old('city', $job->city) }}" name="city" id="company_city" class="employer-job-form__input w-full rounded-xl" placeholder="City" />
            </div>
            <div class="employer-job-form__field">
                <x-form.label for="company_post_code">Post code</x-form.label>
                <x-form.form-input type="text" value="{{ old('post_code', $job->post_code) }}" name="post_code" id="company_post_code" class="employer-job-form__input w-full rounded-xl" placeholder="Post code" />
            </div>
            <div class="employer-job-form__field employer-job-form__field--full">
                <x-form.label for="company_address">Address</x-form.label>
                <x-form.form-input type="text" name="address" value="{{ old('address', $job->address) }}" id="company_address" class="employer-job-form__input w-full rounded-xl" placeholder="Company address" />
            </div>
        </div>
    </section>

    <section class="step employer-job-form__step" aria-label="Job description">
        <h2 class="employer-job-form__step-title">Describe the opportunity</h2>
        <div class="employer-job-form__grid grid grid-cols-1 gap-4">
            <div class="employer-job-form__field employer-job-form__field--full">
                <x-form.label for="description">Job description</x-form.label>
                <x-form.form-textarea name="description" id="description" class="employer-job-form__input employer-job-form__input--rich summernote w-full rounded-xl">{{ old('description', $job->description) }}</x-form.form-textarea>
            </div>
            <div class="employer-job-form__field employer-job-form__field--full">
                <x-form.label for="skillset_About">Skills and experience</x-form.label>
                <x-form.form-textarea name="skillset_About" id="skillset_About" class="employer-job-form__input employer-job-form__input--rich summernote w-full rounded-xl">{{ old('skillset_About', $job->skillset_About) }}</x-form.form-textarea>
            </div>
            <div class="employer-job-form__field employer-job-form__field--full">
                <x-form.label for="benefits">Benefits</x-form.label>
                <x-form.form-textarea name="benefits" id="benefits" class="employer-job-form__input employer-job-form__input--rich summernote w-full rounded-xl">{{ old('benefits', $job->benefits) }}</x-form.form-textarea>
            </div>
        </div>
    </section>
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
