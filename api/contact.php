<?php
header("Content-Type: application/json");
require_once "../config.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    http_response_code(405);
    echo json_encode(["success"=>false,"message"=>"POST required"]);
    exit;
}

$name = trim($_POST["name"] ?? "");
$email = trim($_POST["email"] ?? "");
$message = trim($_POST["message"] ?? "");

if ($name === "" || !filter_var($email, FILTER_VALIDATE_EMAIL) || $message === "") {
    http_response_code(422);
    echo json_encode(["success"=>false,"message"=>"Please provide valid name, email and message."]);
    exit;
}

if ($pdo) {
    $stmt=$pdo->prepare("INSERT INTO contact_messages(name,email,message) VALUES(?,?,?)");
    $stmt->execute([$name,$email,$message]);
}
echo json_encode(["success"=>true,"message"=>"Message received successfully."]);
?>
