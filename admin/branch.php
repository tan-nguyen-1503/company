<?php
require '../util.php';
if (!isset($_SESSION['isAdmin']) || !$_SESSION['isAdmin']){
    http_response_code(403);
} else {
    switch ($_SERVER['REQUEST_METHOD']){
        case 'POST':{
            include '../model/Post.php';
            $data = json_decode(file_get_contents("php://input", "r"));
            $branch = new Branch($data);
            $branch->create();
            setSuccessResponse("Created branch successfully");
            break;
        }
        case 'PUT': {
            include '../model/Post.php';
            $data = json_decode(file_get_contents("php://input", "r"));
            $branch = new Branch($data);
            $branch->update();
            setSuccessResponse("Updated branch successfully");
            break;
        }
        case 'DELETE':{
            include '../model/Post.php';
            $data = json_decode(file_get_contents("php://input", "r"));
            Branch::delete($data->id);
            setSuccessResponse("Updated branch successfully");
            break;
        }
        case 'GET':{
            if (isset($_GET['id']) || isset($_GET['create']))
                include '../view/admin_branch_detail_view.php';
            else
                include '../view/admin_branch_list_view.php';
            break;
        }
        default:
            http_response_code(405);
            break;
    }
}
