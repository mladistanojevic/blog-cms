<?php

class Post
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAllPosts($limit, $offset)
    {
        $stmt = $this->db->query("SELECT posts.post_id,posts.title,posts.body,posts.created_at,users.email,users.user_id,users.first_name,users.last_name,users.user_id FROM posts JOIN users WHERE posts.user_id = users.user_id LIMIT $limit OFFSET $offset");
        $stmt->execute();
        $posts = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $posts;
    }

    public function getPostsAdmin()
    {
        $stmt = $this->db->query("SELECT posts.post_id,posts.title,posts.body,posts.created_at,users.user_id,users.first_name,users.last_name,users.email FROM posts JOIN users WHERE posts.user_id = users.user_id");
        $stmt->execute();
        $posts = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $posts;
    }

    public function postNumber()
    {
        $stmt = $this->db->query("SELECT * FROM posts");
        $stmt->execute();
        $number = $stmt->rowCount();
        return $number;
    }

    public function getPostsById($user_id)
    {
        $stmt = $this->db->query("SELECT * FROM posts WHERE user_id = :user_id");
        $stmt->execute(array(
            ':user_id' => $user_id
        ));
        $posts = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $posts;
    }

    public function getPostById($id)
    {
        $stmt = $this->db->query("SELECT posts.post_id,posts.category,posts.title,posts.body,posts.created_at,users.user_id,users.first_name,users.last_name,users.email FROM posts JOIN users ON posts.user_id = users.user_id WHERE posts.post_id = :id");
        $stmt->execute(array(
            ':id' => $id
        ));
        $post = $stmt->fetch(PDO::FETCH_OBJ);
        return $post;
    }

    public function create($data)
    {
        $stmt = $this->db->query('INSERT INTO posts (user_id,category,title,body,created_at) VALUES (:user_id,:category,:title,:body,:created_at)');
        if ($stmt->execute(array(
            ':user_id' => $data['user_id'],
            ':category' => $data['category'],
            ':title' => $data['title'],
            ':body' => $data['body'],
            ':created_at' => $data['created_at']
        ))) {
            return true;
        } else {
            return false;
        }
    }

    public function update($data)
    {
        $stmt = $this->db->query("UPDATE posts SET category = :category,title = :title, body = :body WHERE post_id = :post_id");
        if ($stmt->execute(array(
            ':category' => $data['category'],
            ':title' => $data['title'],
            ':body' => $data['body'],
            ':post_id' => $data['post_id']
        ))) {
            return true;
        } else {
            return false;
        }
    }

    public function delete($data)
    {
        $stmt = $this->db->query('DELETE FROM posts WHERE post_id = :id');
        if ($stmt->execute(array(
            ':id' => $data['post']->post_id
        ))) {
            return true;
        } else {
            return false;
        }
    }

    public function numberOfBlogsUser($user_id)
    {
        $stmt = $this->db->query("SELECT * FROM posts WHERE user_id = :user_id");
        $stmt->execute(array(
            ':user_id' => $user_id
        ));
        $number = $stmt->rowCount();
        return $number;
    }
}
