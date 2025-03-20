<?php
include 'database.php'; // استدعاء الاتصال بقاعدة البيانات

if (isset($_POST['name'], $_POST['weight'], $_POST['height'])) {
    $name = htmlspecialchars($_POST['name']);
    $weight = floatval($_POST['weight']);
    $height = floatval($_POST['height']);

    if ($weight <= 0 || $height <= 0) {
        die("Invalid input values.");
    }

    // حساب BMI
    $bmi = $weight / ($height * $height);
    if ($bmi < 18.5) {
        $category = "Underweight";
    } elseif ($bmi < 25) {
        $category = "Normal weight";
    } elseif ($bmi < 30) {
        $category = "Overweight";
    } else {
        $category = "Obesity";
    }

    // إدخال البيانات في قاعدة البيانات
    $stmt = $conn->prepare("INSERT INTO users (name, weight, height, bmi, category) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sddds", $name, $weight, $height, $bmi, $category);

    if ($stmt->execute()) {
        header("Location: result.php?name=$name&weight=$weight&height=$height&bmi=$bmi&category=$category");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }

    // إغلاق الاتصال
    $stmt->close();
    $conn->close();
} else {
    header("Location: index.html?error=no_data");
    exit;
}
?>
