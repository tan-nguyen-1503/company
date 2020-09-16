<?php
require 'util.php';
if (isset($_SESSION['userId'])){
    http_response_code(302);
    header("Location: index.php");
}
else {
    switch ($_SERVER['REQUEST_METHOD']){
        case 'POST':{
            include './model/User.php';
            $data = json_decode(file_get_contents("php://input", "r"));
            $user = User::login($data->email, $data->password);
            $_SESSION['userId'] = $user->id;
            $_SESSION['isAdmin'] = $user->is_admin;
            break;
        }
        case 'GET':{
             include "./view/login_view.php";
             break;
        }
        default:
            http_response_code(405);
    }
}
?>
