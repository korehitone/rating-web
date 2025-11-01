<main class="flex-grow-1 p-3 p-md-5">
    <form class="d-flex align-items-center mb-4" method="GET" action="<?= BASE_URL ?>/cast">
        <input
            type="search"
            class="form-control form-control-sm rounded-pill me-2 w-100 w-md-50"
            name="q"
            id="keyword"
            value="<?= htmlspecialchars($data['keyword'] ?? '') ?>"
            placeholder="Search movies..."
            aria-label="Search"
            autocomplete="off">
        <button type="submit" class="btn btn-outline-secondary btn-sm rounded-pill">Search</button>
    </form>
    <h2 class="fs-4 fw-bold mb-3">Movies</h2>

    <div class="row row-cols-2 row-cols-sm-3 row-cols-md-5 g-3 justify-content-center">
        <?php if (isset($data['movies']) && count($data['movies']) !== 0) : ?>
            <?php foreach ($data['movies'] as $m) : ?>
                <a class="text-decoration-none text-white d-flex flex-column align-items-center" href="<?= BASE_URL ?>/cast/admin/<?= $m['id'] ?>">
                    <?php if (isset($m['img_cover']) && !empty($m['img_cover'])) : ?>
                        <img src="<?= $m['img_cover'] ?>" alt="<?= $m['title'] ?>" class="img-fluid rounded" style="max-width: 180px; max-height: 260px;">
                    <?php else : ?>
                        <svg xmlns="http://www.w3.org/2000/svg" height="260" width="180" fill="currentColor" class="bi bi-file-image" viewBox="0 0 16 16">
                            <path d="M8.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0" />
                            <path d="M12 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2M3 2a1 1 0 0 1 1-1h8a1 1 0 0 1 1 1v8l-2.083-2.083a.5.5 0 0 0-.76.063L8 11 5.835 9.7a.5.5 0 0 0-.611.076L3 12z" />
                        </svg>
                    <?php endif ?>
                    <p class="mt-2 fs-6 text-center"><?= $m['title'] ?></p>
                </a>
            <?php endforeach ?>
        <?php else : ?>
            <h4>No Movies Yet</h4>
        <?php endif ?>
    </div>

    <?php if (isset($data['totalPages']) && $data['totalPages'] > 1): ?>
        <nav aria-label="Page navigation" class="mt-4">
            <ul class="pagination justify-content-center">
                <!-- Previous -->
                <li class="page-item <?= $data['currentPage'] <= 1 ? 'disabled' : '' ?>">
                    <a class="page-link"
                        href="?q=<?= urlencode($data['keyword'] ?? '') ?>&page=<?= $data['currentPage'] - 1 ?>"
                        aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>

                <!-- Page numbers -->
                <?php for ($i = 1; $i <= $data['totalPages']; $i++): ?>
                    <li class="page-item <?= $i == $data['currentPage'] ? 'active' : '' ?>">
                        <a class="page-link" href="?q=<?= urlencode($data['keyword'] ?? '') ?>&page=<?= $i ?>">
                            <?= $i ?>
                        </a>
                    </li>
                <?php endfor; ?>

                <!-- Next -->
                <li class="page-item <?= $data['currentPage'] >= $data['totalPages'] ? 'disabled' : '' ?>">
                    <a class="page-link"
                        href="?q=<?= urlencode($data['keyword'] ?? '') ?>&page=<?= $data['currentPage'] + 1 ?>"
                        aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    <?php endif; ?>
</main>