<?php

class AuthController extends Controller
{
    public function register($data = [])
    {
        $this->view('auth/register', $data);
    }

    public function registering()
    {
        if ($_POST) {
            $user = $this->model('User')->getUser($_POST['emailInput'], $_POST['usernameInput']);
            if ($user['email'] === htmlspecialchars($_POST['emailInput'])) {
                $data['emailErr'] = 'email already used!';
                $this->register($data);
                exit;
            } else if ($user['username'] === htmlspecialchars($_POST['usernameInput'])) {
                $data['usnErr'] = 'username already used!';
                $this->register($data);
                exit;
            } else {
                if ($this->model('User')->register($_POST) > 0) {
                    header('Location: ' . BASE_URL . '/auth/login');
                    exit;
                }
            }
        }
    }

    public function login($data = [])
    {
        $this->view('auth/login', $data);
    }

    public function logining()
    {
        if ($_POST) {
            $user = $this->model('User')->getUser($_POST['emailInput']);
            if (empty($user['email'])) {
                $data['emailErr'] = 'email is not registered!';
                $this->login($data);
                exit;
            } else if (!password_verify(htmlspecialchars($_POST['passwordInput']), $user['password'])){
                $data['passErr'] = 'password is not match!';
                $this->login($data);
            }else{
                session_start();
                $_SESSION['user'] = $user;
                header('Location: '.BASE_URL);
                exit();
            }
        }
    }
}
