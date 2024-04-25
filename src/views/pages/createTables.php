<?php
require_once "app/Services/DB.php";
$db = new DB();


if ($db->query("show databases like 'blog'") == []){
    $sql = "CREATE DATABASE blog";
    $db->query($sql);
}

$res1 = $db->query('CHECK TABLE posts')[0]['Msg_text'];
$res2 = $db->query('CHECK TABLE comments')[0]['Msg_text'];

if ($res1 !== "OK"){

    $sqlCreatePost = "create table posts (
    id integer auto_increment primary key, 
    userId varchar(30), 
    title text, 
    body text);";

    $db->query($sqlCreatePost);
}

if ($res2 !== "OK"){
    $sqlCreateСom = "create table comments (
    id integer auto_increment primary key, 
    postId integer, 
    name text, 
    email text, 
    body text,
    FOREIGN KEY (postId) REFERENCES posts(id));";

    $db->query($sqlCreateСom);
}





