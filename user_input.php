<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>ユーザー作成画面（input）</title>
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
		<form action="user_create.php" method="POST">
			<fieldset>
				<legend>ユーザ作成画面</legend>
				<a href="user_read.php">一覧画面</a>
				<div>
					<p><label>ユーザ名:</label> <input type="text" name="username"></p>
					<p><label>パスワード:</label>
						<input type="password" name="password" id="txtPass">
						<span id="btnEye" class="fa fa-eye" onclick="pushHideButton()"></span>
					</p>
					<p class="btn"><input type="submit" value="登録">　<input type="reset" value="リセット"></p>
					<p><input type="hidden" name="is_admin" value="0"></p>
					<p><input type="hidden" name="is_deleted" value="0"></p>
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