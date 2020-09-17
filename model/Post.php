<?php


class Post
{
    public $id;
    public $title;
    public $content;
    public $author; //name of author
    public $date;
    public $image;
    public $is_active = true;

    #constructor from db response
    public function __construct($object)
    {
        if (isset($object->id)) //create -> no id
            $this->id = $object->id;
        if (isset($object->title))
            $this->title = $object->title;
        if (isset($object->content))
            $this->content = $object->content;
        if (isset($object->name))
            $this->author = $object->name; //name of the user table
        if (isset($object->date)) //auto create date
            $this->date = $object->date;
        if (isset($object->image))
            $this->image = $object->image;
        if (isset($object->is_active))
            $this->is_active = $object->is_active;
    }

    public function create($author_id)
    {
        $query = "INSERT INTO post (`title`, `content`, author_id) VALUES (?, ?, ?)";
        $param = ["ssi", &$this->title, &$this->content, &$author_id];
        if (!runQuery($query, $param, false)){
            badRequestResponse("Fail to create post");
        }
        return $conn->insert_id;
    }

    public function update()
    {
        $query = "UPDATE post SET title = ?, content = ? WHERE id = ?";
        $param = ["sssi", &$this->title, &$this->content, &$this->id];
        if (!runQuery($query, $param, false))
            badRequestResponse("Fail to update post");
    }

    public static function getById($id)
    {
        $query = "SELECT p.*, u.name FROM post p LEFT JOIN user u ON p.author_id = u.id WHERE p.id = ?";
        $result = runQuery($query, ["i", &$id]);
        if (mysqli_num_rows($result) == 0) {
            badRequestResponse("Invalid post");
        }
        return new Post($result->fetch_object());
    }

    public static function getAll()
    {
        $query = "SELECT p.*, u.name FROM post p LEFT JOIN user u ON p.author_id = u.id";
        $result = runQuery($query);
        $response = [];
        while ($row = $result->fetch_object()) {
            array_push($response, new Post($row));
        }
        return $response;
    }

    public static function getAllByPage($pageNum, $pageSize){
        $offset = $pageNum * $pageSize;
        $query = "SELECT * FROM post ORDER BY date DESC LIMIT ? OFFSET ?";
        $param = ["ii", &$pageSize, &$offset];
        $result = runQuery($query, $param);
        $response = [];
        while ($row = $result->fetch_object()) {
            array_push($response, new Post($row));
        }
        return $response;
    }

    public static function getActiveByPage($pageNum, $pageSize){
        $offset = $pageNum * $pageSize;
        $query = "SELECT * FROM post WHERE is_active = true ORDER BY date DESC LIMIT ? OFFSET ?";
        $param = ["ii", &$pageSize, &$offset];
        $result = runQuery($query, $param);
        $response = [];
        while ($row = $result->fetch_object()) {
            array_push($response, new Post($row));
        }
        return $response;
    }

    public static function countAll(){
        $query = "SELECT COUNT(*) AS total FROM post";
        $result = runQuery($query);
        return $result->fetch_object()->total;
    }

    public static function countAllActive(){
        $query = "SELECT COUNT(*) AS total FROM post WHERE is_active=true";
        $result = runQuery($query);
        return $result->fetch_object()->total;
    }


    public static function delete($id)
    {
        $query = "UPDATE post SET is_active = false WHERE id = ?";
        if (!runQuery($query, ["i", &$id], false)) {
            badRequestResponse("Invalid post");
        }
    }
}
