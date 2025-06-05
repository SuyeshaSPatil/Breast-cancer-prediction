<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🩺 Breast Cancer Detection - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kalam&display=swap" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to top right, #ec4899, #c084fc);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Poppins', sans-serif;
        }
        .login-card {
            border-radius: 20px;
            background-color: white;
            padding: 3rem 2rem;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
            width: 100%;
            max-width: 450px;
            position: relative;
            text-align: center;
        }
        .login-card .logo {
            width: 80px;
            height: 80px;
            margin-bottom: 1rem;
            animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }
        .form-label {
            color: #ec4899;
        }
        .btn-primary {
            background-color: #ec4899;
            border-color: #ec4899;
        }
        .btn-primary:hover {
            background-color: #db2777;
            border-color: #db2777;
        }
        .form-check-label {
            color: #6b7280;
        }
    </style>
</head>
<body>

<div class="login-card">
    <img src="https://cdn-icons-png.flaticon.com/512/188/188987.png" alt="Breast Cancer Ribbon" class="logo">

    <h2 class="fw-bold text-pink-600">Breast Cancer AI Panel</h2>
    <p class="text-muted mb-4">Login to access your dashboard</p>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email -->
        <div class="mb-3 text-start">
            <label class="form-label">Email</label>
            <input type="email" class="form-control" name="email" required placeholder="you@example.com">
        </div>

        <!-- Password -->
        <div class="mb-3 text-start">
            <label class="form-label">Password</label>
            <input type="password" class="form-control" name="password" required placeholder="********">
        </div>

        <!-- Remember me and Forgot password -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="rememberMe" name="remember">
                <label class="form-check-label" for="rememberMe">Remember me</label>
            </div>
            <a href="#" class="text-decoration-none text-pink-600 small">Forgot password?</a>
        </div>

        <!-- Submit -->
        <button type="submit" class="btn btn-primary w-100 shadow-sm">
            🩺 Access Dashboard
        </button>
    </form>

    <p class="mt-4 text-muted small">
        Don’t have an account?
        <a href="/register" class="text-decoration-none text-pink-600">Register here</a>
    </p>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
