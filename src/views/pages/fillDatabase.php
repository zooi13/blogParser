<?php
require_once "app/Services/DB.php";
$db = new DB();
$postCount = 0;
$commentCount = 0;

$chPosts = curl_init('https://jsonplaceholder.typicode.com/posts');
curl_setopt($chPosts, CURLOPT_RETURNTRANSFER, true);
$posts = curl_exec($chPosts);
curl_close($chPosts);
$posts = json_decode($posts, true);

foreach ($posts as $post){
    $postCount++;
    $params = [
        'userId' => $post['userId'],
        'title' => $post['title'],
        'body' => $post['body'],
    ];
    $db->query('INSERT INTO `posts` ( userId, title, body) VALUES ( :userId, :title, :body)', $params);
}


$chComments = curl_init('https://jsonplaceholder.typicode.com/comments');
curl_setopt($chComments, CURLOPT_RETURNTRANSFER, true);
$comments = curl_exec($chComments);
curl_close($chComments);
$comments = json_decode($comments, true);

foreach ($comments as $comment){
    $commentCount++;
    $params = [
        'postId' => $comment['postId'],
        'name' => $comment['name'],
        'email' => $comment['email'],
        'body' => $comment['body'],
    ];
    $db->query('INSERT INTO `comments` ( postId, name, email, body) VALUES ( :postId, :name, :email, :body)', $params);
}


echo "<script>";
echo "console.log('Загружено $postCount записей и $commentCount комментариев')";
echo "</script>";