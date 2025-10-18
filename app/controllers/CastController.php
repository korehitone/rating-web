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

        $data = [
            'movies' => $this->model('Movie')->getMovies(),
            'categories' => $this->model('Category')->getCategories(),
            'title' => "Movies",
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

        $details = $this->model('Movie')->getMovieDetails($id);
        $casts = $this->model('Movie')->getMovieCasts($id);
        $_SESSION['movieId'] = $details['id'];

        $date = new DateTime($details['release_year']);

        $data = [
            'casts' => $casts,
            'details' => $details,
            'release' => $date->format('F j, Y'),
            'categories' => $this->model('Category')->getCategories(),
            'title' => "Movie Cast"
        ];

        $this->view('includes/header', $data);
        $this->view('cast/admin', $data);
        $this->view('includes/footer');
    }

    public function actor()
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

        $casts = $this->model('Movie')->getMovieCastsId($_SESSION['movieId']);

        $data = [
            'actors' => $this->model('Actor')->getActors(),
            'casts' => array_column($casts, 'actor_id'),
            'categories' => $this->model('Category')->getCategories(),
            'title' => "Movie Cast"
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
