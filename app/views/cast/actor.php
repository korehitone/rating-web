<main class="flex-grow-1 p-4">

    <div class="rounded-4 p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fs-3 fw-bold mb-0">Actors</h2>
        </div>
        <form class="d-flex align-items-center mb-4" method="GET" action="<?= BASE_URL ?>/cast/actor">
        <input 
            type="search" 
            class="form-control form-control-sm rounded-pill me-2 w-100 w-md-50" 
            name="q" 
            id="keyword"
            value="<?= htmlspecialchars($data['keyword'] ?? '') ?>" 
            placeholder="Search actors..." 
            aria-label="Search" 
            autocomplete="off">
        <button type="submit" class="btn btn-outline-secondary btn-sm rounded-pill">Search</button>
        </form>

        <div class="table-responsive rounded-3 overflow-hidden">
            <table class="table table-dark table-hover mb-0">
                <thead class="bg-secondary bg-opacity-25">
                    <tr>
                        <th class="text-center" style="width: 8%;">#</th>
                        <th>Image</th>
                        <th>Full Name</th>
                        <th class="text-end">Action</th>
                    </tr>
                </thead>
                <tbody class="bg-dark bg-opacity-10">
                    <?php if (isset($data['actors']) && count($data['actors']) !== 0) : ?>
                        <?php foreach ($data['actors'] as $d) : ?>
                            <tr class="align-middle" <?php if(in_array($d['id'], $data['casts'])):?> style="display: none;" <?php endif ?> >
                                <td class="text-center"><?= array_search($d, $data['actors']) + 1 ?></td>
                                <td>
                                    <?php if (isset($d['img_url']) && !empty($d['img_url'])) : ?>
                                        <img src="<?= $d['img_url'] ?>"
                                            alt="Actor" class="rounded-circle" style="width: 60px; height: 60px; object-fit: cover;">
                                    <?php else : ?>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                                            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                                        </svg>
                                    <?php endif ?>
                                </td>
                                <td><?= $d['fullname'] ?></td>
                                <td class="text-end">
                                    <a class="btn btn-primary p-1" href="<?= BASE_URL ?>/cast/add/<?= $_SESSION['movieId'] ?>/<?= $d['id'] ?>">Add As Cast</a>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    <?php else : ?>
                        <h4>No Casts Yet</h4>
                    <?php endif ?>
                </tbody>
            </table>
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