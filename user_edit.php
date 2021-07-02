<?php
include('functions.php');
$id = $_GET['id'];
// DB接続
$pdo = connect_to_db();
$sql = 'SELECT * FROM users_table WHERE id=:id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

if ($status == false) {
	$error = $stmt->errorInfo();
	echo json_encode(["error_msg" => "{$error[2]}"]);
	exit();
} else {
	$record = $stmt->fetch(PDO::FETCH_ASSOC);
}
// var_dump('$_GET');
// exit;
?>

<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>ユーザデータ更新画面（edit）</title>
	<link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
	<style>
		label {
			display: inline-block;
			text-align: right;
			width: 100px;
		}

		.btn {
			display: inline-block;
			padding-left: 80px;
		}
	</style>
</head>

<body>
	<main>
		<form action="user_update.php" method="POST">
			<fieldset>
				<legend>ユーザデータ更新画面</legend>
				<a href="user_read.php">一覧画面</a>
				<div>
					<p><label>ユーザ名:</label> <input type="text" name="username" value="<?= $record['username'] ?>"></p>
					<p><label>パスワード:</label>
						<input type="text" name="password" id="txtPass" value="<?= $record['password'] ?>">
						<span id="btnEye" class="fa fa-eye" onclick="pushHideButton()"></span>
					</p>
					<p class="btn"><input type="submit" value="更新">　<input type="reset" value="リセット"></p>
					<input type="hidden" name="id" value="<?= $record['id'] ?>">
					<p><input type="number" name="is_admin" value="<?= $record['is_admin'] ?>"></p>
					<p><input type="number" name="is_deleted" value="<?= $record['is_deleted'] ?>"></p>
				</div>
			</fieldset>
		</form>
	</main>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script>
		function pushHideButton() {
			var txtPass = document.getElementById("txtPass");
			var btnEye = document.getElementById("btnEye");
			if (txtPass.type === "text") {
				txtPass.type = "password";
				btnEye.className = "fa fa-eye";
			} else {
				txtPass.type = "text";
				btnEye.className = "fa fa-eye-slash";
			}
		}
	</script>
</body>

</html>