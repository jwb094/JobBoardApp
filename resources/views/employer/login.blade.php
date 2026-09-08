@extends('layouts.layout')
@section('title'," Employer Login")
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
            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-black">Login</h2>
            <form action="/employer/login" method="POST">
                @csrf
                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">

                    <div class="sm:col-span-2">
                        <x-form.label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Email</x-form.label>
                        <x-form.form-input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5  dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type your email address" required> </x-form.form-input>
                    </div>
                    <div class="sm:col-span-2">
                        <x-form.label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Password</x-form.label>
                        <x-form.form-input type="password" name="password" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5  dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type your password" required=""></x-form.form-input>
                    </div>

                    <x-form.form-button type="submit" class="w-96 | mt-6 | text-white bg-green-500 hover:bg-green-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5"> Login </x-form.form-button>
            </form>
        </div>

    </div>
</div>


@endsection
