<?php
include 'database.php'; // الاتصال بقاعدة البيانات

if (isset($_POST['id'])) {
    $id = intval($_POST['id']); // تأمين المعرف

    // تنفيذ استعلام الحذف
    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "<script>alert('Record deleted successfully!'); window.location.href='admin.php';</script>";
    } else {
        echo "<script>alert('Error deleting record!'); window.location.href='admin.php';</script>";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "<script>alert('Invalid request!'); window.location.href='admin.php';</script>";
}
?>
