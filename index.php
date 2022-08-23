<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search</title>
</head>

<body>
    <form action="" method="get">
        <input name="text" placeholder="Найти" type="search">
        <button type="submit" name="doSearch">Найти</button>
    </form>
</body>

</html>

<?php
if (isset($_REQUEST['doSearch'])) { // если прозвели поиск
    require_once "db.php";

    $searchedText = htmlspecialchars(trim($_REQUEST['text']));
    if (strlen($searchedText) < 3) {
        echo "Поиск ведется для строк, содержащих минимум 3 символа";
    } else {
        $st = $db->prepare("SELECT p.title as post_title, c.name, c.email, c.body FROM comment c JOIN post p ON (c.post_id = p.id) WHERE c.body LIKE :searchedText");
        $st->execute(array(
            'searchedText' => '%' . $searchedText . '%'
        ));

        $commentsWithText = $st->fetchAll(PDO::FETCH_ASSOC);
    }

    if($commentsWithText) {
        echo "<h1>Результаты поиска</h1>"; 
    }

    foreach($commentsWithText as $comment) {
        echo "<p>Заголовок записи: " . $comment['post_title'] . "</p>";
        echo "<p>Текст комментария: " . $comment['body'] . "</p> ";
        echo "<p>Имя: " . $comment['name'] . "</p> ";
        echo "<p>Email: " . $comment['email'] . "</p> ";
        echo "<br>";
    }
}


