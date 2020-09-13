<?php


class PostComment
{
    public $id;
    public $post_id;
    public $user;
    public $comment;
    public $comment_time;

    #constructor from db response
    public function __construct($object)
    {
        if (isset($object->id)) //create -> no id
            $this->id = $object->id;
        $this->post_id = $object->post_id;
        if (isset($object->name)) // name in table user
            $this->user = $object->name;
        $this->comment = $object->comment;
        if (isset($object->comment_time))
            $this->comment_time = $object->comment_time;
    }

    public function create($user_id)
    {
        $query = "INSERT INTO post_comment (`post_id`, `user_id`, `comment`)
            VALUES ('$this->post_id', '$user_id', '$this->comment')";
        runQuery($query);
    }

    public static function getById($id)
    {
        $query = "SELECT p.*, u.name FROM post_comment p LEFT JOIN user u on u.id = p.user_id WHERE p.id = $id";
        $result = runQuery($query);
        if (mysqli_num_rows($result) == 0) {
            http_response_code(404);
            die();
        }
        return new PostComment($result->fetch_object());
    }

    public static function getAll()
    {
        $query = "SELECT * FROM user";
        $result = runQuery($query);
        $response = [];
        while ($row = $result->fetch_object()) {
            array_push($response, new PostComment($row));
        }
        return $response;
    }

    public static function getByPage($pageNum, $pageSize){
        $offset = $pageNum * $pageSize;
        $query = "SELECT * FROM post_comment ORDER BY comment_time DESC LIMIT $pageSize OFFSET $offset";
        $result = runQuery($query);
        $response = [];
        while ($row = $result->fetch_object()) {
            array_push($response, new PostComment($row));
        }
        return $response;
    }

    public static function countAllByPost($postId){
        $query = "SELECT COUNT(*) AS total FROM post_comment WHERE post_id = $postId";
        $result = runQuery($query);
        return $result->fetch_object()->total;
    }
}
