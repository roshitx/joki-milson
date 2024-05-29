<?php
class Auth extends Controller
{
    public function login()
    {

    }

    public function authenticate()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            try {
                $userModel = $this->model('User_model');
                $user = $userModel->getUserByUsername($username);

                if ($user && password_verify($password, $user['password'])) {
                    // Login berhasil
                    $_SESSION['user'] = $user;
                    $_SESSION['name'] = $user->name;
                    header('Location: ' . BASE_URL . '/dashboard');
                    exit;
                } else {
                    // Login gagal
                    Flasher::setFlash('Fail', 'Username or password is incorrect', 'error');
                    header('Location: ' . BASE_URL . '/auth/login');
                    exit;
                }
            } catch (PDOException $e) {
                // Handle error
                echo "Error: " . $e->getMessage();
            }
        }
    }

    public function logout()
    {
        session_destroy();
        header('Location: ' . BASE_URL . '/login');
        exit;
    }
}