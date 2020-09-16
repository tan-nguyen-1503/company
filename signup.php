<?php
require 'util.php';
switch ($_SERVER['REQUEST_METHOD']){
    case 'POST':{
        include_once './model/User.php';
        $data = json_decode(file_get_contents("php://input", "r"));
        $user = new User($data);
        $user->validatePassword($data->password, $data->confirmPassword);
        $user->create();
        $_SESSION['userId'] = $conn->insert_id;
        $_SESSION['isAdmin'] = false;
        setSuccessResponse("Created user successfully");
        break;
    }
    case 'GET':{
        require './LayOut/header.php';
        require "./view/singup_view.php";
        require './LayOut/footer.php';
        break;
    }
    default:
        http_response_code(405);
}
?>
