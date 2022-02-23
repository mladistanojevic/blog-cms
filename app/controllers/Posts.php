<?php

class Posts extends Controller
{

    public function __construct()
    {
        $this->postModel = $this->model('Post');
        $this->commentModel = $this->model('Comment');
    }

    public function index()
    {
        $pager = $this->model('Pager');
        $limit = 2;
        $pager->index($limit);

        $offset = $pager->offset;


        $posts = $this->postModel->getAllPosts($limit, $offset);
        $data = [
            'posts' => $posts,
            'pager' => $pager
        ];

        $this->view('posts/index', $data);
    }

    public function post($post_id)
    {
        $post = $this->postModel->getPostById($post_id);
        $comments = $this->commentModel->getPostsComments($post_id);
        $numberOfComments = $this->commentModel->numberOfComments($post_id);

        $data = [
            'post' => $post,
            'comments' => $comments,
            'numberOfComments' => $numberOfComments,
            'commentError' => ''
        ];

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'post' => $post,
                'comments' => $comments,
                'numberOfComments' => $numberOfComments,
                'post_id' => $post_id,
                'user_id' => $_SESSION['user_id'],
                'comment' => $_POST['comment'],
                'created_at' => date('Y-m-d H:i:s'),
                'commentError' => ''
            ];

            //Validate comment
            if (empty($data['comment'])) {
                $data['commentError'] = 'Please write a comment';
            }

            if (empty($data['commentError'])) {
                if ($this->commentModel->comment($data)) {
                    header('location:' . URLROOT . '/posts/post/' . $data['post']->post_id);
                } else {
                    echo "something went wrong!";
                }
            }
        }

        $this->view('posts/post', $data);
    }

    public function deleteComment($post_id, $comment_id)
    {
        if (!isLogged()) {
            header('location:' . URLROOT . '/login');
        }

        $comment = $this->commentModel->getCommentById($comment_id);

        if ($_SESSION['user_id'] != $comment->user_id) {
            header('location:' . URLROOT . '/posts');
        }

        if ($this->commentModel->deleteComment($comment)) {
            header('location:' . URLROOT . '/posts/post/' . $post_id);
        } else {
            die('Something went wrong');
        }
    }

    public function create()
    {
        if (!isLogged()) {
            header('location:' . URLROOT . '/login');
        }
        $data = [
            'titleError' => '',
            'bodyError' => ''
        ];

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'user_id' => $_SESSION['user_id'],
                'category' => trim($_POST['category']),
                'title' => trim($_POST['title']),
                'body' => trim($_POST['body']),
                'created_at' => date('Y-m-d H:i:s'),
                'titleError' => '',
                'bodyError' => ''
            ];

            //Validate title
            if (empty($data['title'])) {
                $data['titleError'] = 'Please enter title';
            }

            //Validate body
            if (empty($data['body'])) {
                $data['bodyError'] = 'Please enter body';
            }

            if (empty($data['titleError']) && empty($data['bodyError'])) {
                if ($this->postModel->create($data)) {
                    header('location:' . URLROOT . '/posts');
                } else {
                    die('Something went wrong!');
                }
            }
        }

        $this->view('posts/create', $data);
    }

    public function update($post_id)
    {

        if (!isLogged()) {
            header('location:' . URLROOT . '/login');
        }

        $post = $this->postModel->getPostById($post_id);

        if (!$post) {
            header('location:' . URLROOT . '/posts');
        }

        if ($_SESSION['user_id'] != $post->user_id) {
            header('location:' . URLROOT . '/posts');
        }

        $data = [
            'post' => $post,
            'titleError' => '',
            'bodyError' => ''
        ];

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'post' => $post,
                'post_id' => $post_id,
                'category' => trim($_POST['category']),
                'title' => trim($_POST['title']),
                'body' => trim($_POST['body']),
                'categoryError' => '',
                'titleError' => '',
                'bodyError' => ''
            ];

            //Validate title
            if (empty($data['title'])) {
                $data['titleError'] = "Please enter new title";
            }

            //Validate body
            if (empty($data['body'])) {
                $data['bodyError'] = "Please enter a blog";
            }

            if (empty($data['titleError']) && empty($data['bodyError'])) {
                if ($this->postModel->update($data)) {
                    header('location:' . URLROOT . '/posts');
                } else {
                    die('Something went wrong!');
                }
            }
        }

        $this->view('posts/update', $data);
    }

    public function delete($post_id)
    {
        if (!isLogged()) {
            header('location:' . URLROOT . '/login');
        }

        $post = $this->postModel->getPostById($post_id);

        if (!$post) {
            header('location:' . URLROOT . '/posts');
        }

        if ($_SESSION['user_id'] != $post->user_id) {
            header('location:' . URLROOT . '/posts');
        }

        $data = [
            'post' => $post
        ];

        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            if ($this->postModel->delete($data)) {
                header('location:' . URLROOT . '/posts');
            } else {
                die('Something went wrong!');
            }
        }
    }
}
