<?php
if (isset($_POST['submit'])) {

    function Createconn() {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "alnajah";
        $conn = new mysqli($servername, $username, $password, $database);

        if ($conn->connect_error) {
            die("فشل الاتصال: " . $conn->connect_error);
        }
        return $conn;
    }

    $conn = Createconn();

    $sql = "SELECT name,password,role FROM user WHERE email = '" . $_POST['email'] . "'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        if ($row = $result->fetch_assoc()) {
            session_start();
            $_SESSION["user"] = $row;
var_dump($_SESSION["user"]);
            if ($_SESSION['user']['role'] == 'admin'){

                header('Location: admin.php',true);
            }else if($_SESSION['user']['role'] == 'user'){
                header('Location: user.php',true);
            }
        }else{
            echo 'يرجاء التسجيل ';
        }

//        if (password_verify($_POST['password'], $user['password'])) {
//            session_start();
//            $_SESSION['user'] = $user['name'];
//
//            header('Location: index.php');
//            exit();
//        } else {
//            echo '<div style="text-align: center" class="alert alert-danger">كلمة المرور غير صحيحة</div>';
//
    } else {
        echo '<div style="text-align: center" class="alert alert-danger">البريد الإلكتروني غير صحيح</div>';
    }

//    $login->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>معهد النجاح - تسجيل الدخول</title>

    <link rel="shortcut icon" href="assets/img/favicon.png">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body dir="rtl">

<div class="main-wrapper login-body">
    <div class="login-wrapper">
        <div class="container">
            <div class="loginbox">
                <div class="login-left">
                    <img class="img-fluid" src="logo.png" alt="Logo">
                </div>
                <div class="login-right">
                    <div class="login-right-wrap">
                        <h1>مرحبًا بكم في معهد النجاح</h1>
                        <p class="account-subtitle">هل تحتاج إلى حساب؟ <a href="register.php">إنشاء حساب</a></p>
                        <h2>تسجيل الدخول</h2>

                        <!-- تعديل النموذج ليستخدم POST وإرسال البيانات إلى نفس الصفحة -->
                        <form action="" method="post">
                            <div class="form-group">
                                <label>البريد الإلكتروني <span class="login-danger">*</span></label>
                                <input class="form-control" name="email" type="email" required>
                                <span class="profile-views"><i class="fas fa-user-circle"></i></span>
                            </div>
                            <div class="form-group">
                                <label>كلمة المرور <span class="login-danger">*</span></label>
                                <input class="form-control pass-input" name="password" type="password" required>
                                <span class="profile-views feather-eye toggle-password"></span>
                            </div>
                            <div class="forgotpass">
                                <div class="remember-me">
                                    <label class="custom_check mr-2 mb-0 d-inline-flex remember-me"> تذكرني
                                        <input type="checkbox" name="remember">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <a href="forgot-password.php">نسيت كلمة المرور؟</a>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-success btn-block" name="submit" type="submit">تسجيل الدخول</button>
                            </div>
                        </form>

                        <div class="login-or">
                            <span class="or-line"></span>
                            <span class="span-or">أو</span>
                        </div>

                        <div class="social-login">
                            <a href="#"><i class="fab fa-google-plus-g"></i></a>
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-linkedin-in"></i></a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="assets/js/jquery-3.6.0.min.js"></script>
<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/feather.min.js"></script>
<script src="assets/js/script.js"></script>
</body>
</html>