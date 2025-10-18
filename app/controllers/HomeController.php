<?php 

class HomeController extends Controller {

    public function index(){

        // $movies = $this->model('Movie')->getMovies();

        session_start();

        // kalo session user ada dan user adalah admin
        if(isset($_SESSION['user']) && $_SESSION['user']['isAdmin'] === 1){
            header('Location: ' . BASE_URL . '/movie/admin');
            exit();
        }

        $data = [
            'movies' => $this->model('Movie')->getMovies(),
            'categories' => $this->model('Category')->getCategories(),
            'title' => "Home",
        ];

        $this->view('includes/header', $data);
        $this->view('home/index', $data);
        $this->view('includes/footer');
    }

    public function search(){
        session_start();

        if(isset($_SESSION['user']) && $_SESSION['user']['isAdmin'] === 1){
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