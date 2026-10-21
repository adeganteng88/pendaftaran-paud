<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem PAUD</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome Icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Animate.css untuk Animasi -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <style>
        body {
            background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Poppins', sans-serif;
        }
        .card-login {
            border: none;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
            backdrop-filter: blur(10px);
        }
        .form-control {
            border-radius: 10px;
            padding: 12px 15px;
            transition: all 0.3s ease;
        }
        .form-control:focus {
            box-shadow: 0 0 10px rgba(78, 115, 223, 0.5);
            border-color: #4e73df;
        }
        .btn-custom {
            border-radius: 10px;
            padding: 12px;
            font-weight: 600;
            background: #4e73df;
            border: none;
            transition: all 0.3s ease;
        }
        .btn-custom:hover {
            background: #2e59d9;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(78, 115, 223, 0.4);
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5 col-lg-4">
            <!-- Animasi Card Muncul -->
            <div class="card card-login bg-white p-4 animate__animated animate__zoomIn">
                <div class="text-center mb-4">
                    <div class="avatar-icon bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3 animate__animated animate__bounceIn animate__delay-1s" style="width: 70px; height: 70px;">
                        <i class="fa-solid fa-user-shield fa-2x"></i>
                    </div>
                    <h4 class="fw-bold text-dark mb-1">Login Sistem PAUD</h4>
                    <p class="text-muted small">Masukan username & password admin</p>
                </div>

                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show small animate__animated animate__shakeX" role="alert">
                        <i class="fa-solid fa-circle-exclamation me-1"></i> {{ $errors->first() }}
                    </div>
                @endif

                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label text-secondary small fw-semibold">Username</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0 rounded-start-3 text-muted"><i class="fa-solid fa-user"></i></span>
                            <input type="text" name="username" class="form-control border-start-0" placeholder="Ketik username" required autofocus>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label text-secondary small fw-semibold">Password</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0 rounded-start-3 text-muted"><i class="fa-solid fa-lock"></i></span>
                            <input type="password" name="password" class="form-control border-start-0" placeholder="Ketik password" required>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 btn-custom mb-3">
                        Masuk Sistem <i class="fa-solid fa-arrow-right-to-bracket ms-1"></i>
                    </button>
                    
                    <div class="text-center">
                        <a href="{{ route('pendaftaran.form') }}" class="text-decoration-none small text-muted"><i class="fa-solid fa-arrow-left me-1"></i> Kembali ke Form Pendaftaran</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>