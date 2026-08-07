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
                    <div class="mb-3">
                        <label for="password" class="form-label fw-semibold">Password</label>
                        <input id="password" name="password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" autocomplete="current-password" required>
                        @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-4 p-3 rounded-3 bg-light border">
                        <label for="captcha_answer" class="form-label fw-semibold d-flex justify-content-between align-items-center mb-2">
                            <span>Security verification</span>
                            <span class="badge bg-primary text-white fs-6 px-3 py-1 rounded-pill">{{ $captchaQuestion ?? 'What is 5 + 3?' }}</span>
                        </label>
                        <input id="captcha_answer" name="captcha_answer" type="number" class="form-control form-control-lg @error('captcha_answer') is-invalid @enderror" placeholder="Enter answer" required>
                        @error('captcha_answer')<div class="invalid-feedback">{{ $message }}</div>@enderror
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
