<x-layout>
    @push('styles')
    <link rel="stylesheet" href=" {{ URL::asset('css/multi-step-form.css') }}">
    @endpush
    @section('title'," Employer Registeration")
    @section('content')

    <div class="bg-white ">


        @if ($errors->any())
        <div class="mb-4 text-red-600">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="flex h-screen justify-center items-center relative isolate h-lvh   px-6  lg:px-8">
            <div class="w-96 md:w-1/2 lg:w-1/2 xl:w-1/2">
                <h2 class="[ mb-4 text-center ] | text-xl  font-bold text-gray-900 dark:text-black ">New Company Profile Registeration</h2>
                <section id="form-container" class="w-96 md:w-1/2 lg:w-1/2 xl:w-1/2">

                    <div id="steps-bar">
                        <div class="step-indicator active">1</div>
                        <div class="step-indicator">2</div>
                        <div class="step-indicator">3</div>
                    </div>
                    <form action="/employer/create" method="POST" id="multi-step">
                        @csrf
                        <div class="grid gap-4 sm:grid-cols-1 sm:gap-6">
                            <div class="step active">
                                <h2>Company Information</h2>
                                <div class="sm:col-span-2">
                                    <label for="company_name" class="block my-4 text-sm font-medium text-gray-900 dark:text-black">Company Name</label>
                                    <input type="text" name="company_name" id="company_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5  dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type your company name">
                                </div>
                                <div class="sm:col-span-2">
                                    <label for="company_tel" class="block my-4 text-sm font-medium text-gray-900 dark:text-black">Company Tel</label>
                                    <input type="tel" name="company_tel" id="company_tel" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5  dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type your company telephone number">
                                </div>
                                <div class="sm:col-span-2">
                                    <label for="company_size" class="block my-4 text-sm font-medium text-gray-900 dark:text-black">Company Size</label>
                                    <select name="company_size" id="company_size" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5  dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                        <option value="1 - 10">1 - 10</option>
                                        <option value="10 - 25<">10 - 25</option>
                                        <option value="25 - 50">25 - 50 </option>
                                        <option value="50 - 100">50 - 100 </option>
                                        <option value="100+">100+ </option>
                                    </select>
                                </div>
                            </div>
                            <div class="step">
                                <h2>Personal Details</h2>
                                <div class="sm:col-span-2">
                                    <label for="name" class="block my-4 text-sm font-medium text-gray-900 dark:text-black">First Name</label>
                                    <input type="text" name="first_name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5  dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type your first name">
                                </div>
                                <div class="sm:col-span-2">
                                    <label for="name" class="block my-4 text-sm font-medium text-gray-900 dark:text-black">Last Name</label>
                                    <input type="text" name="last_name" id="last_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5  dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type your last name">
                                </div>
                            </div>
                            <div class="step">
                                <h2>Account Details</h2>
                                <div class="sm:col-span-2">
                                    <label for="name" class="block my-4 text-sm font-medium text-gray-900 dark:text-black">Email </label>
                                    <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5  dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type your email address">
                                </div>
                                <div class="sm:col-span-2">
                                    <label for="name" class="block my-4 text-sm font-medium text-gray-900 dark:text-black">Password</label>
                                    <input type="password" name="password" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5  dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type your password">
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
    @endpush
</x-layout>
