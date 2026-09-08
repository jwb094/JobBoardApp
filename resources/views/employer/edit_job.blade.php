@extends('layouts.layout')
@push('styles')
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap (required for UI) -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- Summernote -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-bs5.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-bs5.min.js"></script>
<link rel="stylesheet" href=" {{ URL::asset('css/multi-step-form.css') }}">


@endpush
@section('title', " Edit ".$job->title."Job Desc")
@section('content')

<div class="bg-white ">

    <div class="flex h-screen justify-center items-center relative isolate h-lvh   px-6  lg:px-8">
        <div class="w-96 md:w-1/2 lg:w-1/2 xl:w-1/2">

            <div class="flex">
                @if ($errors->any())
                <div class="mb-4 text-red-600">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>

            <h2 class="[ mb-4 text-center ] | text-xl  font-bold text-gray-900 dark:text-black ">Edit {{ $job->title }} Job Details</h2>
            <section id="form-container" class="w-96 md:w-1/2 lg:w-1/2 xl:w-1/2">

                <div id="steps-bar">
                    <div class="step-indicator active">1</div>
                    <div class="step-indicator">2</div>
                    <div class="step-indicator">3</div>

                </div>
                <form action="{{ route('employer.updatejobdesc',$job->id) }}" method="POST" id="multi-step">
                    @csrf
                    @method('PUT')
                    <div class="grid gap-4 sm:grid-cols-1 sm:gap-6">
                        <div class="step active">

                            <div class="sm:col-span-2">
                                <x-form.label for="job_title" class="block my-2 text-sm font-medium text-gray-900 dark:text-black">Job Title </x-form.label>
                                {{-- <input type="text" name="title" value="{{ $job->title }}" id="job_title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type your company name"> --}}
                                <x-form.form-input type="text" value="{{ old('title',$job->title) }}" name="title" id="job_title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5  dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type your company name">
                                </x-form.form-input>
                            </div>
                            <div class="sm:col-span-2">
                                <x-form.label for="job_category" class="block my-2 text-sm font-medium text-gray-900 dark:text-black">Category </x-form.label>
                                <select name="category_id" id="job_category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5  dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                    @foreach ($categories as $category)
                                    <option {{ $job->category_id === $category->id ? "selected" : "" }} value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="sm:col-span-2">
                                <x-form.label for="salary_min" class="block my-2 text-sm font-medium text-gray-900 dark:text-black">Minimum Salary </x-form.label>
                                {{-- <input type="number" name="salary_min" value="{{ $job->salary_min }}" id="salary_min" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Enter Minimum Salary Range"> --}}
                                <x-form.form-input type="number" value="{{ old('salary_min',$job->salary_min) }}" name="salary_min" id="salary_min" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5  dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Enter Minimum Salary Range"></x-form.form-input>
                            </div>
                            <div class="sm:col-span-2">
                                <x-form.label for="salary_max" class="block my-2 text-sm font-medium text-gray-900 dark:text-black">Maximum Salary </x-form.label>
                                {{-- <input type="number" name="salary_max" value="{{ $job->salary_max }}" id="salary_max" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Enter Maximum Salary Range"> --}}
                                <x-form.form-input type="number" value="{{ old('salary_max',$job->salary_max) }}" name="salary_max" id="salary_max" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5  dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Enter Maximum Salary Range"></x-form.form-input>
                            </div>
                            <div class="sm:col-span-2">
                                <x-form.label for="job_type" class="block my-2 text-sm font-medium text-gray-900 dark:text-black">Job Type </x-form.label>
                                {{-- <select name="job_type" id="job_type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5  dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                    <option {{ $job->job_type === "full-time" ? "selected" : "" }} value="full-time">Full-time</option>
                                <option {{ $job->job_type === "part-time" ? "selected" : "" }} value="part-time">Part-time</option>
                                <option {{ $job->job_type === "contract" ? "selected" : "" }} value="contract">Contract </option>
                                <option {{ $job->job_type === "remote" ? "selected" : "" }} value="remote">Remote </option>
                                </select> --}}

                                <x-form.select name="job_type" id="job_type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5  dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-primary-500 dark:focus:border-primary-500" :formdata="$jobTypes" :recordFieldData="$job->job_type" fieldname="job_type"> </x-form.select>
                            </div>
                            <div class="sm:col-span-2">
                                <x-form.label for="status" class="block my-2 text-sm font-medium text-gray-900 dark:text-black">Status </x-form.label>
                                {{-- <select name="status" id="status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5  dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                    <option {{ $job->status === 'open' ? "selected" : "" }} value="open">Open</option>
                                <option {{ $job->status === 'closed' ? "selected" : "" }} value="closed">Closed</option>
                                </select> --}}
                                <x-form.select name="status" id="status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5  dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-primary-500 dark:focus:border-primary-500" :formdata="$jobStatuses" recordFieldData="$job->status" fieldname="status"> </x-form.select>
                            </div>
                            <div class="sm:col-span-2">
                                <x-form.label for="job_expiry_date" class="block my-2 text-sm font-medium text-gray-900 dark:text-black">Closing Date:</x-form.label>
                                {{-- <input type="date" value="{{ $job->expires_at->toDateString() }}" name="expires_at" id="job_expiry_date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Please Enter Company Post Code"> --}}
                                <x-form.form-input type="date" name="expires_at" value="{{ old('expires_at',$job->expires_at->toDateString()) }}" id="job_expiry_date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5  dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Please Enter Company  Post Code"> </x-form.form-input>
                            </div>
                        </div>
                        <div class="step">
                            <div class="sm:col-span-2">
                                <x-form.label for="company_Desc" class="block my-2 text-sm font-medium text-gray-900 dark:text-black">Company Background Description</x-form.label>
                                {{-- <textarea name="company_background_info" id="company_Desc" class="summernote">
                                {{ $job->company_background_info }}
                                </textarea> --}}
                                <x-form.form-textarea name="company_background_info" id="company_Desc" class="summernote">
                                    {{ old('company_background_info',$job->company_background_info) }}
                                </x-form.form-textarea>
                            </div>
                            <div class="sm:col-span-2">
                                <x-form.label for="company_location" class="block my-2 text-sm font-medium text-gray-900 dark:text-black">Company Location </x-form.label>
                                {{-- <input type="text" value="{{ $job->location }}" name="location" id="company_location" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Please Enter Company Location"> --}}
                                <x-form.form-input type="text" value="{{ old('location',$job->location) }}" name="location" id="company_location" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5  dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Please Enter Company Location"></x-form.form-input>
                            </div>
                            <div class="sm:col-span-2">
                                <x-form.label for="company_city" class="block my-2 text-sm font-medium text-gray-900 dark:text-black">City </x-form.label>
                                {{-- <input type="text" name="city" value="{{ $job->city }}" id="company_city" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Please Enter Company City"> --}}
                                <x-form.form-input value="{{ old('city',$job->city) }}" type="text" name="city" id="company_city" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5  dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Please Enter Company  City"></x-form.form-input>
                            </div>
                            <div class="sm:col-span-2">
                                <x-form.label for="company_address" class="block my-2 text-sm font-medium text-gray-900 dark:text-black">Address </x-form.label>
                                {{-- <input type="text" value="{{ $job->address }}" name="address" id="company_address" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Please Enter Company Address"> --}}
                                <x-form.form-input type="text" name="address" value="{{ old('address',$job->address) }}" id="company_address" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5  dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Please Enter Company  Address"> </x-form.form-input>
                            </div>
                            <div class="sm:col-span-2">
                                <x-form.label for="company_address" class="block my-2 text-sm font-medium text-gray-900 dark:text-black">Post Code </x-form.label>
                                {{-- <input type="text" value="{{ $job->post_code }}" name="post_code" id="company_post_code" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Please Enter Company Post Code"> --}}
                                <x-form.form-input value="{{ old('post_code',$job->post_code) }}" type="text" name="post_code" id="company_post_code" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5  dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Please Enter Company  Post Code"> </x-form.form-input>
                            </div>



                        </div>
                        <div class="step">
                            <div class="sm:col-span-2">
                                <x-form.label for="description" class="block my-2 text-sm font-medium text-gray-900 dark:text-black">Job Description </x-form.label>
                                {{-- <textarea name="description" id="description" class="summernote">
                                {{ $job->description }}
                                </textarea> --}}
                                <x-form.form-textarea name="description" id="description" class="summernote">
                                    {{ old('description',$job->description) }}
                                </x-form.form-textarea>
                            </div>
                            <div class="sm:col-span-2">
                                <x-form.label for="skillset_About" class="block my-2 text-sm font-medium text-gray-900 dark:text-black">Skillset </x-form.label>
                                {{-- <textarea name="skillset_About" id="skillset_About" class="summernote">
                                {{ $job->skillset_About }}
                                </textarea> --}}
                                <x-form.form-textarea name="skillset_About" id="skillset_About" class="summernote">
                                    {{ old('skillset_About',$job->skillset_About) }}
                                </x-form.form-textarea>
                            </div>
                            <div class="sm:col-span-2">
                                <x-form.label for="benefits" class="block my-2 text-sm font-medium text-gray-900 dark:text-black">Benefits </x-form.label>
                                {{-- <textarea name="benefits" id="benefits" class="summernote">
                                {{ $job->benefits }}
                                </textarea> --}}
                                <x-form.form-textarea name="benefits" id="benefits" class="summernote">{{ old('benefits',$job->benefits) }} </x-form.form-textarea>
                            </div>



                        </div>

                    </div>

                    <div class="buttons">
                        <x-form.form-button class="w-20 | mt-6 | text-white bg-green-500 hover:bg-green-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm py-2" type="button" id="previousBtn" onclick="prevStep()">Previous</x-form.form-button>
                        <x-form.form-button class="w-20 | mt-6 | text-white bg-green-500 hover:bg-green-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm py-2" type="button" id="nextBtn" onclick="nextStep()">Next</x-form.form-button>
                        <x-form.form-button class="w-20 | mt-6 | text-white bg-green-500 hover:bg-green-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm py-2" type="submit" id="submitBtn" style="display: none;">submit</x-form.form-button>
                    </div>
        </div>
        </form>
        </section>
    </div>

</div>
</div>




@endsection
@push('other-scripts')
<script src="{{ URL::asset('js/multi-step-form.js') }}"></script>
<script>
    $(document).ready(function() {
        $('.summernote').summernote({
            height: 75
            , placeholder: 'Write something...'
            , toolbar: [
                ['style', ['bold', 'italic', 'underline']]
                , ['para', ['ul', 'ol']]
                , ['insert', ['link']]
                , ['view', ['codeview']]
            ]
        });
    });

</script>
@endpush
