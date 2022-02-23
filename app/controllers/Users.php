<?php

class Users extends Controller
{

    public function __construct()
    {
        $this->userModel = $this->model('User');
        $this->postModel = $this->model('Post');
    }

    public function index()
    {
        $users = $this->userModel->getAll();

        $data = [
            'users' => $users
        ];

        $this->view('users/index', $data);
    }

    public function profile($user_id)
    {
        $user = $this->userModel->getUserById($user_id);
        $posts = $this->postModel->getPostsById($user_id);

        $data = [
            'user' => $user,
            'posts' => $posts
        ];

        $this->view('users/profile', $data);
    }
}
