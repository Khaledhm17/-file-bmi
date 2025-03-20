<?php
if (!isset($_GET['name'], $_GET['bmi'], $_GET['category'])) {
    header("Location: index.html");
    exit;
}

$name = htmlspecialchars($_GET['name']);
$bmi = floatval($_GET['bmi']);
$category = htmlspecialchars($_GET['category']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BMI Result</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>BMI Result</h1>
        <p><strong>Name:</strong> <?php echo $name; ?></p>
        <p><strong>Your BMI:</strong> <?php echo number_format($bmi, 2); ?></p>
        <p><strong>Category:</strong> <?php echo $category; ?></p>
        <a href="index.html">Calculate Again</a>
    </div>
</body>
</html>
