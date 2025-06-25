<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" xintegrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Google Fonts - Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #e0f2f7; /* Light Blue background for a fresh look */
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .card {
            border-radius: 1rem; /* Rounded corners for the card */
        }
        .btn-success {
            background-color: #28a745; /* Bootstrap success green */
            border-color: #28a745;
        }
        .btn-success:hover {
            background-color: #218838; /* Darker green on hover */
            border-color: #1e7e34;
        }
        .form-control:focus {
            border-color: #86b7fe;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }
    </style>
</head>
<body>
    <div class="card p-5 shadow-lg" style="width: 100%; max-width: 480px;">
        <h2 class="text-center mb-4 fs-3 fw-bold text-dark">Register New User</h2>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('error') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?php if (session('errors')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <h6>Validation Errors:</h6>
                <ul>
                    <?php foreach (session('errors') as $error): ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach; ?>
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('register') ?>" method="post">
            <?= csrf_field() ?>
            <div class="mb-3">
                <label for="name" class="form-label fw-semibold text-secondary">Full Name:</label>
                <input type="text" id="name" name="name" value="<?= old('name') ?>"
                       class="form-control <?= (session('errors.name')) ? 'is-invalid' : '' ?>"
                       placeholder="Enter your full name" required>
                <?php if (session('errors.name')): ?><div class="invalid-feedback"><?= session('errors.name') ?></div><?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label fw-semibold text-secondary">Email address:</label>
                <input type="email" id="email" name="email" value="<?= old('email') ?>"
                       class="form-control <?= (session('errors.email')) ? 'is-invalid' : '' ?>"
                       placeholder="Enter your email" required>
                <?php if (session('errors.email')): ?><div class="invalid-feedback"><?= session('errors.email') ?></div><?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label fw-semibold text-secondary">Phone (Optional):</label>
                <input type="text" id="phone" name="phone" value="<?= old('phone') ?>"
                       class="form-control <?= (session('errors.phone')) ? 'is-invalid' : '' ?>"
                       placeholder="Enter your phone number">
                <?php if (session('errors.phone')): ?><div class="invalid-feedback"><?= session('errors.phone') ?></div><?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label fw-semibold text-secondary">Password:</label>
                <input type="password" id="password" name="password"
                       class="form-control <?= (session('errors.password')) ? 'is-invalid' : '' ?>"
                       placeholder="Enter password" required>
                <?php if (session('errors.password')): ?><div class="invalid-feedback"><?= session('errors.password') ?></div><?php endif; ?>
            </div>
            <div class="mb-4">
                <label for="pass_confirm" class="form-label fw-semibold text-secondary">Confirm Password:</label>
                <input type="password" id="pass_confirm" name="pass_confirm"
                       class="form-control <?= (session('errors.pass_confirm')) ? 'is-invalid' : '' ?>"
                       placeholder="Confirm password" required>
                <?php if (session('errors.pass_confirm')): ?><div class="invalid-feedback"><?= session('errors.pass_confirm') ?></div><?php endif; ?>
            </div>
            <div class="d-grid gap-2 mb-3">
                <button type="submit" class="btn btn-success btn-lg">
                    Register
                </button>
            </div>
            <div class="text-center">
                Already have an account? <a href="<?= base_url('login') ?>" class="text-decoration-none">Login here</a>
            </div>
        </form>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" xintegrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
