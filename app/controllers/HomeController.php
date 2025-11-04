<?php

class HomeController extends Controller
{

    public function index()
    {

        // $movies = $this->model('Movie')->getMovies();

        session_start();

        // kalo session user ada dan user adalah admin
        if (isset($_SESSION['user']) && $_SESSION['user']['isAdmin'] === 1) {
            header('Location: ' . BASE_URL . '/movie/admin');
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
            'title' => "Home",
            'keyword' => $keyword,
            'currentPage' => $page,
            'totalPages' => $totalPages,
            'previousPage' => $previousPage,
            'nextPage' => $nextPage
        ];

        $this->view('includes/header', $data);
        $this->view('home/index', $data);
        $this->view('includes/footer');
    }

    public function search()
    {
        session_start();

        if (isset($_SESSION['user']) && $_SESSION['user']['isAdmin'] === 1) {
            header('Location: ' . BASE_URL . '/movie/admin');
            exit();
        }

        $data = [
            'movies' => $this->model('Movie')->searchMovies(),
            'categories' => $this->model('Category')->getCategories(),
            'title' => "Home",
        ];

        $this->view('includes/header', $data);
        $this->view('home/index', $data);
        $this->view('includes/footer');
    }
}
