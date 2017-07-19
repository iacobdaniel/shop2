<!DOCTYPE html>
<html>
<head>
    <title>New order</title>
</head>
<body>
    <h1>Hello, <?= $client ?></h1>
    <h3>Your order has been received.</h3>
    <p>Your details:</p>
    <ul>
        <li>Name: <?= $client ?></li>
        <li>Email: <?= $email ?></li>
        <li>Other details: <?= $details ?></li>
    </ul>
    <p>Ordered products: <?= $product_names ?>.</p>
</body>
</html>