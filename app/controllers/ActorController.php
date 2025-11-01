<?php

class ActorController extends Controller
{
    public function index()
    {
        header('Location: ' . BASE_URL);
        exit();
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

        $keyword = trim($_GET['q'] ?? '');
        $page = (int)($_GET['page'] ?? 1);
        $page = max(1, $page);
        $limit = 10;

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
            'title' => "Actor Admin",
            'keyword' => $keyword,
            'currentPage' => $page,
            'totalPages' => $totalPages,
            'previousPage' => $previousPage,
            'nextPage' => $nextPage
        ];
        $this->view('includes/header', $data);
        $this->view('actor/admin', $data);
        $this->view('includes/footer');
    }

    public function detail($id)
    {
        session_start();
        if (isset($_SESSION['user']) && $_SESSION['user']['isAdmin'] === 1) {
            header('Location: ' . BASE_URL . '/actor/admin');
            exit();
        }

        if (!isset($_SESSION['user'])) {
            header('Location: ' . BASE_URL . '/auth/login');
            exit();
        }
        $details = $this->model('Actor')->getActor($id);
        $movies = $this->model('Actor')->getActorMovies($id);

        $date = new DateTime($details['birthday']);

        $data = [
            'details' => $details,
            'movies' => $movies,
            'birthday' => $date->format('F j, Y'),
            'categories' => $this->model('Category')->getCategories(),
            'title' => "Actor Detail"
        ];

        $this->view('includes/header', $data);
        $this->view('actor/detail', $data);
        $this->view('includes/footer');
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($_FILES['editImg']['error'] == 4 || ($_FILES['editImg']['size'] == 0 && $_FILES['editImg']['error'] == 0)) {
                $this->model('Actor')->update($_POST);
                header('Location: ' . BASE_URL . '/actor/admin');
                exit();
            } else {
                $temp = explode('.', $_FILES['editImg']['name']);
                $ext = end($temp);
                $path_base = ACTOR_PATH . $_POST['editId'];

                $file_tmp_name = $_FILES['editImg']['tmp_name'];
                $filename = "image." . $ext;

                if (!is_dir($path_base)) {
                    mkdir($path_base, 0777, true);
                }

                if (file_exists($path_base . '/' . $filename)) {
                    unlink($path_base . '/' . $filename);
                }

                $file_move = $path_base . '/' . $filename;
                move_uploaded_file($file_tmp_name, $file_move);
                $path_url = BASE_URL_IMG . 'actor/' . $_POST['editId'] . '/' . $filename;

                $this->model('Actor')->update($_POST, $path_url);
                header('Location: ' . BASE_URL . '/actor/admin');
                exit();
            }
        }
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->model('Actor')->create($_POST) > 0) {
                header('Location: ' . BASE_URL . '/actor/admin');
                exit();
            }
        }
    }

    public function delete($id)
    {
        if ($_POST) {
            if ($this->model('Actor')->delete($id) > 0) {
                header('Location: ' . BASE_URL . '/actor/admin');
                exit();
            }
        }
    }
}
