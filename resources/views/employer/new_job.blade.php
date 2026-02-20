<x-layout>
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
    @section('title'," New Job Desc")
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

                <h2 class="[ mb-4 text-center ] | text-xl  font-bold text-gray-900 dark:text-black ">New Job</h2>
                <section id="form-container" class="w-96 md:w-1/2 lg:w-1/2 xl:w-1/2">

                    <div id="steps-bar">
                        <div class="step-indicator active">1</div>
                        <div class="step-indicator">2</div>
                        <div class="step-indicator">3</div>

                    </div>
                    <form action="{{ route('employer.newjobdesc') }}" method="POST" id="multi-step">
                        @csrf
                        <div class="grid gap-4 sm:grid-cols-1 sm:gap-6">
                            <div class="step active">

                                <div class="sm:col-span-2">
                                    <label for="job_title" class="block my-2 text-sm font-medium text-gray-900 dark:text-black">Job Title</label>
                                    <input type="text" name="title" id="job_title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5  dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type your company name">
                                </div>
                                <div class="sm:col-span-2">
                                    <label for="job_category" class="block my-2 text-sm font-medium text-gray-900 dark:text-black">Job Status </label>
                                    <select name="category_id" id="job_category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5  dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                        @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="sm:col-span-2">
                                    <label for="salary_min" class="block my-2 text-sm font-medium text-gray-900 dark:text-black">Minimum Salary </label>
                                    <input type="tel" name="salary_min" id="salary_min" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5  dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Enter Minimum Salary Range">
                                </div>
                                <div class="sm:col-span-2">
                                    <label for="salary_max" class="block my-2 text-sm font-medium text-gray-900 dark:text-black">Maximum Salary </label>
                                    <input type="tel" name="salary_max" id="salary_max" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5  dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Enter Maximum Salary Range">
                                </div>
                                <div class="sm:col-span-2">
                                    <label for="job_type" class="block my-2 text-sm font-medium text-gray-900 dark:text-black">Job Type </label>
                                    <select name="job_type" id="job_type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5  dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                        <option value="Full-time">Full-time</option>
                                        <option value="Part-time">Part-time</option>
                                        <option value="Contract">Contract</option>
                                        <option value="Remote">Remote</option>
                                    </select>
                                </div>
                                <div class="sm:col-span-2">
                                    <label for="status" class="block my-2 text-sm font-medium text-gray-900 dark:text-black">Job Status </label>
                                    <select name="status" id="status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5  dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                        <option value="open">Open</option>
                                        <option value="closed">Closed</option>
                                    </select>
                                </div>
                                <div class="sm:col-span-2">
                                    <label for="job_expiry_date" class="block my-2 text-sm font-medium text-gray-900 dark:text-black">Closing Date:</label>
                                    <input type="date" name="expires_at" id="job_expiry_date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5  dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Please Enter Company  Post Code">
                                </div>
                            </div>
                            <div class="step">
                                <div class="sm:col-span-2">
                                    <label for="company_Desc" class="block my-2 text-sm font-medium text-gray-900 dark:text-black">Company Background Description :</label>
                                    <textarea name="company_background_info" id="company_Desc" class="summernote"></textarea>
                                </div>
                                <div class="sm:col-span-2">
                                    <label for="company_location" class="block my-2 text-sm font-medium text-gray-900 dark:text-black">Location :</label>
                                    <input type="text" name="location" id="company_location" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5  dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Please Enter Company Location">

                                </div>
                                <div class="sm:col-span-2">
                                    <label for="company_city" class="block my-2 text-sm font-medium text-gray-900 dark:text-black">City :</label>
                                    <input type="text" name="city" id="company_city" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5  dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Please Enter Company  City">
                                </div>
                                <div class="sm:col-span-2">
                                    <label for="company_address" class="block my-2 text-sm font-medium text-gray-900 dark:text-black">Address:</label>
                                    <input type="text" name="address" id="company_address" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5  dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Please Enter Company  Address">
                                </div>
                                <div class="sm:col-span-2">
                                    <label for="company_post_code" class="block my-2 text-sm font-medium text-gray-900 dark:text-black">Post Code:</label>
                                    <input type="text" name="post_code" id="company_post_code" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5  dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Please Enter Company  Post Code">
                                </div>





                            </div>
                            <div class="step">
                                <div class="sm:col-span-2">
                                    <label for="company_tel" class="block my-4 text-sm font-medium text-gray-900 dark:text-black">Job Description </label>
                                    <textarea name="description" id="description" class="summernote"></textarea>
                                </div>
                                <div class="sm:col-span-2">
                                    <label for="salary_max" class="block my-4 text-sm font-medium text-gray-900 dark:text-black">Skillset </label>
                                    <textarea name="skillset_About" id="skillset_About" class="summernote">

                                    </textarea>
                                </div>
                                <div class="sm:col-span-2">
                                    <label for="salary_max" class="block my-4 text-sm font-medium text-gray-900 dark:text-black">Benefits</label>
                                    <textarea name="benefits" id="benefits" class="summernote"></textarea>
                                </div>



                            </div>

                        </div>

                        <div class="buttons">
                            <button class="w-20 | mt-6 | text-white bg-green-500 hover:bg-green-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm py-2" type="button" id="previousBtn" onclick="prevStep()">Previous</button>
                            <button class="w-20 | mt-6 | text-white bg-green-500 hover:bg-green-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm py-2" type="button" id="nextBtn" onclick="nextStep()">Next</button>
                            <button class="w-20 | mt-6 | text-white bg-green-500 hover:bg-green-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm py-2" type="submit" id="submitBtn" style="display: none;">submit</button>
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
</x-layout>
