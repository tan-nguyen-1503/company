<?php
require 'util.php';
if (isset($_SESSION['userId'])){
    http_response_code(302);
    if ($_SESSION['isAdmin'])
        echo "Is admin";
}
elseif ($_SERVER['REQUEST_METHOD'] == 'POST'){
    include_once './model/User.php';
    $data = json_decode(file_get_contents("php://input", "r"));
    $user = User::login($data->email, $data->password);
    $_SESSION['userId'] = $user->id;
    $_SESSION['isAdmin'] = $user->is_admin;
    setSuccessResponse($user);
}else {
    require './LayOut/header.php';
    require "./view/login.html";
    require './LayOut/footer.php';
}
?>
