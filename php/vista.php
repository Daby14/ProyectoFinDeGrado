<html>
<head>
    <title>Productos</title>
</head>
<body>
    <h1>Lista de productos:</h1>
    <ul>
    <?php foreach ($products as $product): ?>
        <li><?= $product['name'] ?> - <?= $product['price'] ?></li>
    <?php endforeach; ?>
    </ul>
</body>
</html>