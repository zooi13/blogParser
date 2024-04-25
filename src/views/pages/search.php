<?php
require_once "app/Services/DB.php";
$db = new DB();
$str = $_POST['str'];

$sql = "
SELECT posts.title, comments.body
FROM posts
JOIN comments
ON posts.id = comments.postId
WHERE comments.body LIKE '%$str%'
";

$res = $db->query($sql);
echo(json_encode($res));
