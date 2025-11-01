<main class="flex-grow-1">
    <div class="container-fluid px-3 px-md-5 py-4">
        <!-- Header Banner -->
        <div class="bg-primary rounded-4 text-center py-5 mb-4">
            <h1 class="display-4 fw-bold text-white">My Reviews</h1>
        </div>

        <form class="d-flex align-items-center mb-4" method="GET" action="<?= BASE_URL ?>/review">
            <input
                type="search"
                class="form-control form-control-sm rounded-pill me-2 w-100 w-md-50"
                name="q"
                id="keyword"
                value="<?= htmlspecialchars($data['keyword'] ?? '') ?>"
                placeholder="Search reviews..."
                aria-label="Search"
                autocomplete="off">
            <button type="submit" class="btn btn-outline-secondary btn-sm rounded-pill">Search</button>
        </form>

        <!-- Reviews Table -->
        <div class="bg-body-secondary rounded-4 p-4">
            <h2 class="fs-3 fw-bold mb-4">My Reviews</h2>

            <div class="table-responsive rounded-3 overflow-hidden">
                <table class="table table-dark table-hover mb-0">
                    <thead class="bg-secondary bg-opacity-25">
                        <tr>
                            <th class="text-center" style="width: 5%;">#</th>
                            <th>Movie</th>
                            <th>Review</th>
                            <th class="text-center">Rating</th>
                            <th class="text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-dark bg-opacity-10">
                        <!-- Review 1 -->
                        <?php if (isset($data['reviews']) && count($data['reviews']) !== 0) : ?>
                            <?php foreach ($data['reviews'] as $d) : ?>
                                <tr class="align-middle">
                                    <td class="text-center"><?= array_search($d, $data['reviews']) + 1 ?></td>
                                    <td>
                                        <div class="d-flex align-items-center gap-3">
                                            <?php if (isset($d['img_cover']) && !empty($d['img_cover'])) : ?>
                                                <img src="<?= $d['img_cover'] ?>"
                                                    alt="Inception" class="rounded" style="width: 60px; height: 80px; object-fit: cover;">
                                            <?php else : ?>
                                                <svg xmlns="http://www.w3.org/2000/svg" height="80" width="60" fill="currentColor" class="bi bi-file-image" viewBox="0 0 16 16">
                                                    <path d="M8.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0" />
                                                    <path d="M12 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2M3 2a1 1 0 0 1 1-1h8a1 1 0 0 1 1 1v8l-2.083-2.083a.5.5 0 0 0-.76.063L8 11 5.835 9.7a.5.5 0 0 0-.611.076L3 12z" />
                                                </svg>
                                            <?php endif ?>
                                            <div>
                                                <div class="fw-bold"><?= $d['title'] ?></div>
                                                <small class="text-muted"><?php $year = new DateTime($d['release_year']); ?><?= $year->format('Y') ?></small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="mb-0" style="max-width: 250px; overflow: hidden; text-overflow: ellipsis;">
                                            <?= $d['review'] ?>
                                        </p>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-warning text-dark"><?= $d['rating'] ?> ★</span>
                                    </td>
                                    <td class="text-end">
                                        <!-- <a href="editReview.html" class="btn btn-link text-primary p-1" title="Edit">
                                            <i class="bi bi-pencil-square fs-5"></i>
                                        </a> -->
                                        <button class="btn btn-link text-danger p-1" title="Delete" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $d['id'] ?>">
                                            <i class="bi bi-trash3-fill fs-5"></i>
                                        </button>
                                    </td>
                                </tr>

                                <div class="modal fade" id="deleteModal<?= $d['id'] ?>" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content bg-body text-white">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Delete Review</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form id="deleteForm" name="deleteForm" action="<?= BASE_URL ?>/review/delete/<?= $d['id'] ?>" method="post">
                                                    <input type="hidden" name="movieId" value="<?= $d['id'] ?>">
                                                    <div class="mb-4">
                                                        <p>Are you sure you want to delete your review for <strong><?= $d['title'] ?></strong>?</p>
                                                    </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach ?>
                        <?php else : ?>
                            <h4>You Have Not Made a Review Yet</h4>
                        <?php endif ?>
                    </tbody>
                </table>
            </div>


            <!-- Empty state (optional) -->
            <!--
                <div class="text-center py-5 text-muted" style="display: none;">
                    You haven't reviewed any movies yet.
                </div>
                -->
        </div>
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