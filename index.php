<?php
/**
 * Created by PhpStorm.
 * User: poli
 * Date: 2018/12/06
 * Time: 16:25
 */
$driver_options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_EMULATE_PREPARES => false,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
];

function h($str)
{
    echo htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

try {
    $db_connect = new PDO("mysql:host=localhost;dbname=bbs; charset=utf8mb4", "poli", "politoed0320", $driver_options);
    $query = $db_connect->query("SELECT * FROM thread");
    $rows = $query->fetchAll();
} catch (PDOException $e) {
    print "エラー!:" . $e->getMessage() . "<br/>";
    exit();
}
header("Content-Type: text/html; charset=utf-8");
?>

<!DOCTYPE html>
<html>
<head>
    <title>トップページ</title>
</head>
<body>
<?php foreach ($rows as $row) : ?>
<a href="thread.php?id=<?php h($row["id"]) ?>"><?php h($row["title"]) ?></a> <br>
<?php endforeach ?>
<hr>
<form action="make_thread.php" method="post">
    <input type="text" name="name" placeholder="名前">
    <input type="text" name="title" placeholder="タイトル">
    <input type="text" name="body" placeholder="本文">
    <input type="submit" value="作成">
</form>
<hr>
<form action="search.php" method="get">
    <input type="text" name="search" placeholder="検索">
    <input type="submit" value="検索">
</form>
<hr>
問い合わせ
<form action="mail.php" method="post">
    <input type="text" name="mail" placeholder="問い合わせ内容">
    <input type="submit" value="送信">
</form>
</body>
</html>
