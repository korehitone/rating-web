<?php

class ReviewController extends Controller
{
    public function index()
    {
        session_start();
        if(isset($_SESSION['user']) && $_SESSION['user']['isAdmin'] === 1){
            header('Location: ' . BASE_URL . '/movie/admin');
            exit();
        }

        if(!isset($_SESSION['user'])){
            header('Location: ' . BASE_URL . '/auth/login');
            exit();
        }
        $reviews = $this->model('Review')->getReviews($_SESSION['user']['id']);
        $data = [
            'reviews' => $reviews,
            'categories' => $this->model('Category')->getCategories(),
            'title' => "Review",
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
