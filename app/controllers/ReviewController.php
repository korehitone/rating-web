<?php

class ReviewController extends Controller
{
    public function index()
    {
        session_start();
        if (isset($_SESSION['user']) && $_SESSION['user']['isAdmin'] === 1) {
            header('Location: ' . BASE_URL . '/movie/admin');
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
        $reviews = $this->model('Review')->getReviews($_SESSION['user']['id'], $keyword, $page, $limit);
        $total = $this->model('Review')->getReviewsTotal($_SESSION['user']['id'], $keyword);

        $totalPages = ceil($total / $limit);
        $previousPage = $page > 1 ? $page - 1 : 1;
        $nextPage = $page < $totalPages ? $page + 1 : $totalPages;

        $data = [
            'reviews' => $reviews,
            'categories' => $this->model('Category')->getCategories(),
            'title' => "Review",
            'keyword' => $keyword,
            'currentPage' => $page,
            'totalPages' => $totalPages,
            'previousPage' => $previousPage,
            'nextPage' => $nextPage
        ];

        $this->view('includes/header', $data);
        $this->view('review/index', $data);
        $this->view('includes/footer');
    }

    public function delete($id)
    {
        if ($_POST) {
            if ($this->model('Review')->delete($id) > 0) {
                header('Location: ' . BASE_URL . '/review');
                exit();
            }
        }
    }
}
