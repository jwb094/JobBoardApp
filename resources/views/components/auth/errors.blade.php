@if ($errors->any())
    <div class="auth__errors flex items-start gap-3 rounded-2xl p-4 sm:p-5" role="alert">
        <span class="auth__errors-icon mt-0.5 inline-flex shrink-0 items-center justify-center rounded-full" aria-hidden="true">
            <i class="fa-solid fa-exclamation" aria-hidden="true"></i>
        </span>
        <div class="auth__errors-content min-w-0">
            <h2 class="auth__errors-title">Please review the following</h2>
            <ul class="auth__errors-list">
                @foreach ($errors->all() as $error)
                    <li class="auth__errors-item">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif
