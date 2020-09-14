<?php
session_start();

$servername = "localhost";
$dBUsername = "root";
$dBPassword = "";
$dBName = "company";

$conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);
if (!$conn)
    die(json_encode("Connection Failed: " . mysqli_connect_error()));

function runQuery($query, $param = null, $isSelect = true)
{
    global $conn;
    $stmt = $conn->prepare($query);
    if ($param != null){
        call_user_func_array(array($stmt, 'bind_param'), $param);
    }

    if (!$stmt->execute()) {
        http_response_code(500);
        die(json_encode($conn->error));
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

?>
