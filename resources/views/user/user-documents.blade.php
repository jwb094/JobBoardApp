<x-layout>
    @section('title',$user->first_name ." ".$user->last_name ." Documents Hub")
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
            <div class="w-96">
                <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-black">Your Documents</h2>
                <form action="/user/{{ $user->id }}/store_documents" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                        <div class="sm:col-span-2">
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Cover Letter</label>
                            <input value="{{ $user->cover_letter }}" type="file" name="cover_letter" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5  dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        </div>
                        <div class="sm:col-span-2">
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">CV</label>
                            <input value="{{ $user->cv }}" type="file" name="cv" id="cv" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5  dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        </div>
                        <div class="sm:col-span-2">
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Portfolio Link </label>
                            <input value="{{ $user->portfolio_link }}" type="text" name="portfolio_link" id="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5  dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="enter your portfolio link">
                        </div>



                        <button type="submit" class="w-96 | mt-6 | text-white bg-green-500 hover:bg-green-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5">
                            Add
                        </button>

                </form>
            </div>

        </div>
    </div>




    @endsection

</x-layout>
