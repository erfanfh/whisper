<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verification Code - Whisper</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="card shadow p-4" style="max-width: 400px; width: 100%;">
        <div class="card-body text-center">
            <h1 class="h4 text-secondary mb-3">Enter Verification Code</h1>
            <p class="text-muted mb-4">We sent a verification code to your email. <br> {{ auth()->user()->email }} <br>
                Please enter it below.</p>

            <form action="{{ route('verify.post')}}" method="POST">
                @csrf
                <div class="mb-3">
                    <input type="text"
                           name="code"
                           class="form-control text-center"
                           placeholder="Enter code"
                           maxlength="6"
                           autocomplete="off">
                </div>
                <div class="text-danger text-start my-2">
                    @error('code')
                    {{ $message }}
                    @enderror
                    @error('email')
                    {{ $message }}
                    @enderror
                    @if(session('error'))
                        {{ session('error') }}
                    @endif
                </div>
                <button type="submit" class="btn btn-outline-secondary w-100 mb-3">Verify</button>
            </form>


            <p class="small">
                Didn't receive the code? <a class="text-secondary" href="#">Resend</a>
            </p>

            <p class="d-inline-flex gap-1">
                <a class="btn btn-link text-primary text-decoration-none" data-bs-toggle="collapse"
                   href="#collapseEmail" role="button" aria-expanded="false" aria-controls="collapseEmail">
                    Change your email address
                </a>
            </p>
            <div class="collapse" id="collapseEmail">
                <div class="card card-body">
                    <form class="d-flex flex-column align-items-start" method="post"
                          action="{{ route('verify.resend') }}">
                        @csrf
                        <div class="d-flex flex-column align-items-start mb-3 w-100">
                            <label for="email" class="form-label text-start">Email address</label>
                            <input name="email" type="email" class="form-control" id="email"
                                   aria-describedby="emailHelp" value="{{ auth()->user()->email }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Change</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
