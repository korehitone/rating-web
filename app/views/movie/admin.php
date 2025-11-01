<main class="flex-grow-1">
    <div class="container-fluid px-3 px-md-5 py-4">
        <!-- Header Banner -->
        <div class="bg-primary rounded-4 text-center py-5 mb-4">
            <h1 class="display-4 fw-bold text-white">Movies Table</h1>
        </div>

        <form class="d-flex align-items-center mb-4" method="GET" action="<?= BASE_URL ?>/movie/admin">
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

        <!-- Films Management Section -->
        <div class="bg-body-secondary rounded-4 p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fs-3 fw-bold mb-0">Movies</h2>
                <button class="btn btn-primary px-4" data-bs-toggle="modal" data-bs-target="#addFilmModal">
                    Add Film
                </button>
            </div>

            <!-- Responsive Table -->
            <div class="table-responsive rounded-3 overflow-hidden">
                <table class="table table-dark table-hover mb-0">
                    <thead class="bg-secondary bg-opacity-25">
                        <tr>
                            <th class="text-center" style="width: 5%;">#</th>
                            <th>Cover</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Category</th>
                            <th>Duration</th>
                            <th>Release Year</th>
                            <th class="text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-dark bg-opacity-10">
                        <?php if (isset($data['movies']) && count($data['movies']) !== 0) : ?>
                            <?php foreach ($data['movies'] as $d) : ?>
                                <!-- Example Row 1 -->
                                <tr class="align-middle">
                                    <td class="text-center"><?= array_search($d, $data['movies']) + 1 ?></td>
                                    <td>
                                        <?php if (isset($d['img_cover']) && !empty($d['img_cover'])) : ?>
                                            <img src="<?= $d['img_cover'] ?>"
                                                alt="Movie" class="rounded" style="width: 60px; height: 80px; object-fit: cover;">
                                        <?php else : ?>
                                            <svg xmlns="http://www.w3.org/2000/svg" height="80" width="60" fill="currentColor" class="bi bi-file-image" viewBox="0 0 16 16">
                                                <path d="M8.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0" />
                                                <path d="M12 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2M3 2a1 1 0 0 1 1-1h8a1 1 0 0 1 1 1v8l-2.083-2.083a.5.5 0 0 0-.76.063L8 11 5.835 9.7a.5.5 0 0 0-.611.076L3 12z" />
                                            </svg>
                                        <?php endif ?>
                                    </td>
                                    <td><?= $d['title'] ?></td>
                                    <td><?= $d['description'] ?></td>
                                    <td><?= $d['name'] ?></td>
                                    <td><?= $d['duration'] ?></td>
                                    <td><?php $date = new DateTime($d['release_year']); ?><?= $date->format('F j, Y') ?></td>
                                    <td class="text-end">
                                        <button class="btn btn-link text-primary p-1"
                                            data-bs-toggle="modal" data-bs-target="#editFilmModal<?= $d['id'] ?>"
                                            data-film-id="1">
                                            <i class="bi bi-pencil-square fs-5"></i>
                                        </button>
                                        <button class="btn btn-link text-danger p-1"
                                            data-bs-toggle="modal" data-bs-target="#deleteConfirmModal<?= $d['id'] ?>"
                                            data-film-id="1">
                                            <i class="bi bi-trash3-fill fs-5"></i>
                                        </button>
                                    </td>
                                </tr>

                                <div class="modal fade" id="editFilmModal<?= $d['id'] ?>" tabindex="-1">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Film</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="post" action="<?= BASE_URL ?>/movie/update" enctype="multipart/form-data">
                                                    <input type="hidden" id="editFilmId" name="editFilmId" value="<?= $d['id'] ?>">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="editTitle">Title</label>
                                                        <input type="text" class="form-control" id="editTitle" name="editTitle" value="<?= $d['title'] ?>" placeholder="Enter film title">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label" for="editDescription">Description</label>
                                                        <textarea class="form-control" id="editDescription" name="editDescription" rows="3" placeholder="Enter film description"><?= $d['description'] ?></textarea>
                                                    </div>
                                                    <div class="mb-3">
                                                        <input type="file" class="form-control form-control-sm mt-2" id="editCover" name="editCover" accept="image/jpeg, image/jpg, image/png">
                                                        <small class="text-muted">Upload a new Film Cover (optional)</small>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4 mb-3">
                                                            <label class="form-label" for="editCategory">Category</label>
                                                            <select class="form-select" id="editCategory" name="editCategory">
                                                                <option selected disabled>Select category</option>
                                                                <?php foreach ($data['categories'] as $c) : ?>
                                                                    <option value="<?= $c['id'] ?>" <?= $c['id'] === $d['category_id'] ? 'selected="selected"' : '' ?>><?= $c['name'] ?></option>
                                                                <?php endforeach ?>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4 mb-3">
                                                            <label class="form-label" for="editDuration">Duration</label>
                                                            <input type="text" class="form-control" value="<?= $d['duration'] ?>" id="editDuration" name="editDuration" placeholder="e.g., 120 min">
                                                        </div>
                                                        <div class="col-md-4 mb-3">
                                                            <label class="form-label" for="editReleaseYear">Release Year</label>
                                                            <input type="date" value="<?= $d['release_year'] ?>" class="form-control" id="editReleaseYear" name="editReleaseYear">
                                                        </div>
                                                    </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-success">Save Changes</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade" id="deleteConfirmModal<?= $d['id'] ?>" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title text-danger">Confirm Deletion</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form id="deleteForm" name="deleteForm" action="<?= BASE_URL ?>/movie/delete/<?= $d['id'] ?>" method="post">
                                                    <div class="mb-4">
                                                        <input type="hidden" id="deleteFilmId" name="deleteFilmId" value="<?= $d['id'] ?>">
                                                        <p>Are you sure you want to delete this <strong><?= $d['title'] ?></strong> film? This action cannot be undone.</p>
                                                    </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-danger" id="confirmDeleteBtn">Delete</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach ?>
                        <?php else : ?>
                            <h4>No Movies Yet</h4>
                        <?php endif ?>
                        <!-- Repeat for other rows (you can apply same pattern) -->
                        <!-- Add more rows as needed -->
                    </tbody>
                </table>
            </div>
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

<div class="modal fade" id="addFilmModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Film</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="addForm" name="addForm" enctype="multipart/form-data" action="<?= BASE_URL ?>/movie/create" method="post" onsubmit="return checkForm()">
                    <div class="mb-3">
                        <label class="form-label" for="addTitle">Title</label>
                        <input type="text" class="form-control" id="addTitle" name="addTitle" placeholder="Enter film title" required>
                    </div>
                    <p class="text-danger" id="titleErr"></p>
                    <div class="mb-3">
                        <label class="form-label" for="addDesc">Description</label>
                        <textarea class="form-control" id="addDesc" name="addDesc" rows="3" placeholder="Enter film description" required></textarea>
                    </div>
                    <p class="text-danger" id="descErr"></p>
                    <!-- <div class="mb-3">
                        <input type="file" class="form-control form-control-sm mt-2" id="addCover" name="addCover" accept="image/jpeg, image/jpg, image/png">
                        <small class="text-muted">Upload a new Film Cover (optional)</small>
                    </div> -->
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label" for="addCategory">Category</label>
                            <select class="form-select" id="addCategory" name="addCategory" required>
                                <option value="" selected disabled>Select category</option>
                                <?php foreach ($data['categories'] as $c) : ?>
                                    <option value="<?= $c['id'] ?>"><?= $c['name'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label" for="addDuration">Duration</label>
                            <input type="text" id="addDuration" name="addDuration" class="form-control" placeholder="e.g., 120 min" required>
                            <p class="text-danger" id="durationErr"></p>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label" for="addDate">Release Year</label>
                            <input type="date" id="addDate" name="addDate" class="form-control" required>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Add Film</button>
            </div>
            </form>
        </div>
    </div>
</div>


<script>
    const addform = document.getElementById('addForm');
    const title = document.forms['addForm']['addTitle'];
    const desc = document.forms['addForm']['addDesc'];
    const duration = document.forms['addForm']['addDuration'];
    const titleErr = document.getElementById('titleErr');
    const descErr = document.getElementById('descErr');
    const durationErr = document.getElementById('durationErr');

    window.onload = function() {
        addform.reset();
    }

    function checkForm() {

        titleErr.textContent = '';
        descErr.textContent = '';
        durationErr.textContent = '';

        if (title.value.trim().length === 0 || title.value === '') {
            titleErr.textContent = 'Title is empty!';
            return false;
        }
        if (desc.value.trim().length === 0 || desc.value === '') {
            descErr.textContent = 'Description is empty!';
            return false;
        }
        if (duration.value.trim().length === 0 || duration.value === '') {
            durationErr.textContent = 'Duration is empty!';
            return false;
        }
        return true;
    }
</script>