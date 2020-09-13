<?php


class User
{
    public $id;
    public $name;
    private $password;
    public $email;
    public $date_of_birth;
    public $avatar;
    public $is_admin = false;
    public $is_active = true;

    #constructor from db response
    public function __construct($object)
    {
        if (isset($object->id)) //create -> no id
            $this->id = $object->id;
        $this->name = $object->name;
        if (isset($object->password)) // update -> no password
            $this->password = $object->password;
        $this->email = $object->email;
        if (isset($object->date_of_birth))
            $this->date_of_birth = $object->date_of_birth;
        if (isset($object->avatar))
            $this->avatar = $object->avatar;
        if (isset($object->is_admin))
            $this->is_admin = $object->is_admin;
        if (isset($object->is_active))
            $this->is_active = $object->is_active;
    }

    public function create()
    {
        $query = "INSERT INTO user (`name`, `password`, `email`, `date_of_birth`, `avatar`, `is_admin`, `is_active`)
            VALUES ('$this->name', '$this->password', '$this->email', '$this->date_of_birth', '$this->avatar', '$this->is_admin', '$this->is_active')";
        runQuery($query);
    }

    public function update()
    {
        $query = "UPDATE user SET name = $this->name, date_of_birth = $this->date_of_birth, avatar = $this->avatar
                WHERE id = $this->id";
        runQuery($query);
    }

    public function changePassword($password)
    {
        $query = "UPDATE user SET password = $password WHERE id =$this->id";
        runQuery($query);
    }

    public static function getById($id)
    {
        $query = "SELECT * FROM user WHERE id = $id";
        $result = runQuery($query);
        if (mysqli_num_rows($result) == 0) {
            http_response_code(404);
            die();
        }
        return new User($result->fetch_object());
    }

    public static function getAll()
    {
        $query = "SELECT * FROM user";
        $result = runQuery($query);
        $response = [];
        while ($row = $result->fetch_object()) {
            array_push($response, new User($row));
        }
        return $response;
    }

    public static function getByPage($pageNum, $pageSize){
        $offset = $pageNum * $pageSize;
        $query = "SELECT * FROM user LIMIT $pageSize OFFSET $offset";
        $result = runQuery($query);
        $response = [];
        while ($row = $result->fetch_object()) {
            array_push($response, new User($row));
        }
        return $response;
    }

    public static function countAll(){
        $query = "SELECT COUNT(*) AS total FROM user";
        $result = runQuery($query);
        return $result->fetch_object()->total;
    }

    public static function delete($id)
    {
        $query = "UPDATE user SET is_active = false WHERE id = $id";
        runQuery($query);
    }

    public static function login($email, $password){
        $query = "SELECT * FROM user WHERE email = '$email' AND password = '$password'";
        $result = runQuery($query);
        if (mysqli_num_rows($result) == 0) {
            http_response_code(401);
            die(json_encode("Wrong username or password"));
        }
        $user = new User($result->fetch_object());
        if ($user->is_active)
            return $user;
        else{
            http_response_code(403);
            die(json_encode("User is inactivate"));
        }
    }
}
