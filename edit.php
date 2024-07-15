<?php
require '../Include/db.php';

$id = $_GET['id'];
$sql = 'SELECT * FROM posts WHERE id = :id';
$statement = $pdo->prepare($sql);
$statement->execute([':id' => $id]);
$post = $statement->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];

    $sql = 'UPDATE posts SET title = :title, content = :content WHERE id = :id';
    $statement = $pdo->prepare($sql);
    $statement->execute([':title' => $title, ':content' => $content, ':id' => $id]);

    header('Location: index.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Blog Post</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            background-color: #f0f2f5;
        }

        #box {
            height: 400px;
            width: 400px;
            padding: 20px;
            background-color: white;
            margin-top: 100px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }

        input[type="text"], textarea {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            width: 100%;
            box-sizing: border-box;
        }

        textarea {
            resize: vertical;
            min-height: 100px;
        }

        button {
            padding: 10px;
            border: none;
            border-radius: 4px;
            background-color: #007bff;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div id="box">
        <h1>Edit Blog Post</h1>
        <form method="POST">
            <label for="title">Title:</label>
            <input type="text" name="title" id="title" value="<?= htmlspecialchars($post['title']) ?>" required>
            <br>
            <label for="content">Content:</label>
            <textarea name="content" id="content" required><?= htmlspecialchars($post['content']) ?></textarea>
            <br>
            <button type="submit">Update</button>
        </form>
    </div>
</body>
</html>
