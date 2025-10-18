<div class="content">
    <div class="container mt-4 d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div class="card mx-auto" style="width: 18rem;">
            <div class="card-body text-center">
                <?php if (!is_null($data['user']['img_url']) || !empty($data['user']['img_url'])) : ?>
                    <img src="<?= $data['user']['img_url'] ?>" alt="mamang" class=" rounded-circle" width="160" height="160">
                <?php else : ?>
                    <svg xmlns="http://www.w3.org/2000/svg" width="160" height="160" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                        <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                    </svg>
                <?php endif ?>

                <h3 class="card-title mt-4"><?= $data['user']['username'] ?></h5>
                    <p class="card-text"><?= $data['user']['email'] ?></p>
                    <div class="d-flex justify-content-center">
                        <a href="<?= BASE_URL ?>/user/edit" class="btn btn-primary mx-auto">Edit Profile <i class="bi bi-pencil-square"></i></i></a>
                        <a href="<?= BASE_URL ?>/user/logout" class="btn btn-danger mx-auto">logout <i class="bi bi-box-arrow-right"></i></a>
                    </div>
            </div>
        </div>
    </div>
</div>