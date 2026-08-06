<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin sign in — ISCME 2027</title>
    @vite(['resources/scss/app.scss', 'resources/js/admin.js'])
</head>
<body class="min-vh-100 d-flex align-items-center py-5" style="background: linear-gradient(135deg, #071e3d, #003d6c);">
    <main class="container" style="max-width: 440px;">
        <section class="card border-0 shadow-lg rounded-4 overflow-hidden">
            <div class="card-body p-4 p-md-5">
                <p class="text-uppercase fw-bold small mb-2" style="letter-spacing: .14em; color: #1a73e8;">ISCME 2027</p>
                <h1 class="h3 fw-bold mb-2" style="color: #003d6c;">Administration panel</h1>
                <p class="text-muted mb-4">Sign in to manage the conference website.</p>

                @if (session('status'))
                    <div class="alert alert-success">{{ session('status') }}</div>
                @endif

                <form method="POST" action="{{ route('admin.login.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold">Email address</label>
                        <input id="email" name="email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" value="{{ old('email') }}" autocomplete="email" required autofocus>
                        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-4">
                        <label for="password" class="form-label fw-semibold">Password</label>
                        <input id="password" name="password" type="password" class="form-control form-control-lg" autocomplete="current-password" required>
                    </div>
                    <div class="form-check mb-4">
                        <input id="remember" name="remember" type="checkbox" class="form-check-input" value="1">
                        <label for="remember" class="form-check-label">Keep me signed in</label>
                    </div>
                    <button class="btn btn-primary btn-lg w-100 fw-semibold" type="submit">Sign in securely</button>
                </form>
            </div>
        </section>
        <p class="text-center text-white-50 small mt-4 mb-0">ISCME conference management system</p>
    </main>
</body>
</html>
