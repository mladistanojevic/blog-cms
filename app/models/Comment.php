<?php



class Comment
{

    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getPostsComments($post_id)
    {
        $stmt = $this->db->query("SELECT comments.comment,comments.comment_id,comments.created_at,users.user_id,users.first_name,users.last_name,users.email FROM comments JOIN users ON comments.user_id = users.user_id WHERE post_id = :post_id ");
        $stmt->execute(array(
            ':post_id' => $post_id
        ));
        $comments = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $comments;
    }

    public function getAll()
    {
        $stmt = $this->db->query("SELECT comments.comment_id,comments.comment,comments.created_at,users.first_name,users.last_name,users.email,posts.title FROM comments JOIN users JOIN posts ON comments.user_id = users.user_id AND comments.post_id = posts.post_id");
        $stmt->execute();
        $comments = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $comments;
    }

    public function commentNumber()
    {
        $stmt = $this->db->query("SELECT * FROM comments");
        $stmt->execute();
        $comments = $stmt->rowCount();
        return $comments;
    }

    public function numberOfComments($post_id)
    {
        $stmt = $this->db->query("SELECT * FROM comments WHERE post_id = :post_id");
        $stmt->execute(array(
            ':post_id' => $post_id
        ));
        $number = $stmt->rowCount();
        return $number;
    }

    public function comment($data)
    {
        $stmt = $this->db->query("INSERT INTO comments (post_id,user_id,comment,created_at) VALUES (:post_id,:user_id,:comment,:created_at)");
        if ($stmt->execute(array(
            ':post_id' => $data['post_id'],
            ':user_id' => $data['user_id'],
            ':comment' => $data['comment'],
            ':created_at' => $data['created_at'],
        ))) {
            return true;
        } else {
            return false;
        }
    }

    public function getCommentById($comment_id)
    {
        $stmt = $this->db->query("SELECT * FROM comments WHERE comment_id = :comment_id");
        $stmt->execute(array(
            ':comment_id' => $comment_id
        ));
        $comment = $stmt->fetch(PDO::FETCH_OBJ);
        return $comment;
    }

    public function deleteComment($comment)
    {
        $stmt = $this->db->query("DELETE FROM comments WHERE comment_id = :comment_id");
        if ($stmt->execute(array(
            ':comment_id' => $comment->comment_id
        ))) {
            return true;
        } else {
            return false;
        }
    }

    public function numberOfCommentsUser($user_id)
    {
        $stmt = $this->db->query("SELECT * FROM comments WHERE user_id = :user_id");
        $stmt->execute(array(
            ':user_id' => $user_id
        ));
        $number = $stmt->rowCount();
        return $number;
    }
}
