<x-layout>
    @section('title',$user->first_name." ". $user->last_name." Dashboard")
    @section('content')

    <div class="bg-white ">
        <div class=" h-screen relative isolate h-lvh   px-6  lg:px-8">


            <section class="bg-neutral-primary">
                <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16">
                    <div class="bg-neutral-secondary-soft border border-default rounded-base p-8 md:p-12 mb-8">
                        <h1 class="text-heading tracking-tighter text-3xl md:text-5xl font-bold my-6"> Personal Details</h1>
                        <a href="/user/edit/{{ $user->id }}" type="button" class="inline-flex items-center justify-center text-black bg-brand hover:bg-brand-strong box-border border border-transparent focus:ring-4 focus:ring-brand-medium shadow-xs font-medium rounded-base text-base px-5 py-3 focus:outline-none">
                            Update your Personal Details
                            <svg class="w-4 h-4 ms-1.5 -me-0.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12H5m14 0-4 4m4-4-4-4" /></svg>
                        </a>
                    </div>
                    <div class="grid md:grid-cols-3 gap-8">
                        <div class="bg-neutral-secondary-soft border border-default rounded-base p-8 md:p-12">
                            <span class="inline-flex items-center bg-brand-softer border border-brand-subtle text-fg-brand-strong text-xs font-medium px-1.5 py-0.5 rounded-sm">
                                <svg class="w-3 h-3 me-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 7h.01m3.486 1.513h.01m-6.978 0h.01M6.99 12H7m9 4h2.706a1.957 1.957 0 0 0 1.883-1.325A9 9 0 1 0 3.043 12.89 9.1 9.1 0 0 0 8.2 20.1a8.62 8.62 0 0 0 3.769.9 2.013 2.013 0 0 0 2.03-2v-.857A2.036 2.036 0 0 1 16 16Z" /></svg>
                                <h4 class="text-heading text-3xl font-semobild my-4">Applications</h4>
                            </span>
                            @if ($savedApplicationsCount === 0)
                            <p class=" font-normal text-body mb-4">You curretly haven't applied anywhere get started</p>
                            @endif
                            @if ($savedApplicationsCount > 0)
                            <p class=" font-normal text-body mb-4"> You have applied to {{ $savedApplicationsCount }} vacant roles</p>
                            @endif
                            @if ($savedApplicationsCount > 0)
                            <a href="/user/{{ $user->id }}/applications" class="text-fg-brand hover:underline font-medium text-lg inline-flex items-center">View your applications
                                <svg class="w-6 h-6 rtl:rotate-180 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12H5m14 0-4 4m4-4-4-4" /></svg>
                            </a>
                            @endif
                        </div>
                        <div class="bg-neutral-secondary-soft border border-default rounded-base p-8 md:p-12">
                            <span class="inline-flex items-center bg-brand-softer border border-brand-subtle text-fg-brand-strong text-xs font-medium px-1.5 py-0.5 rounded-sm">
                                <svg class="w-3 h-3 me-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 7h.01m3.486 1.513h.01m-6.978 0h.01M6.99 12H7m9 4h2.706a1.957 1.957 0 0 0 1.883-1.325A9 9 0 1 0 3.043 12.89 9.1 9.1 0 0 0 8.2 20.1a8.62 8.62 0 0 0 3.769.9 2.013 2.013 0 0 0 2.03-2v-.857A2.036 2.036 0 0 1 16 16Z" /></svg>
                                <h4 class="text-heading text-3xl font-semobild my-4">Saved Jobs</h4>
                            </span>
                            @if ($savedJobsCount === 0)
                            <p class=" font-normal text-body mb-4">You curretly haven't applied anywhere get started</p>
                            @endif
                            @if ($savedJobsCount > 0)
                            <p class=" font-normal text-body mb-4"> You have {{ $savedJobsCount }} saved Job roles</p>
                            @endif
                            @if ($savedJobsCount > 0)
                            <a href="/user/{{ $user->id }}/savedjobs" class="text-fg-brand hover:underline font-medium text-lg inline-flex items-center">View your saved Jobs
                                <svg class="w-6 h-6 rtl:rotate-180 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12H5m14 0-4 4m4-4-4-4" /></svg>
                            </a>
                            @endif
                        </div>
                        <div class="bg-neutral-secondary-soft border border-default rounded-base p-8 md:p-12">
                            <span class="inline-flex items-center bg-brand-softer border border-brand-subtle text-fg-brand-strong text-xs font-medium px-1.5 py-0.5 rounded-sm">
                                <svg class="w-3 h-3 me-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m8 8-4 4 4 4m8 0 4-4-4-4m-2-3-4 14" /></svg>
                                Your documents
                            </span>
                            <a href="/user/{{ $user->id }}/documents" class="text-fg-brand hover:underline font-medium text-lg inline-flex items-center">Read more
                                <svg class="w-6 h-6 rtl:rotate-180 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12H5m14 0-4 4m4-4-4-4" /></svg>
                            </a>
                        </div>
                    </div>
                </div>
            </section>

        </div>
    </div>

    @endsection

</x-layout>
