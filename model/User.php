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
        if (isset($object->name))
            $this->name = $object->name;
        if (isset($object->password)) // update -> no password
            $this->password = $object->password;
        if (isset($object->email))
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
        $query = "INSERT INTO user (`name`, `password`, `email`) VALUES (?, ?, ?)";
        $param = ["sss", &$this->name, &$this->password, &$this->email];
        $result = runQuery($query, $param, false);
    }

    public function update($isAdmin = false)
    {
        if ($isAdmin){
            // change password & isActive.
            $query = "UPDATE user SET password = ?, is_active = ? WHERE id = ?";
            $param = ["sii", &$this->password, &$this->is_active, &$this->id];
        }else{
            $query = "UPDATE user SET name = ?, date_of_birth = ? WHERE id = ?";
            $param = ["ssi", &$this->name, &$this->date_of_birth, &$this->id];
        }
        if (!runQuery($query, $param, false)) {
           badRequestResponse("Fail to update user");
        }
    }

    public function changePassword($password)
    {
        $query = "UPDATE user SET password = ? WHERE id = ?";
        $param = ["si", &$password, &$this->id];
        if (runQuery($query, $param, false) == 0) {
            badRequestResponse("Unexisting user");
        }
    }

    public static function getById($id)
    {
        $query = "SELECT * FROM user WHERE id = ?";
        $param = ["i", &$id];
        $result = runQuery($query, $param);
        if ($result->num_rows == 0) {
            badRequestResponse("Unexisting user");
        }
        return new User($result->fetch_object());
    }

    public static function getByPage($pageNum, $pageSize){
        $offset = $pageNum * $pageSize;
        $query = "SELECT * FROM user LIMIT ? OFFSET ?";
        $param = ["ii", $pageSize, $offset];
        $result = runQuery($query, $param);
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

    public static function login($email, $password){
        $query = "SELECT * FROM user WHERE email = ? AND password = ?";
        $param = ['ss', &$email, &$password];
        $result = runQuery($query, $param);
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

    public function checkOldPassword($password){
        return $this->password == $password;
    }

    public function validatePassword($password, $confirmPassword){
        if ($password != $confirmPassword){
            http_response_code(400);
            die(json_encode("Two password does not match"));
        }
        if (strlen($password) < 8){
            http_response_code(400);
            die(json_encode("Password length must be larger than 8"));
        }
    }

    public static function updateAvatar($avatar, $userId){
        $query = "UPDATE user SET `avatar` = ? WHERE id = ?";
        $param = ["si", &$avatar, &$userId];
        if (runQuery($query, $param, false) == 0) {
            badRequestResponse("Unexisting user");
        }
    }
}
