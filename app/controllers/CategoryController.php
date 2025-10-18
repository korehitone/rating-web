<?php

class CategoryController extends Controller
{
    public function index() {}

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
        $data = [
            'categories' => $this->model('Category')->getCategories(),
            'title' => "Category Admin"
        ];
        $this->view('includes/header', $data);
        $this->view('category/admin', $data);
        $this->view('includes/footer');
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->model('Category')->update($_POST['editId'], $_POST['editName']);
            header('Location: ' . BASE_URL . '/category/admin');
            exit();
        }
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->model('Category')->create($_POST['addName']) > 0) {
                header('Location: ' . BASE_URL . '/category/admin');
                exit();
            }
        }
    }

    public function delete($id)
    {
        if ($_POST) {
            if ($this->model('Category')->delete($id) > 0) {
                header('Location: ' . BASE_URL . '/category/admin');
                exit();
            }
        }
    }
}
