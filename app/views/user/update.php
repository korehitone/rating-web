<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
</head>

<body class="d-flex flex-column min-vh-100 bg-dark text-white" data-bs-theme="dark">
    <!-- </bodyclass>
    <header class="bg-body-secondary py-3 px-3 px-md-5 d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center gap-4">
            <div class="fs-3 fw-bold">RatingFilm</div>
            <nav class="d-flex align-items-center gap-4">

            </nav>
        </div>
        <a href="#" class="btn btn-outline-secondary rounded-pill px-3">Sign Out</a>
    </header> -->

    <main class="flex-grow-1 d-flex align-items-center justify-content-center p-3 p-md-5">
        <div class="w-100" style="max-width: 450px;">
            <div class="bg-body rounded-3 p-4 p-md-5 shadow">
                <h2 class="text-center fw-bold mb-4">Edit Profile</h2>
                <form id="editProfileForm" enctype="multipart/form-data" action="<?= BASE_URL ?>/user/update" method="post" onsubmit="return checkForm()">
                    <!-- Profile Picture -->
                    <div class="mb-4 text-center">
                        <img id="pfpPreview" src="" alt="Profile Picture" class="mb-2 rounded-circle" width="160" height="160">
                        <br>
                        <input type="file" class="form-control form-control-sm mt-2" id="pictInput" name="pictInput" accept="image/gif, image/jpeg, image/jpg, image/png">
                        <small class="text-muted">Upload a new profile picture (optional)</small>
                    </div>
                    <p class="text-danger" id="imgerr"></p>

                    <!-- Username -->
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Enter new username" value="<?= $_SESSION['user']['username'] ?>">
                    </div>
                    <p class="text-danger" id="usnerr"></p>

                    <button type="Submit" class="btn btn-primary w-100">Save Changes</button>
                    <div class="text-center mt-3">
                        <a href="<?= BASE_URL ?>/user" class="text-decoration-none text-secondary">← Back to Profile</a>
                    </div>
            </div>
            </form>
        </div>
    </main>


    <!-- <footer class="py-3 px-3 px-md-5 d-flex align-items-center gap-3 flex-wrap bg-body-secondary">
        <div class="fs-6">RatingFilm</div>
        <span class="text-body-secondary">© 2025 RatingFilm, Inc.</span>
    </footer> -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const form = document.getElementById('editProfileForm');
        const preview = document.getElementById('pfpPreview');
        const image = document.forms['editProfileForm']['pictInput'];
        const username = document.forms['editProfileForm']['username'];
        // const oldPass = document.forms['editProfileForm']['oldPassword'];
        // const newPass = document.forms['editProfileForm']['newPassword'];
        // const confirmPass = document.forms['editProfileForm']['confirmPassword'];
        const usnErr = document.getElementById('usnerr');
        const imgErr = document.getElementById('imgerr');
        // const oldErr = document.getElementById('olderr');
        // const newErr = document.getElementById('newerr');
        // const pwErr = document.getElementById('pwnerr');

        preview.style.visibility = 'hidden'
        // oldErr.textContent = '';
        // newErr.textContent = '';
        // pwErr.textContent = '';



        window.onload = function() {
            form.reset();
        }

        image.onchange = function() {
            const [file] = image.files
            if (file) {
                preview.style.visibility = 'visible'
                preview.src = URL.createObjectURL(file)
            }
        }

        function checkForm() {

            usnErr.textContent = '';
            imgErr.textContent = '';

            if (username.value.trim().length === 0 || username.value === '') {
                usnErr.textContent = 'Username is empty!';
                return false;
            }
            if (image.files && image.files[0].size > 41943040) {
                imgErr.textContent = 'File too large!'
                return false;
            }
            return true;
        }
    </script>
</body>

</html>