<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="d-flex flex-column min-vh-100 bg-dark text-white" data-bs-theme="dark">

    <main class="flex-grow-1 d-flex align-items-center justify-content-center p-3 p-md-5">
        <div class="w-100" style="max-width: 400px;">
            <div class="bg-body rounded-3 p-4 p-md-5 shadow">
                <h2 class="text-center fw-bold mb-4">Register</h2>
                <form id="regForm" name="regForm" action="<?= BASE_URL ?>/auth/registering" method="post" onsubmit="return checkForm()">
                    <div class="mb-3">
                        <label for="roleInput" class="form-label">Select Role</label>
                        <select class="form-select form-select-md" id="roleInput" name="roleInput" aria-label=".form-select-sm example">
                            <option value="0">User</option>
                            <option value="1">Admin</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="usernameInput" class="form-label">Username</label>
                        <input type="text" class="form-control" id="usernameInput" name="usernameInput" placeholder="Enter your username" required>
                    </div>
                    <?php if (isset($data['usnErr'])) : ?>
                        <p class="text-danger"><?= $data['usnErr'] ?></p>
                    <?php endif ?>
                    <p class="text-danger" id="usererror"></p>
                    <div class="mb-3">
                        <label for="emailInput" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="emailInput" name="emailInput" aria-describedby="emailHelp" placeholder="Enter your email" required>
                    </div>
                    <?php if (isset($data['emailErr'])) : ?>
                        <p class="text-danger"><?= $data['emailErr'] ?></p>
                    <?php endif ?>
                    <p class="text-danger" id="emailerror"></p>
                    <div class="mb-3">
                        <label for="passwordInput" class="form-label">Password</label>
                        <input type="password" class="form-control" id="passwordInput" name="passwordInput" placeholder="Enter your password" minlength="8" required>
                    </div>
                    <div class="mb-3">
                        <label for="passwordInput2" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="passwordInput2" name="passwordInput2" placeholder="Enter your confirm password" minlength="8" required>
                    </div>
                    <p class="text-danger" id="pw2error"></p>
                    <button type="submit" name="register" class="btn btn-primary w-100">Register</button>
                    <div class="text-center mt-3">
                        <a href="<?= BASE_URL ?>/auth/login" class="text-decoration-none text-secondary">Already have an account? Login</a>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <script>
        const regForm = document.getElementById('regForm');
        const username = document.forms['regForm']['usernameInput'];
        const email = document.forms['regForm']['emailInput'];
        const pw1 = document.forms['regForm']['passwordInput'];
        const pw2 = document.forms['regForm']['passwordInput2'];
        const pw2error = document.getElementById('pw2error');
        const emailerror = document.getElementById('emailerror');
        const usererror = document.getElementById('usererror');

        window.onload = function() {
            regForm.reset();
        }

        $(document).ready(function() {
            if (regForm.length > 0) {
                regForm.reset();
            }
        });

        function checkForm() {

            pw2error.textContent = ''
            emailerror.textContent = ''
            usererror.textContent = ''

            if (email.value.trim().length === 0 || email.value === '') {
                emailerror.textContent = 'Email is empty!';
                return false;
            }

            if (username.value.trim().length === 0 || username.value === '') {
                usererror.textContent = 'User is empty!';
                return false;
            }

            if (pw1.value !== pw2.value) {
                pw2error.textContent = 'Password Confirm does not match!';
                return false;
            }

            return true;
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>