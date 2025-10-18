<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="d-flex flex-column min-vh-100 bg-dark text-white" data-bs-theme="dark">
    <!-- <header class="bg-body-secondary py-3 px-3 px-md-5 d-flex justify-content-between align-items-center">
    <div class="d-flex align-items-center gap-4">
      <div class="fs-3 fw-bold">RatingFilm</div>
    </div>
  </header> -->

    <main class="flex-grow-1 d-flex align-items-center justify-content-center p-3 p-md-5">
        <div class="w-100" style="max-width: 400px;">
            <div class="bg-body rounded-3 p-4 p-md-5 shadow">
                <h2 class="text-center fw-bold mb-4">Login</h2>
                <form id="logForm" name="logForm" action="<?= BASE_URL ?>/auth/logining" method="post">
                    <div class="mb-3">
                        <label for="emailInput" class="form-label">Email</label>
                        <input type="email" class="form-control" id="emailInput" name="emailInput" aria-describedby="emailHelp" placeholder="Enter your email" required>
                    </div>
                    <?php if (isset($data['emailErr'])) : ?>
                        <p class="text-danger"><?= $data['emailErr'] ?></p>
                    <?php endif ?>
                    <div class="mb-3">
                        <label for="passwordInput" class="form-label">Password</label>
                        <input type="password" class="form-control" id="passwordInput" name="passwordInput" placeholder="Enter your password" minlength="8" required>
                    </div>
                    <?php if (isset($data['passErr'])) : ?>
                        <p class="text-danger"><?= $data['passErr'] ?></p>
                    <?php endif ?>
                    <button type="submit" class="btn btn-primary w-100">Login</button>
                    <!-- <div class="text-center mt-3">
            <a href="#" class="text-decoration-none text-secondary">Forgot password?</a>
          </div> -->
                    <div class="text-center mt-2">
                        <a href="<?= BASE_URL ?>/auth/register" class="text-decoration-none text-secondary">Don't have an account? Register</a>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <!-- <footer class="py-3 px-3 px-md-5 d-flex align-items-center gap-3 flex-wrap bg-body-secondary">
    <div class="fs-6">RatingFilm</div>
    <span class="text-body-secondary">© 2025 RatingFilm, Inc.</span>
  </footer> -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>