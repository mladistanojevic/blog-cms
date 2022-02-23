<?php

class Login extends Controller
{

    public function __construct()
    {
        $this->userModel = $this->model('User');
    }

    public function index()
    {
        $data = [
            'emailError' => '',
            'passwordError' => ''
        ];

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'emailError' => '',
                'passwordError' => ''
            ];

            //Validate email
            if (empty($data['email'])) {
                $data['emailError'] = "Please enter an email";
            }

            //Validate password
            if (strlen($data['password']) < 7) {
                $data['passwordError'] = "Password must be at least 7 characters!";
            }

            if (empty($data['emailError']) && empty($data['passwordError'])) {
                $loggedUser = $this->userModel->login($data);
                if ($loggedUser) {
                    $this->createSession($loggedUser);
                } else {
                    $data['passwordError'] = "Wrong email or password!";
                }
            }
        }

        $this->view('login', $data);
    }

    public function createSession($user)
    {
        $_SESSION['user_id'] = $user->user_id;
        $_SESSION['role'] = $user->role;
        $_SESSION['email'] = $user->email;
        $_SESSION['first_name'] = $user->first_name;
        header('location:' . URLROOT . '/posts');
    }
}
