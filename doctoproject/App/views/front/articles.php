<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualité de la santé</title>
    <link rel="stylesheet" href="css/styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f8ff;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            background-color: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 800px;
            margin-top: 20px;
        }

        h1 {
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-top: 10px;
            color: #333;
        }

        input[type="text"], textarea, input[type="file"] {
            width: calc(100% - 20px);
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        textarea {
            resize: vertical;
        }

        button {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 20px;
            width: 100%;
        }

        button:hover {
            background-color: #0056b3;
        }

        .article-container {
            margin-top: 20px;
        }

        .article {
            margin-bottom: 20px;
            text-align: left;
            border-bottom: 1px solid #ccc;
            padding-bottom: 10px;
        }

        .article h3 {
            color: #007bff;
        }

        .article p {
            color: #666;
        }

        .article p.date {
            font-size: 0.9em;
            color: #999;
        }

    </style>
</head>
<body>

<?php require_once(__DIR__ . '/header.php'); ?>

<div class="container">
    <h1>Créer un Article</h1>
    <form action="/admin/articles/create" method="post" enctype="multipart/form-data">
        <label for="title">Titre :</label>
        <input type="text" id="title" name="title" required>
        <br>
        <label for="content">Contenu :</label>
        <textarea id="content" name="content" rows="10" required></textarea>
        <br>
        <label for="image">Image :</label>
        <input type="file" id="image" name="image">
        <br>
        <button type="submit">Créer</button>
    </form>
</div>

<div class="container article-container">


<h1>Derniers Articles</h1>
    <ul>
        <?php foreach ($lastposts as $article): ?>
            <li>
                <h2><?php echo htmlspecialchars($article['title']); ?></h2>
                <p><?php echo nl2br(htmlspecialchars($article['content'])); ?></p>
            </li>
        <?php endforeach; ?>
    </ul>

    <h2>Actualité de la santé</h2>

    <div class="article">
        <h3>Étude sur les effets du stress sur la santé mentale</h3>
        <p class="date">Publié le 5 juin 2024</p>
        <p>Une récente étude a révélé des liens significatifs entre le stress chronique et le développement de troubles mentaux...</p>
    </div>

    <div class="article">
        <h3>La télémédecine : une solution pour les zones rurales</h3>
        <p class="date">Publié le 2 juin 2024</p>
        <p>Avec l'essor des technologies de communication, la télémédecine s'impose comme une solution efficace pour les patients des zones rurales...</p>
    </div>
</div>

</body>
</html>
