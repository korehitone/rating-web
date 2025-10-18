<main class="flex-grow-1 p-3 p-md-5">
    <form class="d-flex align-items-center mb-4" method="post" action="<?= BASE_URL ?>/movie/search">
        <input type="hidden" id="cId" name="cId" value="<?= $data['movies'][0]['categories_id'] ?>">
        <input type="search" class="form-control form-control-sm rounded-pill me-2 w-100 w-md-50" name="keyword" id="keyword"
            placeholder="Search movies..." aria-label="Search" autocomplete="off">
        <button type="submit" class="btn btn-outline-secondary btn-sm rounded-pill" id="searchBtn">Search</button>
    </form>
    <h2 class="fs-4 fw-bold mb-3"><?php if (isset($data['movies']) && count($data['movies']) !== 0) : ?><?= $data['movies'][0]['name'] ?><?php endif ?></h2>

    <div class="row row-cols-2 row-cols-sm-3 row-cols-md-5 g-3 justify-content-center">

        <?php if (isset($data['movies']) && count($data['movies']) !== 0) : ?>
            <?php foreach ($data['movies'] as $m) : ?>
                <a class="text-decoration-none text-white d-flex flex-column align-items-center" href="<?= BASE_URL ?>/movie/index/<?= $m['id'] ?>">
                    <img src="<?= $m['img_cover'] ?>" alt="<?= $m['title'] ?>" class="img-fluid rounded" style="max-width: 180px; max-height: 260px;">
                    <p class="mt-2 fs-6 text-center"><?= $m['title'] ?></p>
                </a>
            <?php endforeach ?>
        <?php else : ?>
            <h4>No Movies Yet</h4>
        <?php endif ?>

    </div>
</main>