<?php

class UserController extends Controller
{
    public function index()
    {
        session_start(); // mulai session

        if (!isset($_SESSION['user'])) { // kalo sesion "user" gak ada
            header('Location: ' . BASE_URL . '/auth/login'); // redirect ke halaman login
            exit();
        }

        $data = [
            'user' => $_SESSION['user'],
            'title' => "Profile"
        ];

        $this->view('includes/header', $data); // tampilkan view atau halaman htmlnya
        $this->view('user/index', $data);
        $this->view('includes/footer');
    }

    public function logout()
    {
        session_start();
        session_destroy(); // hapus session
        header('Location: ' . BASE_URL); // redirect ke halaman utama
        exit();
    }

    public function edit()
    {
        session_start();
        $this->view('user/update');
    }

    public function update()
    {
        session_start();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') { // kalo ada request post
            if ($_FILES['pictInput']['error'] == 4 || ($_FILES['pictInput']['size'] == 0 && $_FILES['pictInput']['error'] == 0)) {
                // kalo upload file kosong
                $this->model('User')->update($_SESSION['user']['id'], $_POST['username']); // panggil fungsi update dari model user
                $_SESSION['user'] = $this->model('User')->getProfile($_SESSION['user']['id']); // isi session user dengan data user
                header('Location: ' . BASE_URL . '/user');
                exit(); // berhentiin semua script atau kode setelah ini agar tidak berjalan
            } else {
                $temp = explode('.', $_FILES['pictInput']['name']); // pisahin string kalo ada '.' dari data nama file upload
                // data yang dipisahin make explode bakal jadi array
                $ext = end($temp); // ambil array paling terakhir dari variable $temp
                $path_base = PROFILE_PATH . $_SESSION['user']['id'];
                // path base diisi make data dari global const profile path sama data id dari session user

                $file_tmp_name = $_FILES['pictInput']['tmp_name']; // ambil tmp_name dari file upload
                $filename = "profiles." . $ext;

                if (!is_dir($path_base)) { // kalo path foldernya gak ada
                    mkdir($path_base, 0777, true); // foldernya dibikin
                }

                if (file_exists($path_base . '/' . $filename)) { // kalo filenya ada
                    unlink($path_base . '/' . $filename); // hapus filenya
                }

                $file_move = $path_base . '/' . $filename;
                move_uploaded_file($file_tmp_name, $file_move); // pindahin file upload ke folder tujuan
                $path_url = BASE_URL_IMG . 'profile/' . $_SESSION['user']['id'] . '/' . $filename;

                $this->model('User')->update($_SESSION['user']['id'], $_POST['username'], $path_url);
                header('Location: ' . BASE_URL . '/user');
                $_SESSION['user'] = $this->model('User')->getProfile($_SESSION['user']['id']);
                exit();
            }
        }
    }
}
