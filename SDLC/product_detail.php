<?php
session_start();
$connect = mysqli_connect('localhost', 'root', '', 'shop_vpp');
if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET['id'])) {
    $product_id = intval($_GET['id']);
    $sql = "SELECT * FROM products WHERE product_id = $product_id";
    $result = mysqli_query($connect, $sql);
    $product = mysqli_fetch_assoc($result);
} else {
    echo "<script>alert('Product not found!'); window.location='index.php';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($product['product_name']) ?></title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<header>
    <h1><?= htmlspecialchars($product['product_name']) ?></h1>
</header>

<div class="product-detail">
    <img src="<?= htmlspecialchars($product['product_img']) ?>" alt="<?= htmlspecialchars($product['product_name']) ?>">
    <p><strong>Price:</strong> <?= number_format($product['product_price'], 0, ',', '.') ?>đ</p>
    <p><strong>Description:</strong></p>
    <p><?= nl2br(htmlspecialchars($product['product_desc'])) ?></p>

    <form method="POST" action="cart.php">
        <input type="hidden" name="action" value="add">
        <input type="hidden" name="id" value="<?= $product['product_id'] ?>">
        <input type="hidden" name="name" value="<?= htmlspecialchars($product['product_name']) ?>">
        <input type="hidden" name="price" value="<?= $product['product_price'] ?>">
        <input type="hidden" name="image" value="<?= htmlspecialchars($product['product_img']) ?>">
        <button type="submit">Add to Cart</button>
    </form>

    <a href="index.php" class="back-btn">⬅ Back to Home</a>
</div>

</body>
</html>
