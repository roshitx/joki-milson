<?php
class Login extends Controller {
    public function index()
    {
        $this->view('templates/login_header');
        $this->view('auth/login');
        $this->view('templates/login_footer');
    }

    public function auth()
    {
        if (isset($_POST['username']) && isset($_POST['password'])) {
            function validate($data)
            {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }
    
            $username = validate($_POST['username']);
            $password = validate($_POST['password']);
    
            if (empty($username) || empty($password)) {
                $_SESSION['error'] = 'Username and password are required'; // Simpan pesan kesalahan dalam sesi
                header('Location: ' . BASE_URL . '/login'); // Kembalikan ke halaman login
                exit();
            }
    
            // Menggunakan model untuk mencari pengguna berdasarkan username
            $userModel = $this->model('User_model');
            $user = $userModel->getUserByUsername($username);
    
            if ($user) {
                // Verifikasi password
                if (password_verify($password, $user['password'])) {
                    // Autentikasi berhasil
                    echo "Authentication successful";
                    // Contoh pengaturan sesi:
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['name'] = $user['name'];
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['role'] = $user['role'];
                    header('Location: ' . BASE_URL . '/dashboard');
                    exit();
                } else {
                    $_SESSION['error'] = 'Invalid username or password'; // Simpan pesan kesalahan dalam sesi
                    header('Location: ' . BASE_URL . '/login'); // Kembalikan ke halaman login
                    exit();
                }
            } else {
                $_SESSION['error'] = 'User not found'; // Simpan pesan kesalahan dalam sesi
                header('Location: ' . BASE_URL . '/login'); // Kembalikan ke halaman login
                exit();
            }
        } else {
            header('Location: ' . BASE_URL . '/login');
            exit();
        }
    }  
}