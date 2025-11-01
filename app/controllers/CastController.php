<?php

class CastController extends Controller
{
    public function index()
    {
        session_start();

        if (isset($_SESSION['user']) && $_SESSION['user']['isAdmin'] === 0) {
            header('Location: ' . BASE_URL);
            exit();
        }

        if (!isset($_SESSION['user'])) {
            header('Location: ' . BASE_URL . '/auth/login');
            exit();
        }

        // Use $_GET for search and pagination (better UX)
        $keyword = trim($_GET['q'] ?? '');
        $page = (int)($_GET['page'] ?? 1);
        $page = max(1, $page);
        $limit = 10;

        // Initialize
        $movies = $this->model('Movie')->getMovies($keyword, $page, $limit);
        $total = $this->model('Movie')->getMoviesTotal($keyword);

        $totalPages = ceil($total / $limit);
        $previousPage = $page > 1 ? $page - 1 : 1;
        $nextPage = $page < $totalPages ? $page + 1 : $totalPages;

        $data = [
            'movies' => $movies,
            'categories' => $this->model('Category')->getCategories(),
            'title' => "Movies",
            'keyword' => $keyword,
            'currentPage' => $page,
            'totalPages' => $totalPages,
            'previousPage' => $previousPage,
            'nextPage' => $nextPage
        ];

        $this->view('includes/header', $data);
        $this->view('cast/index', $data);
        $this->view('includes/footer');
    }

    public function admin($id)
    {
        session_start();

        if (isset($_SESSION['user']) && $_SESSION['user']['isAdmin'] === 0) {
            header('Location: ' . BASE_URL);
            exit();
        }

        if (!isset($_SESSION['user'])) {
            header('Location: ' . BASE_URL . '/auth/login');
            exit();
        }

         // Use $_GET for search and pagination (better UX)
        // $keyword = trim($_GET['q'] ?? '');
        $page = (int)($_GET['page'] ?? 1);
        $page = max(1, $page);
        $limit = 10;


        $details = $this->model('Movie')->getMovieDetails($id);

        $casts = $this->model('Movie')->getMovieCasts($id, $page, $limit);
        $total = $this->model('Movie')->getMovieCastsTotal($id);

        $_SESSION['movieId'] = $details['id'];


        $date = new DateTime($details['release_year']);
        $totalPages = ceil($total / $limit);
        $previousPage = $page > 1 ? $page - 1 : 1;
        $nextPage = $page < $totalPages ? $page + 1 : $totalPages;

        $data = [
            'casts' => $casts,
            'details' => $details,
            'release' => $date->format('F j, Y'),
            'categories' => $this->model('Category')->getCategories(),
            'title' => "Movie Cast",
            'currentPage' => $page,
            'totalPages' => $totalPages,
            'previousPage' => $previousPage,
            'nextPage' => $nextPage,
            'total' => $total
        ];

        $this->view('includes/header', $data);
        $this->view('cast/admin', $data);
        $this->view('includes/footer');
    }

    public function actor()
    {
        session_start();

        if (!isset($_SESSION['user']) || (isset($_SESSION['user']) && $_SESSION['user']['isAdmin'] === 0)) {
            header('Location: ' . BASE_URL . '/auth/login');
            exit();
        }

        // Use $_GET for search and pagination (better UX)
        $keyword = trim($_GET['q'] ?? '');
        $page = (int)($_GET['page'] ?? 1);
        $page = max(1, $page);
        $limit = 10;

        // Fetch assigned actor IDs for this movie
        $casts = $this->model('Movie')->getMovieCastsId($_SESSION['movieId']);
        $castIds = array_column($casts, 'actor_id');

        // Initialize
        $actors = [];
        $total = 0;

        if (!empty($keyword)) {
            $actors = $this->model('Actor')->searchActors($keyword, $page, $limit);
            $total = $this->model('Actor')->getTotalSearchActors($keyword);
        } else {
            $actors = $this->model('Actor')->getActors($page, $limit);
            $total = $this->model('Actor')->getTotalActors();
        }

        $totalPages = ceil($total / $limit);
        $previousPage = $page > 1 ? $page - 1 : 1;
        $nextPage = $page < $totalPages ? $page + 1 : $totalPages;

        $data = [
            'actors' => $actors,
            'casts' => $castIds,
            'categories' => $this->model('Category')->getCategories(),
            'title' => "Search Actors",
            'keyword' => $keyword,
            'currentPage' => $page,
            'totalPages' => $totalPages,
            'previousPage' => $previousPage,
            'nextPage' => $nextPage,
            'movieId' => $_SESSION['movieId'] ?? null
        ];

        $this->view('includes/header', $data);
        $this->view('cast/actor', $data);
        $this->view('includes/footer');
    }

    public function update()
    {
        if ($_POST) {
            $this->model('Movie')->updateCast($_POST['editId'], $_POST['editCast']);
            header('Location: ' . BASE_URL . '/cast/admin/' . $_POST['movieId']);
            exit();
        }
    }

    public function add($movieId, $actorId)
    {
        session_start();
        if ($this->model('Movie')->addCast($actorId, $movieId) > 0) {
            header('Location: ' . BASE_URL . '/cast/admin/' . $movieId);
            session_unset('movieId');
            exit();
        }
    }

    public function delete($id)
    {
        if ($_POST) {
            if ($this->model('Movie')->deleteCast($id) > 0) {
                header('Location: ' . BASE_URL . '/cast/admin/' . $_POST['movieId']);
                exit();
            }
        }
    }
}
