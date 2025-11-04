<?php

class MovieController extends Controller
{

    public function index($id)
    {
        session_start();

        if (isset($_SESSION['user']) && $_SESSION['user']['isAdmin'] === 1) {
            header('Location: ' . BASE_URL . '/movie/admin');
            exit();
        }

        // if (!isset($_SESSION['user'])) {
        //     header('Location: ' . BASE_URL . '/auth/login');
        //     exit();
        // }

        $details = $this->model('Movie')->getMovieDetails($id);
        $reviews = $this->model('Movie')->getMovieReviews($id);
        $casts = $this->model('Movie')->getMovieCasts($id);

        $date = new DateTime($details['release_year']);

        $data = [
            'casts' => $casts,
            'details' => $details,
            'reviews' => $reviews,
            'release' => $date->format('F j, Y'),
            'categories' => $this->model('Category')->getCategories(),
            'title' => "Movie Detail"
        ];

        $this->view('includes/header', $data);
        $this->view('movie/index', $data);
        $this->view('includes/footer');
    }

    public function admin()
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
        $movies = $this->model('Movie')->getMoviesDetails($keyword, $page, $limit);
        $total = $this->model('Movie')->getMoviesDetailsTotal($keyword);

        $totalPages = ceil($total / $limit);
        $previousPage = $page > 1 ? $page - 1 : 1;
        $nextPage = $page < $totalPages ? $page + 1 : $totalPages;

        $data = [
            'movies' => $movies,
            'categories' => $this->model('Category')->getCategories(),
            'title' => "Movie - Admin",
            'keyword' => $keyword,
            'currentPage' => $page,
            'totalPages' => $totalPages,
            'previousPage' => $previousPage,
            'nextPage' => $nextPage
        ];
        $this->view('includes/header', $data);
        $this->view('movie/admin', $data);
        $this->view('includes/footer');
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($_FILES['editCover']['error'] == 4 || ($_FILES['editCover']['size'] == 0 && $_FILES['editCover']['error'] == 0)) {
                $this->model('Movie')->update($_POST);
                header('Location: ' . BASE_URL . '/movie/admin');
                exit();
            } else {
                $temp = explode('.', $_FILES['editCover']['name']);
                $ext = end($temp);
                $path_base = MOVIE_PATH . $_POST['editFilmId'];

                $file_tmp_name = $_FILES['editCover']['tmp_name'];
                $filename = "cover." . $ext;

                if (!is_dir($path_base)) {
                    mkdir($path_base, 0777, true);
                }

                if (file_exists($path_base . '/' . $filename)) {
                    unlink($path_base . '/' . $filename);
                }

                $file_move = $path_base . '/' . $filename;
                move_uploaded_file($file_tmp_name, $file_move);
                $path_url = BASE_URL_IMG . 'movie/' . $_POST['editFilmId'] . '/' . $filename;
                $this->model('Movie')->update($_POST, $path_url);
                header('Location: ' . BASE_URL . '/movie/admin');
                exit();
            }
        }
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->model('Movie')->create($_POST) > 0) {
                header('Location: ' . BASE_URL . '/movie/admin');
                exit();
            }
        }
    }

    public function category($id)
    {
        // $a = $this->model('Movie')->getCategoryMovies($id);

        // Use $_GET for search and pagination (better UX)
        $keyword = trim($_GET['q'] ?? '');
        $page = (int)($_GET['page'] ?? 1);
        $page = max(1, $page);
        $limit = 10;

        // Initialize
        $movies = $this->model('Movie')->getCategoryMovies($id, $keyword, $page, $limit);
        $total = $this->model('Movie')->getCategoryMoviesTotal($id, $keyword);

        $totalPages = ceil($total / $limit);
        $previousPage = $page > 1 ? $page - 1 : 1;
        $nextPage = $page < $totalPages ? $page + 1 : $totalPages;

        $categories = $this->model('Category')->getCategories();

        $idName = array_column($categories, 'name', 'id');
        $name = $idName[$id] ?? null;



        $data = [
            'movies' => $movies,
            'categories' => $categories,
            'cid' => $id,
            'title' => "Category - " . $name,
            'category' => $name,
            'keyword' => $keyword,
            'currentPage' => $page,
            'totalPages' => $totalPages,
            'previousPage' => $previousPage,
            'nextPage' => $nextPage
        ];

        $this->view('includes/header', $data);
        $this->view('home/category', $data);
        $this->view('includes/footer');
    }

    public function review()
    {

        session_start();
        if ($_POST) { // kalo ada request post
            $review = $this->model('Review')->getReview($_POST['movieId'], $_SESSION['user']['id']);
            if (empty($review['id'])) {
                if ($this->model('Review')->create($_POST, $_SESSION['user']['id']) > 0) {
                    header('Location: ' . BASE_URL . '/movie/index/' . $_POST['movieId']);
                    exit();
                }
            } else {
                $this->model('Review')->update($_POST, $review['id'], $review['created_at']);
                header('Location: ' . BASE_URL . '/movie/index/' . $_POST['movieId']);
                exit();
            }
        }
    }

    public function delete($id)
    {
        if ($_POST) {
            // kalo ada perubahan data (fungsi delete return rowcount yang mengembalikan nilai kalau ada perubahan data)
            if ($this->model('Movie')->delete($id) > 0) {
                header('Location: ' . BASE_URL . '/movie/admin');
                exit();
            }
        }
    }

    public function search()
    {
        $a = $this->model('Movie')->searchMovies();

        $data = [
            'movies' => $a,
            'categories' => $this->model('Category')->getCategories(),
            'title' => "Category",
        ];

        $this->view('includes/header', $data);
        $this->view('home/category', $data);
        $this->view('includes/footer');
    }
}
