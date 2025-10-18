<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?= $data['title'] ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>

<body class="d-flex flex-column min-vh-100 bg-dark text-white" data-bs-theme="dark">
  <header class="bg-body-secondary py-3 px-3 px-md-5 d-flex justify-content-between align-items-center">
    <div class="d-flex align-items-center gap-4">
      <div class="fs-3 fw-bold">RatingFilm</div>
      <nav class="d-flex align-items-center gap-4">
        <?php if (isset($_SESSION['user']) && $_SESSION['user']['isAdmin'] === 1) : ?>
          <a href="<?= BASE_URL ?>" class="nav-link">Movie</a>
          <a href="<?= BASE_URL ?>/actor/admin" class="nav-link">Actor</a>
          <a href="<?= BASE_URL ?>/category/admin" class="nav-link">Category</a>
          <a href="<?= BASE_URL ?>/cast" class="nav-link">Cast</a>
        <?php else : ?>
          <a href="<?= BASE_URL ?>/home" class="nav-link">Home</a>
          <div class="nav-item dropdown">
            <button class="nav-link dropdown-toggle bg-transparent border-0 d-flex align-items-center gap-1"
              type="button" data-bs-toggle="dropdown">
              Categories
            </button>
            <ul class="dropdown-menu">
              <?php foreach ($data['categories'] as $c) : ?>
                <li><a class="dropdown-item" href="<?= BASE_URL ?>/movie/category/<?= $c['id'] ?>"><?= $c['name'] ?></a></li>
              <?php endforeach ?>
            </ul>
          </div>
          <a href="<?= BASE_URL ?>/review" style="<?= isset($_SESSION['user']) ? 'visibility:visible' : 'visibility:hidden' ?>" class="nav-link">Review</a>
        <?php endif ?>
      </nav>
    </div>
    <?php if (isset($_SESSION['user'])) : ?>
      <a href="<?= BASE_URL ?>/user" class="btn btn-outline-secondary rounded-pill px-3"><i class="bi bi-person-fill"></i> <?= $_SESSION['user']['username'] ?></a>
    <?php else : ?>
      <a href="<?= BASE_URL ?>/auth/login" class="btn btn-outline-secondary rounded-pill px-3">Sign in</a>
    <?php endif ?>
  </header>