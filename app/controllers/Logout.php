<?php


class Logout
{

    public function index()
    {
        unset($_SESSION['user_id']);
        unset($_SESSION['role']);
        unset($_SESSION['email']);
        unset($_SESSION['first_name']);
        header('location:' . URLROOT . '/login');
    }
}
