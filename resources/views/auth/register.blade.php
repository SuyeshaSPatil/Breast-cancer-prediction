<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>🩺 Register | Breast Cancer Detection</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />

  <style>
    body {
      background: linear-gradient(to top right, #ec4899, #c084fc);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .register-card {
      border: 2px solid #db2777;
      border-radius: 20px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
      position: relative;
      padding: 2rem;
      background: #fff;
    }
    .ribbon-img {
      width: 80px;
      height: 80px;
      position: absolute;
      top: -40px;
      left: 50%;
      transform: translateX(-50%);
      animation: pulse 1.5s infinite;
    }
    @keyframes pulse {
      0%, 100% {
        transform: scale(1);
      }
      50% {
        transform: scale(1.1);
      }
    }
    .form-label {
      color: #db2777;
    }
    .btn-primary {
      background-color: #db2777;
      border-color: #db2777;
    }
    .btn-primary:hover {
      background-color: #9d174d;
      border-color: #9d174d;
    }
  </style>
</head>
<body>

<div class="container">
  <div class="register-card col-md-6 mx-auto text-center">
    <img src="https://cdn-icons-png.flaticon.com/512/188/188987.png" alt="Breast Cancer Ribbon" class="ribbon-img">

    <h2 class="mt-5 fw-bold text-pink-600">Join the Breast Cancer Detection Initiative 🩺</h2>
    <p class="text-muted mb-4">Create your account and start using AI for early detection</p>

    <form method="POST" action="{{ route('register') }}" class="space-y-4" novalidate>
      <!-- CSRF Token for Laravel (if used) -->
      @csrf

      <!-- Full Name -->
      <div class="mb-3 text-start">
        <label class="form-label text-pink-600">Full Name</label>
        <input type="text" name="name" class="form-control" placeholder="John Doe" required>
        <div class="invalid-feedback">Please enter your full name.</div>
      </div>

      <!-- Email -->
      <div class="mb-3 text-start">
        <label class="form-label text-pink-600">Email</label>
        <input type="email" name="email" class="form-control" placeholder="you@example.com" required>
        <div class="invalid-feedback">Please enter a valid email address.</div>
      </div>

      <!-- Mobile Number -->
      <div class="mb-3 text-start">
        <label class="form-label text-pink-600">Mobile Number</label>
        <input type="tel" name="mobile" class="form-control" pattern="[6-9]{1}[0-9]{9}" placeholder="9876543210" required>
        <div class="invalid-feedback">Enter a valid 10-digit mobile number starting with 6-9.</div>
      </div>

      <!-- Password -->
      <div class="mb-3 text-start">
        <label class="form-label text-pink-600">Password</label>
        <input type="password" name="password" class="form-control" minlength="6" placeholder="********" required>
        <div class="invalid-feedback">Password must be at least 6 characters.</div>
      </div>

      <!-- Confirm Password -->
      <div class="mb-3 text-start">
        <label class="form-label text-pink-600">Confirm Password</label>
        <input type="password" name="password_confirmation" class="form-control" placeholder="********" required>
        <div class="invalid-feedback">Please confirm your password.</div>
      </div>

      <!-- Submit -->
      <button type="submit" class="btn btn-primary w-100 shadow-sm">
        🩺 Start Your Journey to Early Detection
      </button>
    </form>

    <p class="mt-4 text-muted small">
      Already have an account?
      <a href="/login" class="text-decoration-none text-pink-600">Login here</a>
    </p>
  </div>
</div>

<!-- Bootstrap JS + Validation Script -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
  // Bootstrap validation script
  (() => {
    'use strict';
    const forms = document.querySelectorAll('.needs-validation');
    Array.from(forms).forEach(form => {
      form.addEventListener('submit', event => {
        if (!form.checkValidity()) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  })();
</script>

</body>
</html>
