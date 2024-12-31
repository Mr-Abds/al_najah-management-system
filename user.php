<?php
session_start();

// تحقق مما إذا كان المستخدم مسجلاً الدخول
if (isset($_SESSION['user'])) {
    // تحقق مما إذا كان المستخدم User
    if ($_SESSION['user']['role'] === 'user') {
        echo 'مرحبًا ' .$_SESSION['user']['name'];
        header('Location: index.php');
    } else {
        // إذا لم يكن المستخدم User، إعادة التوجيه إلى صفحة تسجيل الدخول
        header("Location: login.php");
        exit();
    }
} else {
    // إذا لم يكن المستخدم مسجلاً الدخول، إعادة التوجيه إلى صفحة تسجيل الدخول
    header("Location: login.php");
    exit();
}
?>