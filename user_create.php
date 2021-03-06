<?php
include('functions.php');

if (
	!isset($_POST['username']) || $_POST['username'] == '' ||
	!isset($_POST['password']) || $_POST['password'] == ''
) {
	echo json_encode(["error_msg" => "no input"]);
	exit();
}

$username = $_POST['username'];
$password = $_POST['password'];
$is_admin = $_POST['is_admin'];
$is_deleted = $_POST['is_deleted'];

// var_dump($_POST);
// exit();

// DB接続
$pdo = connect_to_db();

$sql = 'INSERT INTO users_table(id,username,password,is_admin,is_deleted,created_at,updated_at) VALUES(NULL, :username, :password, :is_admin, :is_deleted, sysdate(),sysdate())';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':username', $username, PDO::PARAM_STR);
$stmt->bindValue(':password', $password, PDO::PARAM_STR);
$stmt->bindValue(':is_admin', $is_admin, PDO::PARAM_STR);
$stmt->bindValue(':is_deleted', $is_deleted, PDO::PARAM_STR);
$status = $stmt->execute();

if ($status == false) {
	$error = $stmt->errorInfo();
	echo json_encode(["error_msg" => "{$error[2]}"]);
	exit();
} else {
	header("Location:user_input.php");
	exit();
}
