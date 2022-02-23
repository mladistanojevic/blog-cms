<?php


class Search extends Controller
{

    public function __construct()
    {
        $this->apiModel = $this->model('Api');
    }

    public function index()
    {
        if (count($_POST) > 0) {
            $text = $_POST['text'];
            $users = $this->apiModel->search($text);
            echo json_encode($users);
        }
    }
}
