<?php
require '../util.php';
if (!isset($_SESSION['isAdmin']) || !$_SESSION['isAdmin']){
    http_response_code(403);
} else {
    switch ($_SERVER['REQUEST_METHOD']){
        case 'POST':{
            include '../model/Post.php';
            $data = json_decode(file_get_contents("php://input", "r"));
            $product = new Product($data);
            $product->create();
            setSuccessResponse("Created product successfully");
            break;
        }
        case 'PUT': {
            include '../model/Post.php';
            $data = json_decode(file_get_contents("php://input", "r"));
            $product = new Product($data);
            $product->update();
            setSuccessResponse("Updated product successfully");
            break;
        }
        case 'DELETE':{
            include '../model/Post.php';
            $data = json_decode(file_get_contents("php://input", "r"));
            Product::delete($data->id);
            setSuccessResponse("Deleted product successfully");
            break;
        }
        case 'GET':{
            if (isset($_GET['id']) || isset($_GET['create']))
                include '../view/admin_product_detail_view.php';
            else
                include '../view/admin_product_list_view.php';
            break;
        }
        default:
            http_response_code(405);
            break;
    }
}
