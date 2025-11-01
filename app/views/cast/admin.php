<main class="flex-grow-1 p-4">
    <!-- Movie Info Card -->
    <div class="p-4 mb-4 position-relative">
        <div class="d-flex flex-column justify-content-center text-center flex-md-row gap-4">
            <div class="flex-shrink-0" style="max-width: 180px;">
                <?php if (isset($data['details']['img_cover']) && !empty($data['details']['img_cover'])) : ?>
                    <img src="<?= $data['details']['img_cover'] ?>" alt="<?php $data['details']['title'] ?> Movie Poster" class="w-100" style="max-height: 450px; object-fit: contain;" />
                <?php else : ?>
                    <svg xmlns="http://www.w3.org/2000/svg" height="450" fill="currentColor" class="bi bi-file-image w-100" viewBox="0 0 16 16">
                        <path d="M8.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0" />
                        <path d="M12 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2M3 2a1 1 0 0 1 1-1h8a1 1 0 0 1 1 1v8l-2.083-2.083a.5.5 0 0 0-.76.063L8 11 5.835 9.7a.5.5 0 0 0-.611.076L3 12z" />
                    </svg>
                <?php endif ?>
                <h2 class="fs-4 mt-4 mb-3"><?= $data['details']['title'] ?></h2>
                <p><strong>Released date:</strong> <?= $data['release'] ?></p>
            </div>
        </div>

    </div>


    <div class="bg-body-secondary rounded-4 p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fs-3 fw-bold mb-0">Casts</h2>
            <a class="btn btn-primary px-4" href="<?= BASE_URL ?>/cast/actor">
                Add Cast
            </a>
        </div>

        <!-- Responsive Table -->
        <div class="table-responsive rounded-3 overflow-hidden">
            <table class="table table-dark table-hover mb-0">
                <thead class="bg-secondary bg-opacity-25">
                    <tr>
                        <th class="text-center" style="width: 8%;">#</th>
                        <th>Full Name</th>
                        <th>Play As</th>
                        <th class="text-end">Action</th>
                    </tr>
                </thead>
                <tbody class="bg-dark bg-opacity-10">
                    <?php if (isset($data['casts']) && count($data['casts']) !== 0) : ?>
                        <?php foreach ($data['casts'] as $d) : ?>
                            <tr class="align-middle">
                                <td class="text-center"><?= array_search($d, $data['casts']) + 1 ?></td>
                                <td><?= $d['fullname'] ?></td>
                                <td><?= $d['play_as'] ?></td>
                                <td class="text-end">
                                    <button class="btn btn-link text-primary p-1"
                                        data-bs-toggle="modal" data-bs-target="#editModal<?= $d['id'] ?>">
                                        <i class="bi bi-pencil-square fs-5"></i>
                                    </button>
                                    <button class="btn btn-link text-danger p-1"
                                        data-bs-toggle="modal" data-bs-target="#deleteModal<?= $d['id'] ?>">
                                        <i class="bi bi-trash3-fill fs-5"></i>
                                    </button>
                                </td>
                            </tr>

                            <div class="modal fade" id="editModal<?= $d['id'] ?>" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Cast</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="editForm" action="<?= BASE_URL ?>/cast/update" enctype="multipart/form-data" method="post" onsubmit="return checkForm()">
                                                <input type="hidden" id="editId" name="editId" value="<?= $d['id'] ?>">
                                                <input type="hidden" id="movieId" name="movieId" value="<?= $d['movie_id'] ?>">
                                                <div class="mb-3">
                                                    <label for="fullname" class="form-label">Play As</label>
                                                    <input type="text" disabled class="form-control" id="fullname" name="fullname" value="<?= $d['fullname'] ?>">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="editCast" class="form-label">Play As</label>
                                                    <input type="text" class="form-control" id="editCast" name="editCast" placeholder="He/She will play as...." value="<?= $d['play_as'] ?>" required>
                                                </div>
                                                <p class="text-danger" id="nameErr"></p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-success">Save Changes</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="deleteModal<?= $d['id'] ?>" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-danger">Confirm Deletion</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="deleteForm" name="deleteForm" action="<?= BASE_URL ?>/cast/delete/<?= $d['id'] ?>" method="post">
                                                <div class="mb-4">
                                                    <input type="hidden" id="deleteActorId" name="deleteActorId" value="<?= $d['id'] ?>">
                                                    <input type="hidden" id="movieId" name="movieId" value="<?= $d['movie_id'] ?>">
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
                        href="?page=<?= $data['currentPage'] - 1 ?>"
                        aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>

                <!-- Page numbers -->
                <?php for ($i = 1; $i <= $data['totalPages']; $i++): ?>
                    <li class="page-item <?= $i == $data['currentPage'] ? 'active' : '' ?>">
                        <a class="page-link" href="?page=<?= $i ?>">
                            <?= $i ?>
                        </a>
                    </li>
                <?php endfor; ?>

                <!-- Next -->
                <li class="page-item <?= $data['currentPage'] >= $data['totalPages'] ? 'disabled' : '' ?>">
                    <a class="page-link"
                        href="?page=<?= $data['currentPage'] + 1 ?>"
                        aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    <?php endif; ?>

</main>

<script>
    const addForm = document.getElementById('editForm');
    const name = document.forms['editForm']['editCast'];
    const nameErr = document.getElementById('nameErr');


    window.onload = function() {
        addform.reset();
    }

    function checkForm() {
        nameErr.textContent = ''

        if (name.value.trim().length === 0 || name.value === '') {
            nameErr.textContent = 'Cast is empty!';
            return false;
        }
        return true;
    }
</script>