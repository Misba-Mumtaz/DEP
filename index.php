<?php
require '../Include/db.php';

$sql = 'SELECT * FROM posts ORDER BY created_at DESC';
$statement = $pdo->prepare($sql);
$statement->execute();
$posts = $statement->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>
    <style>
        body {
            background-color: #f0f2f5;
        }

        #box {
            margin: 50px;
            background-color: white;
            padding-left: 20px;
            padding-top: 10px;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        button{
            margin-left:50px;
            height:25px;
            width: 130px;
            text-align:left;
        }

        a {
            text-decoration: none;
            color: #007bff;
            
        }

        a:hover {
            text-decoration: underline;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            border-bottom: 1px solid #ccc;
            padding: 10px 0;
        }

        li h2 {
            margin: 0;
            color: #555;
        }

        li p {
            color: #777;
        }

        li a {
            margin-right: 10px;
            color: #007bff;
        }

        li a:hover {
            color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Blog Posts</h1>
    <button><a href="create.php">Create New Post</a></button>
    <div id="box">
        <ul>
            <?php foreach ($posts as $post): ?>
                <li>
                    <h2><?= htmlspecialchars($post['title']) ?></h2>
                    <p><?= htmlspecialchars($post['content']) ?></p>
                    <a href="edit.php?id=<?= $post['id'] ?>">Edit</a>
                    <a href="delete.php?id=<?= $post['id'] ?>">Delete</a>
                </li>
            <?php endforeach; ?>
        </ul>
    <div>
</body>
</html>
