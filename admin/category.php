<?php
require '../util.php';
if (!isset($_SESSION['isAdmin']) || !$_SESSION['isAdmin']){
    http_response_code(403);
} else {
    switch ($_SERVER['REQUEST_METHOD']){
        case 'POST':{
            include '../model/Category.php';
            $data = json_decode(file_get_contents("php://input", "r"));
            $category = new Category($data);
            $category->create();
            setSuccessResponse("Created category successfully");
            break;
        }
        case 'PUT': {
            include '../model/Category.php';
            $data = json_decode(file_get_contents("php://input", "r"));
            $category = new Category($data);
            $category->update();
            setSuccessResponse("Updated category successfully");
            break;
        }
        case 'GET': {
            if (isset($_GET['id']))
                include '../view/admin_category_detail_view.php';
            elseif (isset($_GET['create']))
                include '../view/admin_category_create_view.php';
            else
                include '../view/admin_category_list_view.php';
            break;
        }
        default:
            http_response_code(405);
            break;
    }
}
