@extends('layouts.layout')
@section('title', $user->first_name . ' ' . $user->last_name . ' Documents Hub')
@section('content')
<main class="user-documents flex min-h-[calc(100svh-150px)] items-center justify-center px-4 py-8">
    <section class="user-documents__card w-full max-w-xl rounded-3xl p-6 sm:p-9">
        <header class="user-documents__header">
            <span class="user-documents__icon"><i class="fa-solid fa-folder-open" aria-hidden="true"></i></span>
            <p class="user-documents__eyebrow">Applicant profile</p>
            <h1 class="user-documents__title">Your documents</h1>
            <p class="user-documents__description">Keep your application materials up to date and ready to share with employers.</p>
        </header>

        <x-auth.errors />

        <form action="{{ route('user.store_documents', $user->id) }}" method="POST" enctype="multipart/form-data" class="user-documents__form flex flex-col gap-5">
            @csrf

            <div class="user-documents__field">
                <label for="cover_letter">Cover letter</label>
                <input type="file" name="cover_letter" id="cover_letter" class="user-documents__input">
                <p class="user-documents__current">
                    <i class="fa-regular fa-file-lines" aria-hidden="true"></i>
                    Current cover letter:
                    <strong>{{ $user->cover_letter ?: 'Not uploaded' }}</strong>
                </p>
            </div>

            <div class="user-documents__field">
                <label for="cv">CV</label>
                <input type="file" name="cv" id="cv" class="user-documents__input">
                <p class="user-documents__current">
                    <i class="fa-solid fa-file-pdf" aria-hidden="true"></i>
                    Current CV:
                    <strong>{{ $user->cv ?: 'Not uploaded' }}</strong>
                </p>
            </div>

            <div class="user-documents__field">
                <label for="portfolio_link">Portfolio link <span>(optional)</span></label>
                <input type="url" name="portfolio_link" id="portfolio_link" class="user-documents__input" value="{{ old('portfolio_link', $user->portfolio_link) }}" placeholder="https://your-portfolio.com">
                <p class="user-documents__current">
                    <i class="fa-solid fa-link" aria-hidden="true"></i>
                    Add a link to your portfolio or professional work.
                </p>
            </div>

            <button type="submit" class="user-documents__submit w-full rounded-xl px-5 py-3 font-bold">
                Save documents
                <i class="fa-solid fa-arrow-right" aria-hidden="true"></i>
            </button>
        </form>
    </section>
</main>
@endsection
