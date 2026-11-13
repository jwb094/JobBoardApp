@extends('layouts.layout')
@section('title', $user->first_name . ' ' . $user->last_name . ' Documents Hub')
@section('content')
<main class="documents-page">
    <section class="documents-card">
        <header class="documents-header">
            <span class="documents-icon"><i class="fa-solid fa-folder-open" aria-hidden="true"></i></span>
            <p class="dashboard-eyebrow">Applicant profile</p>
            <h1>Your documents</h1>
            <p>Keep your application materials up to date and ready to share with employers.</p>
        </header>

        @if ($errors->any())
            <ul class="auth-errors" role="alert">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <form action="{{ route('user.store_documents', $user->id) }}" method="POST" enctype="multipart/form-data" class="documents-form">
            @csrf

            <div class="document-field">
                <label for="cover_letter">Cover letter</label>
                <input type="file" name="cover_letter" id="cover_letter">
                <p class="document-current">
                    <i class="fa-regular fa-file-lines" aria-hidden="true"></i>
                    Current cover letter:
                    <strong>{{ $user->cover_letter ?: 'Not uploaded' }}</strong>
                </p>
            </div>

            <div class="document-field">
                <label for="cv">CV</label>
                <input type="file" name="cv" id="cv">
                <p class="document-current">
                    <i class="fa-solid fa-file-pdf" aria-hidden="true"></i>
                    Current CV:
                    <strong>{{ $user->cv ?: 'Not uploaded' }}</strong>
                </p>
            </div>

            <div class="document-field">
                <label for="portfolio_link">Portfolio link <span>(optional)</span></label>
                <input type="url" name="portfolio_link" id="portfolio_link" value="{{ old('portfolio_link', $user->portfolio_link) }}" placeholder="https://your-portfolio.com">
                <p class="document-current">
                    <i class="fa-solid fa-link" aria-hidden="true"></i>
                    Add a link to your portfolio or professional work.
                </p>
            </div>

            <button type="submit" class="auth-submit documents-submit">
                Save documents
                <i class="fa-solid fa-arrow-right" aria-hidden="true"></i>
            </button>
        </form>
    </section>
</main>
@endsection
