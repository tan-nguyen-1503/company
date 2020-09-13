<?php
require '../util.php';
//view, edit about us in admin page
if (!isset($_SESSION['isAdmin']) || !$_SESSION['isAdmin']){
    http_response_code(403);
} else {
    switch ($_SERVER['REQUEST_METHOD']){
        case 'PUT': {
            include '../model/About.php';
            $data = json_decode(file_get_contents("php://input", "r"));
            $about = new About($data);
            $about->update();
            setSuccessResponse("Updated successfully");
            break;
        }
        case 'GET':
            include '../view/admin_about_us_view.php';
            break;
        default:
            http_response_code(405);
            break;
    }
}
