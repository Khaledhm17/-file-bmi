<?php
include 'database.php'; // استدعاء الاتصال بقاعدة البيانات

// استعلام لجلب جميع بيانات المستخدمين
$sql = "SELECT id, name, weight, height, bmi, category, created_at FROM users ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - BMI Records</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="container">
        <h1>BMI Records</h1>
        <?php if ($result->num_rows > 0): ?>
            <table border="1">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Weight (kg)</th>
                    <th>Height (m)</th>
                    <th>BMI</th>
                    <th>Category</th>
                    <th>Date</th>
                    <th>Action</th> <!-- إضافة عمود للحذف -->
                </tr>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                    <td><?php echo number_format($row['weight'], 2); ?></td>
                    <td><?php echo number_format($row['height'], 2); ?></td>
                    <td><?php echo number_format($row['bmi'], 2); ?></td>
                    <td><?php echo htmlspecialchars($row['category']); ?></td>
                    <td><?php echo $row['created_at']; ?></td>
                    <td>
                        <form action="delete.php" method="POST">
                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                            <input type="submit" name="delete" value="Delete" onclick="return confirm('Are you sure?');">
                        </form>
                    </td>
                </tr>
                <?php endwhile; ?>
            </table>
        <?php else: ?>
            <p>No records found.</p>
        <?php endif; ?>

        <a href="index.html" class="btn">Go Back</a>
    </div>

</body>
</html>

<?php
$conn->close(); // إغلاق الاتصال بقاعدة البيانات
?>
