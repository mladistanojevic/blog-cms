<?php

class Admin extends Controller
{

    public function __construct()
    {
        $this->postModel = $this->model('Post');
        $this->userModel = $this->model('User');
        $this->commentModel = $this->model('Comment');
    }

    public function dashboard()
    {
        if (!isLogged()) {
            header('location:' . URLROOT);
        }

        $blogNumber = $this->postModel->postNumber();
        $userNumber = $this->userModel->usernumber();
        $commentNumber = $this->commentModel->commentNumber();

        $data = [
            'blogNumber' => $blogNumber,
            'userNumber' => $userNumber,
            'commentNumber' => $commentNumber
        ];

        $this->view('admin/dashboard', $data);
    }

    public function blogs()
    {
        $posts = $this->postModel->getPostsAdmin();

        $data = [
            'posts' => $posts
        ];

        $this->view('admin/blogs', $data);
    }

    public function delete($post_id)
    {
        if (!isLogged()) {
            header('location:' . URLROOT);
        }
        if ($_SESSION['role'] != 'admin') {
            header('location:' . URLROOT);
        }
        $post = $this->postModel->getPostById($post_id);
        $data = [
            'post' => $post
        ];
        if ($this->postModel->delete($data)) {
            header('location:' . URLROOT . '/admin/blogs');
        } else {
            die('Something went wrong');
        }
    }

    public function users()
    {
        $users = $this->userModel->getAll();
        foreach ($users as $user) {
            $user->numberOfBlogs = $this->postModel->numberOfBlogsUser($user->user_id);
            $user->numberOfComments = $this->commentModel->numberOfCommentsUser($user->user_id);
        }
        $data = [
            'users' => $users
        ];

        $this->view('admin/users', $data);
    }

    public function deleteUser($user_id)
    {
        if (!isLogged()) {
            header('location:' . URLROOT);
        }
        if ($_SESSION['role'] != 'admin') {
            header('location:' . URLROOT);
        }

        $user = $this->userModel->getUserById($user_id);
        if (!$user) {
            header('location:' . URLROOT);
        }
        if ($this->userModel->delete($user_id)) {
            header('location:' . URLROOT . '/admin/users');
        } else {
            die('Something went wrong!');
        }
    }

    public function comments()
    {
        $comments = $this->commentModel->getAll();
        $data = [
            'comments' => $comments
        ];

        $this->view('admin/comments', $data);
    }

    public function deleteComment($comment_id)
    {
        if (!isLogged()) {
            header('location:' . URLROOT);
        }

        if ($_SESSION['role'] != 'admin') {
            header('location:' . URLROOT);
        }

        $comment = $this->commentModel->getCommentById($comment_id);
        if ($this->commentModel->deleteComment($comment)) {
            header('location:' . URLROOT . '/admin/comments');
        } else {
            die('Something went wrong!');
        }
    }

    public function profile($admin_id)
    {
        if (!isLogged()) {
            header('location:' . URLROOT);
        }

        if ($_SESSION['role'] != 'admin') {
            header('location:' . URLROOT);
        }

        $user = $this->userModel->getUserById($admin_id);

        $data = [
            'user' => $user
        ];

        $this->view('admin/profile', $data);
    }
}
