<main class="flex-grow-1">
    <div class="container-fluid px-3 px-md-5 py-4">
        <!-- Header Banner -->
        <div class="bg-primary rounded-4 text-center py-5 mb-4">
            <h1 class="display-4 fw-bold text-white">Actors Table</h1>
        </div>

        <form class="d-flex align-items-center mb-4" method="GET" action="<?= BASE_URL ?>/actor/admin">
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

        <!-- Actors Management Section -->
        <div class="bg-body-secondary rounded-4 p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fs-3 fw-bold mb-0">Actors</h2>
                <button class="btn btn-primary px-4" data-bs-toggle="modal" data-bs-target="#addActorModal">
                    Add Actor
                </button>
            </div>

            <!-- Responsive Table -->
            <div class="table-responsive rounded-3 overflow-hidden">
                <table class="table table-dark table-hover mb-0">
                    <thead class="bg-secondary bg-opacity-25">
                        <tr>
                            <th class="text-center" style="width: 8%;">#</th>
                            <th>Full Name</th>
                            <th>Birthday</th>
                            <th class="text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-dark bg-opacity-10">
                        <?php if (isset($data['actors']) && count($data['actors']) !== 0) : ?>
                            <?php foreach ($data['actors'] as $d) : ?>
                                <tr class="align-middle">
                                    <td class="text-center"><?= array_search($d, $data['actors']) + 1 ?></td>
                                    <td><?= $d['fullname'] ?></td>
                                    <td><?= $d['birthday'] ?></td>
                                    <td class="text-end">
                                        <button class="btn btn-link text-primary p-1"
                                            data-bs-toggle="modal" data-bs-target="#editActorModal<?= $d['id'] ?>">
                                            <i class="bi bi-pencil-square fs-5"></i>
                                        </button>
                                        <button class="btn btn-link text-danger p-1"
                                            data-bs-toggle="modal" data-bs-target="#deleteConfirmModal<?= $d['id'] ?>">
                                            <i class="bi bi-trash3-fill fs-5"></i>
                                        </button>
                                    </td>
                                </tr>

                                <div class="modal fade" id="editActorModal<?= $d['id'] ?>" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Actor</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form id="editActorForm" action="<?= BASE_URL ?>/actor/update" enctype="multipart/form-data" method="post">
                                                    <input type="hidden" id="editId" name="editId" value="<?= $d['id'] ?>">
                                                    <div class="mb-3">
                                                        <label for="editName" class="form-label">Full Name</label>
                                                        <input type="text" class="form-control" id="editName" name="editName" placeholder="Enter full name" value="<?= $d['fullname'] ?>" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <input type="file" class="form-control form-control-sm mt-2" id="editImg" name="editImg" accept="image/jpeg, image/jpg, image/png">
                                                        <small class="text-muted">Upload a new Film Cover (optional)</small>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="editBirthday" class="form-label">Birthday</label>
                                                        <input type="date" class="form-control" id="editBirthday" name="editBirthday" value="<?= $d['birthday'] ?>" required>
                                                    </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <button type="Submit" class="btn btn-success">Save Changes</button>
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
                                                <form id="deleteForm" name="deleteForm" action="<?= BASE_URL ?>/actor/delete/<?= $d['id'] ?>" method="post">
                                                    <div class="mb-4">
                                                        <input type="hidden" id="deleteActorId" name="deleteActorId" value="<?= $d['id'] ?>">
                                                        <p>Are you sure you want to delete the actor <strong id="deleteActorName">"<?= $d['fullname'] ?>"</strong>?<br>
                                                            This action cannot be undone.</p>
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
                            <h4>No Actors Yet</h4>
                        <?php endif ?>
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

<div class="modal fade" id="addActorModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Actor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="addActorForm" name="addActorForm" action="<?= BASE_URL ?>/actor/create" method="post" onsubmit="return checkForm()">
                    <div class="mb-3">
                        <label for="addName" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="addName" name="addName" placeholder="Enter actor's full name" required>
                    </div>
                    <p class="text-danger" id="nameErr"></p>
                    <div class="mb-3">
                        <label for="addBirthday" class="form-label">Birthday</label>
                        <input type="date" class="form-control" id="addBirthday" name="addBirthday" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" form="addActorForm" class="btn btn-primary">Add Actor</button>
            </div>
        </div>
    </div>
</div>

<script>
    const addForm = document.getElementById('addActorForm');
    const name = document.forms['addActorForm']['addName'];
    const nameErr = document.getElementById('nameErr');


    window.onload = function() {
        addform.reset();
    }

    function checkForm() {
        nameErr.textContent = ''

        if (name.value.trim().length === 0 || name.value === '') {
            nameErr.textContent = 'Fullname is empty!';
            return false;
        }
        return true;
    }
</script>