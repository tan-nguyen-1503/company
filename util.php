<?php
session_start();

$servername = "localhost";
$dBUsername = "root";
$dBPassword = "";
$dBName = "company";

$conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);
if (!$conn)
    die(json_encode("Connection Failed: " . mysqli_connect_error()));

function runQuery($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    if (!$result) {
        http_response_code(500);
        die(json_encode($conn->error));
    }
    return $result;
}

function setSuccessResponse($response = "")
{
    http_response_code(200);
    header("Content-Type: application/json");
    echo json_encode($response);
}
?>
