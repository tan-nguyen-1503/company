<?php
require 'util.php';
$userId = $_SESSION['userId'];
if (!isset($userId)){
    http_response_code(401);
    header("Location: login.php");
}
else{
    require 'model/User.php';
    switch ($_SERVER['REQUEST_METHOD']){
        case 'GET':
            include 'view/profile_view.php';
            break;
        case 'POST':{
            // change data;
            $data = json_decode(file_get_contents("php://input", "r"));
            $user = new User($data);
            $user->id = $userId;
            $user->update();
            setSuccessResponse("Update profile successfully");
            break;
        }
        case 'PUT':{
            //change password
            $data = json_decode(file_get_contents("php://input", "r"));
            $user = User::getById($userId);
            if ($user->checkOldPassword($data->oldPassword)){
                $user->validatePassword($data->password, $data->confirmPassword);
                $user->changePassword($data->password);
                setSuccessResponse("Changed password successfully");
            } else {
                badRequestResponse("Wrong old password");
            }
            break;
        }
        default:
            http_response_code(405);
            break;
    }
}
?>
