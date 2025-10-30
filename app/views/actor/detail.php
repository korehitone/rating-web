<main class="flex-grow-1 p-4">
  <div class="d-flex flex-column flex-md-row gap-4">
    <!-- Left Container: Actor Profile -->
    <div class="bg-secondary-subtle bg-opacity-25 border border-secondary rounded-2 p-4 flex-shrink-0" style="width: 100%; max-width: 350px;">
      <div class="d-flex flex-column gap-3">
        <!-- Actor Photo -->
        <div>
          <?php if (isset($data['details']['img_url']) && !empty($data['details']['img_url'])) : ?>
            <img src="<?= $data['details']['img_url'] ?>" alt="Actor Photo" class="w-100 rounded-1" style="max-height: 450px; object-fit: cover;" />
          <?php else : ?>
            <svg xmlns="http://www.w3.org/2000/svg" height="450" fill="currentColor" class="bi bi-person-circle w-100" viewBox="0 0 16 16">
              <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
              <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
            </svg>
          <?php endif ?>
        </div>
        
        <!-- Actor Details -->
        <div class="d-flex flex-column gap-2">
          <p class="mb-0"><strong>Name:</strong> <?= $data['details']['fullname'] ?></p>
          <p class="mb-0"><strong>Birthday:</strong> <?= $data['birthday'] ?></p>
        </div>
      </div>
    </div>

    <!-- Right Container: Movies -->
    <div class="bg-secondary-subtle bg-opacity-25 border border-secondary rounded-2 p-4 flex-grow-1">
      <h3 class="fs-5 mb-3">Movies</h3>
      <div class="d-flex overflow-auto gap-3 py-1" style="scrollbar-width: thin; scrollbar-color: #444 #000;">
        <style>
          .overflow-auto::-webkit-scrollbar {
            height: 6px;
          }

          .overflow-auto::-webkit-scrollbar-track {
            background: #000;
          }

          .overflow-auto::-webkit-scrollbar-thumb {
            background-color: #444;
            border-radius: 3px;
          }
        </style>

        <?php if (isset($data['movies']) && count($data['movies']) !== 0) : ?>
          <?php foreach ($data['movies'] as $d) : ?>
            <a class="d-flex flex-column align-items-center text-decoration-none flex-shrink-0" href="<?= BASE_URL ?>/movie/index/<?= $d['movie_id'] ?>" style="width: 120px;">
              <?php if (isset($d['img_cover']) && !empty($d['img_cover'])) : ?>
                <img src="<?= $d['img_cover'] ?>" alt="Poster Film" class="rounded-1 border border-secondary" style="width: 120px; height: 180px; object-fit: cover;" />
              <?php else : ?>
                <svg xmlns="http://www.w3.org/2000/svg" height="180" width="120" fill="currentColor" class="bi bi-file-image" viewBox="0 0 16 16">
                  <path d="M8.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0" />
                  <path d="M12 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2M3 2a1 1 0 0 1 1-1h8a1 1 0 0 1 1 1v8l-2.083-2.083a.5.5 0 0 0-.76.063L8 11 5.835 9.7a.5.5 0 0 0-.611.076L3 12z" />
                </svg>
              <?php endif ?>
              <div class="mt-2 text-center text-truncate text-secondary" style="font-size: 0.875rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; width: 120px;">
                <?= $d['title'] ?>
              </div>
            </a>
          <?php endforeach ?>
        <?php else : ?>
          <h4>No Movies Yet</h4>
        <?php endif ?>
      </div>
    </div>
  </div>
</main>