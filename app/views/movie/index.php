<main class="flex-grow-1 p-4">
    <!-- Movie Info Card -->
    <div class="bg-secondary-subtle bg-opacity-25 border border-secondary rounded-2 p-4 mb-4 position-relative">
        <div class="d-flex flex-column flex-md-row gap-4">
            <div class="flex-shrink-0" style="max-width: 300px;">
                <h2 class="fs-4 mb-3"><?= $data['details']['title'] ?></h2>
                <?php if (isset($data['details']['img_cover']) && !empty($data['details']['img_cover'])) : ?>
                    <img src="<?= $data['details']['img_cover'] ?>" alt="<?php $data['details']['title'] ?> Movie Poster" class="w-100" style="max-height: 450px; object-fit: contain;" />
                <?php else : ?>
                    <svg xmlns="http://www.w3.org/2000/svg" height="450" fill="currentColor" class="bi bi-file-image w-100" viewBox="0 0 16 16">
                        <path d="M8.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0" />
                        <path d="M12 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2M3 2a1 1 0 0 1 1-1h8a1 1 0 0 1 1 1v8l-2.083-2.083a.5.5 0 0 0-.76.063L8 11 5.835 9.7a.5.5 0 0 0-.611.076L3 12z" />
                    </svg>
                <?php endif ?>

            </div>
            <div class="flex-grow-1">
                <p class="mb-1"><strong>Description:</strong></p>
                <p class="mb-2"><?= $data['details']['description'] ?></p>
                <p class="mb-1"><strong>Duration:</strong> <?= $data['details']['duration'] ?></p>
                <p class="mb-1"><strong>Category:</strong> <?= $data['details']['name'] ?></p>
                <p><strong>Released date:</strong> <?= $data['release'] ?></p>
                <p><strong>Ratings</strong> -
                    <?php if (isset($data['reviews'][0]['avg_rating'])) : ?>
                        <?= number_format($data['reviews'][0]['avg_rating'], 1) ?>
                    <?php else : ?>
                        0.0
                    <?php endif ?>
                    <span class="text-warning">★</span>
                </p>
            </div>
            <div class=" mt-3 me-3 bg-secondary-subtle bg-opacity-50 px-2 py-1 rounded">
            </div>
        </div>

    </div>

    <!-- Cast Container -->
    <div class="bg-secondary-subtle bg-opacity-25 border border-secondary rounded-2 p-4 mb-4">
        <h3 class="fs-5 mb-3">Cast</h3>
        <div class="d-flex gap-4 overflow-auto pb-1" style="scrollbar-width: thin; scrollbar-color: #444 #000;">
            <?php if (isset($data['casts']) && count($data['casts']) !== 0) : ?>
                <?php foreach ($data['casts'] as $d) : ?>
                    <a class="d-flex flex-column align-items-center text-decoration-none flex-shrink-0" href="<?= BASE_URL ?>/actor/detail/<?= $d['actor_id'] ?>" style="min-width: 80px;">
                        <?php if (isset($d['img_url']) && !empty($d['img_url'])) : ?>
                            <img src="<?= $d['img_url'] ?>" alt="actor" class="rounded-circle border border-secondary" style="width: 60px; height: 60px; object-fit: cover;"/>
                        <?php else : ?>
                            <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                            </svg>
                        <?php endif ?>
                        <div class="text-center text-white text-truncate mt-2" style="font-size: 0.875rem; color: #ccc; max-width: 80px;"><?= $d['fullname'] ?></div>
                        <div class="text-center mt-2" style="font-size: 0.865rem; color: #ccc; max-width: 90px;"><?= $d['play_as'] ?></div>
                        </a>
                <?php endforeach ?>
            <?php else : ?>
                <h4>No Casts Yet</h4>
            <?php endif ?>
            <!-- Add more cast members here as needed -->
        </div>
    </div>

    <!-- Review Section -->
    <div class="bg-secondary-subtle bg-opacity-25 border border-secondary rounded-2 p-3 d-flex justify-content-between align-items-center">
        <div class="bg-secondary px-3 py-1 rounded"><?php if (isset($_SESSION['user'])) : ?><?= $_SESSION['user']['username'] ?><?php else : ?> User <?php endif ?></div>
        <?php if (isset($_SESSION['user'])) : ?> <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addReviewModal">Insert Review</button>
        <?php else : ?>
            <a class="btn btn-primary" href="<?= BASE_URL?>/auth/login">Insert Review</a>
        <?php endif ?>
    </div>

    <!-- Recent Reviewers -->
    <div class="mt-4">
        <h4 class="fs-6 mb-3">Reviews</h4>
        <?php if (isset($data['reviews']) && count($data['reviews']) !== 0) : ?>
            <?php foreach ($data['reviews'] as $d) : ?>
                <div class="bg-secondary-subtle bg-opacity-25 border border-secondary rounded-2 p-3 mb-2">
                    <div class="d-flex justify-content-between align-items-start mb-1">
                        <div>
                            <strong class="text-light"><?= $d['username'] ?></strong>
                            <?php switch ($d['rating']):
                                case 5: ?>
                                    <span class="text-warning ms-2">★★★★★</span>
                                <?php break;
                                case  4: ?>
                                    <span class="text-warning ms-2">★★★★☆</span>
                                <?php break;
                                case  3: ?>
                                    <span class="text-warning ms-2">★★★☆☆</span>
                                <?php break;
                                case  2: ?>
                                    <span class="text-warning ms-2">★★☆☆☆</span>
                                <?php break;
                                case  1: ?>
                                    <span class="text-warning ms-2">★☆☆☆☆</span>
                                <?php break;
                                default: ?>
                                    <span class="text-warning ms-2">☆☆☆☆☆</span>
                            <?php endswitch ?>
                        </div>
                        <small class="text-secondary"><?php $a = new DateTime($d['created_at']);
                                                        $b = $a->format('F j, Y'); ?> <?= $b ?></small>
                    </div>
                    <p class="mb-0 text-muted"><?= $d['review'] ?></p>
                </div>
            <?php endforeach ?>
        <?php else : ?>
            <h4>No Reviews Yet</h4>
        <?php endif ?>


    </div>
</main>

<div class="modal fade" id="addReviewModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Submit Your Review</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="reviewForm" name="reviewForm" action="<?= BASE_URL ?>/movie/review" method="post" onsubmit="return checkForm()">
                    <input type="hidden" name="movieId" value="<?= $data['details']['id'] ?>">
                    <div class="mb-4">
                        <label for="ratingSelect" class="form-label">Rating</label>
                        <select class="form-select" id="ratingSelect" name="ratingSelect" required>
                            <option value="" selected disabled>Select your rating</option>
                            <option value="5">★★★★★ (5 stars)</option>
                            <option value="4">★★★★☆ (4 stars)</option>
                            <option value="3">★★★☆☆ (3 stars)</option>
                            <option value="2">★★☆☆☆ (2 stars)</option>
                            <option value="1">★☆☆☆☆ (1 star)</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="reviewComment" class="form-label">Your Review</label>
                        <textarea class="form-control" id="reviewComment" name="reviewComment" rows="5" placeholder="Share your experience..." minlength="20" required></textarea>
                        <div class="form-text">Please provide detailed feedback to help others.</div>
                    </div>
                    <p class="text-danger" id="commentErr"></p>
                    <!-- <button type="submit" class="btn btn-primary w-100">Submit Review</button>
          <div class="text-center mt-3">
            <a href="#" class="text-decoration-none text-secondary">View all reviews</a>
          </div> -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            </form>
        </div>
    </div>
</div>

<script>
    const revForm = document.getElementById('reviewForm');
    const comment = document.forms['reviewForm']['reviewComment'];
    const errorTxt = document.getElementById('commentErr');

    window.onload = function() {
        revForm.reset();
    }

    $(document).ready(function() {
        if (revForm.length > 0) {
            revForm.reset();
        }
    });

    function checkForm() {
        errorTxt.textContent = ''

        if (comment.value === '' || comment.value.trim().length === 0) {
            errorTxt.textContent = 'Review Comment can not be empty';
            return false;
        }
        return true;
    }
</script>