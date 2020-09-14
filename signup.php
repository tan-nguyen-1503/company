<?php
require 'util.php';
include_once './model/User.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $data = json_decode(file_get_contents("php://input", "r"));
    $user = new User($data);
    $user->validatePassword($data->password, $data->confirmPassword);
    $user->create();
    $_SESSION['userId'] = $conn->insert_id;
    $_SESSION['isAdmin'] = false;
    setSuccessResponse("Created user successfully");
} else {
    require './LayOut/header.php';
    require "./view/singup_view.php";
    require './LayOut/footer.php';
}
?>
