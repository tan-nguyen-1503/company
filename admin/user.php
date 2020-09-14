<?php
require '../util.php';
if (!isset($_SESSION['isAdmin']) || !$_SESSION['isAdmin']){
    http_response_code(403);
} else {
    require '../model/User.php';
    switch ($_SERVER['REQUEST_METHOD']){
        case 'PUT': {
            $data = json_decode(file_get_contents("php://input", "r"));
            $user = new User($data);
            $user->update(true);
            setSuccessResponse("Updated user successfully");
            break;
        }
        case 'GET':{
            if (isset($_GET['id']))
                include '../view/admin_user_detail_view.php';
            else
                include '../view/admin_user_list_view.php';
            break;
        }
        default:
            http_response_code(405);
            break;
    }
}
