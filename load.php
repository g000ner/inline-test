<?php
require_once "db.php";

$postsAdress = "https://jsonplaceholder.typicode.com/posts"; // адреса ресурсов откуда загружаем данные 
$commentsAdress = "https://jsonplaceholder.typicode.com/comments";

$postsJson = file_get_contents($postsAdress); 
$commentsJson = file_get_contents($commentsAdress);

$posts = json_decode($postsJson); 
$comments = json_decode($commentsJson);


// сохраняем в БД записи
$st = $db->prepare("INSERT INTO post SET `id` = :id, `user_id` = :userId, `title` = :title, `body` = :body");
foreach ($posts as $post) {
    $st->execute(array(
        'id' => $post->id,
        'userId' => $post->userId,
        'title' => $post->title,
        'body' => $post->body
    ));
}

// сохраняем в БД комментарии к записям
$st = $db->prepare("INSERT INTO comment SET `id` = :id, `post_id` = :postId, `name` = :name,`email` = :email, `body` = :body");
foreach ($comments as $comment) {
    $st->execute(array(
        'id' => $comment->id,
        'postId' => $comment->postId,
        'name' => $comment->name,
        'email' => $comment->email,
        'body' => $comment->body
    ));
}

echo "Загружено " . count($posts) . " записей и " .  count($comments) . " комментариев";