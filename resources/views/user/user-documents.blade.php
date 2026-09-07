@extends('layouts.layout')
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
            <form action={{ route('user.store_documents',$user->id) }} method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                    <div class="sm:col-span-2">
                        <x-form.label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Cover Letter</x-form.label>
                        <x-form.form-input value="{{ $user->cover_letter }}" type="file" name="portfolio_link" id="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5  dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="enter your portfolio link"></x-form.form-input>
                        <x-info-box role="alert" class="mt-3 relative flex w-full p-3 text-sm text-white bg-slate-800 rounded-md"> Current CV :{{ $user->cover_letter }} </x-info-box>
                    </div>
                    <div class="sm:col-span-2">
                        <x-form.label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">CV</x-form.label>
                        <x-form.form-input value="{{ $user->cv }}" type="file" name="portfolio_link" id="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5  dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="enter your portfolio link"></x-form.form-input>
                        <x-info-box role="alert" class="mt-3 relative flex w-full p-3 text-sm text-white bg-slate-800 rounded-md"> Current Cover Letter : {{ $user->cover_letter }} </x-info-box>
                    </div>
                </div>
                <div class="sm:col-span-2 mt-6">
                    <x-form.label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Portfolio Link</x-form.label>
                    <x-form.form-input type="text" name="portfolio_link" id="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5  dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="enter your portfolio link"></x-form.form-input>
                    <x-info-box role="alert" class="mt-3 relative flex w-full p-3 text-sm text-white bg-slate-800 rounded-md"> Current Cover Letter : {{ $user->portfolio_link ?? "N/A" }} </x-info-box>
                </div>



                <button type="submit" class="w-96 | mt-6 | text-white bg-green-500 hover:bg-green-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5">
                    Add
                </button>

            </form>
        </div>

    </div>
</div>




@endsection
