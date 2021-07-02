<?php
include('functions.php');
// DB接続
$pdo = connect_to_db();
$sql = 'SELECT * FROM users_table';  // 一覧参照なのでWHERE不要
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

// var_dump($_POST);
// exit;

if ($status == false) {
	echo json_encode(["error_msg" => "{$error[2]}"]);
	exit;
} else {
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	$output = "";
	foreach ($result as $record) {
		$output .= "<tr>";
		$output .= "<td>{$record["username"]}</td>";
		$output .= "<td>{$record["password"]}</td>";
		$output .= "<td><a href=user_edit.php?id={$record["id"]}>編集</a></td>";
		$output .= "<td><a href=user_delete.php?id={$record["id"]} onclick='return confirm_del();'>削除</a></td>";
		$output .= "</tr>";
	}
	unset($record);
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>ユーザ一覧参照&表示（read）</title>
	<style>
		table {
			width: 500px;
			border-spacing: 0;
		}

		table th {
			border-bottom: solid 2px cadetblue;
			padding: 3px 0;
		}

		table td {
			border-bottom: solid 2px #ddd;
			text-align: center;
			padding: 3px 0;
		}
	</style>
</head>

<body>
	<script>
		function confirm_del() {
			var select = confirm("本当に削除しますか？ \n「OK」で削除 \n「キャンセル」で中止");
			return select;
		}
	</script>
	<fieldset>
		<legend>ユーザ一覧参照&表示</legend>
		<a href="user_input.php">作成画面</a>
		<table>
			<thead>
				<tr>
					<th>ユーザ名</th>
					<th>パスワード</th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?= $output ?>
			</tbody>

		</table>

	</fieldset>
</body>

</html>