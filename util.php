<?php
session_start();

$documentRoot = $_SERVER['DOCUMENT_ROOT'];

$servername = "localhost";
$dBUsername = "root";
$dBPassword = "";
$dBName = "company";

$conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);
if (!$conn)
    serverErrorResponse("Connection Failed: " . mysqli_connect_error());

function runQuery($query, $param = null, $isSelect = true)
{
    global $conn;
    $stmt = $conn->prepare($query);
    if ($param != null){
        call_user_func_array(array($stmt, 'bind_param'), $param);
    }

    if (!$stmt->execute()) {
        serverErrorResponse($conn->error);
    }
    if ($isSelect)
        return $stmt->get_result();
    else
        return $stmt->affected_rows;
}

function setSuccessResponse($response = "")
{
    http_response_code(200);
    header("Content-Type: application/json");
    echo json_encode($response);
}

function badRequestResponse($error = "")
{
    http_response_code(400);
    header("Content-Type: application/json");
    die(json_encode($error));
}

function serverErrorResponse($error = ""){
    http_response_code(500);
    header("Content-Type: application/json");
    die(json_encode($error));
}

?>
