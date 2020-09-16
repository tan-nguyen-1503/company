<?php
require '../util.php';
if (!isset($_SESSION['isAdmin']) || !$_SESSION['isAdmin']){
    http_response_code(403);
} else {
    include $_SERVER['DOCUMENT_ROOT'] . '/model/Branch.php';
    switch ($_SERVER['REQUEST_METHOD']){
        case 'POST':{
            $data = json_decode(file_get_contents("php://input", "r"));
            $branch = new Branch($data);
            $branch->create();
            setSuccessResponse("Created branch successfully");
            break;
        }
        case 'PUT': {
            $data = json_decode(file_get_contents("php://input", "r"));
            $branch = new Branch($data);
            $branch->update();
            setSuccessResponse("Updated branch successfully");
            break;
        }
        case 'DELETE':{
            $data = json_decode(file_get_contents("php://input", "r"));
            Branch::delete($data->id);
            setSuccessResponse("Deleted branch successfully");
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
