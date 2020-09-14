<?php
require 'util.php';
if (isset($_SESSION['userId'])){
    http_response_code(302);
    header("Location: index.php");
}
elseif ($_SERVER['REQUEST_METHOD'] == 'POST'){
    include './model/User.php';
    $data = json_decode(file_get_contents("php://input", "r"));
    $user = User::login($data->email, $data->password);
    $_SESSION['userId'] = $user->id;
    $_SESSION['isAdmin'] = $user->is_admin;
//    setSuccessResponse($user);
}else {
    include "./view/login_view.php";
}
?>
