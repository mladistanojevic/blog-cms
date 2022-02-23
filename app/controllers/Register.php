<?php

class Register extends Controller
{

    public function __construct()
    {
        $this->userModel = $this->model('User');
    }

    public function index()
    {
        $data = [
            'first_nameError' => '',
            'last_nameError' => '',
            'emailError' => '',
            'passwordError' => '',
            'confirm_passwordError' => '',
            'ageError' => ''
        ];

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'first_name' => trim($_POST['first_name']),
                'last_name' => trim($_POST['last_name']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'age' => trim($_POST['age']),
                'gender' => trim($_POST['gender']),
                'created_at' => date('Y-m-d H:i:s'),
                'first_nameError' => '',
                'last_nameError' => '',
                'emailError' => '',
                'passwordError' => '',
                'confirm_passwordError' => '',
                'ageError' => ''
            ];

            //Validate firstname
            if (empty($data['first_name'])) {
                $data['first_nameError'] = "Please enter first name";
            }

            //Validate lastname
            if (empty($data['last_name'])) {
                $data['last_nameError'] = "Please enter last name";
            }

            //Validate email
            if (empty($data['email'])) {
                $data['emailError'] = "Please enter an email";
            }

            if ($this->userModel->getUserByEmail($data['email'])) {
                $data['emailError'] = "Email already exists!";
            }

            //Validate password
            if (strlen($data['password']) < 7) {
                $data['passwordError'] = "Password must have at least 7 characters!";
            }

            //Validate confirm password
            if ($data['password'] != $data['confirm_password']) {
                $data['confirm_passwordError'] = "Passwords do not match!";
            }

            //Validate age
            if (empty($data['age'])) {
                $data['ageError'] = "Please enter you age";
            }

            //Check if all errors are empty
            if (empty($data['first_nameError']) && empty($data['last_nameError']) && empty($data['emailError']) && empty($data['passwordError']) && empty($data['confirm_passwordError']) && empty($data['ageError'])) {
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
                if ($this->userModel->register($data)) {
                    header('location:' . URLROOT . '/login');
                } else {
                    die('Something went wrong!');
                }
            }
        }

        $this->view('register', $data);
    }
}
