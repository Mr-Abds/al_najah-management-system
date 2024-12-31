<?php

//include "controller.php";
function Createconn()
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "alnajah";
    $conn = new mysqli($servername, $username, $password, $database);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}
session_start();

$conn = Createconn();
//$id=31;

if (isset($_GET['id'])) {
    $id = $_GET['id'];
//    setcookie('id', $id);

    // $id=$_COOKIE['id'];
    $list = "SELECT * from user where id=$id";
    $list1 = $conn->query($list);
    $listsql = $list1->fetch_array();
}
$mysql="UPDATE  `user` SET";
if (isset($_GET['submit'])) {
    $Name = $_GET['name'];
    $email = $_GET['email'];
    $password = $_GET['password'];

    $mysql .="`name`='$Name', `email`='$email', `password`='$password'";
    $mysql.=" where `id`=$id";
    if ($conn->query($mysql)){
//        echo "susccfully";
        header("location:users.php?id=$id");
    }


}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title> - Students</title>

    <link rel="shortcut icon" href="assets/img/favicon.png">

    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,700;0,900;1,400;1,500;1,700&display=swap"
          rel="stylesheet">

    <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">

    <link rel="stylesheet" href="assets/plugins/feather/feather.css">

    <link rel="stylesheet" href="assets/plugins/icons/flags/flags.css">

    <link rel="stylesheet" href="assets/css/bootstrap-datetimepicker.min.css">

    <link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">

    <link rel="stylesheet" href="assets/plugins/select2/css/select2.min.css">

    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body dir="rtl">


<div class="main-wrapper">
    <?php include 'header.php'; ?>
    <div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="menu-title">
                    <span>القائمة الرئيسية</span>
                </li>
                <li class="submenu">
                    <a href="#"><i class="feather-grid"></i> <span class="me-4"> الصفحة الرئيسية</span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="index.php">لوحة تحكم المسؤول</a></li>

                    </ul>
                </li>
                <li class="submenu ">
                    <a href="#"><i class="fas fa-graduation-cap"></i> <span class="me-4"> الطلاب</span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="students.php">قائمة الطلاب</a></li>
                        <li><a href="add-student.php">اضافة طالب</a></li>

                    </ul>
                </li>
                <li class="submenu">
                    <a href="#"><i class="fas fa-chalkboard-teacher"></i> <span class="me-4"> المدربين </span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="teachers.php">قائمة المدربين</a></li>
                        
                        <li><a href="add-teacher.php">أضافة مدرب</a></li>
                        
                    </ul>
                </li>

                <li class="submenu">
                    <a href="#"><i class="fas fa-book-reader"></i> <span class="me-4"> الدورات</span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="courses.php">قائمة الدورات</a></li>
                        <li><a href="add-course.php">اضافة دورة</a></li>
                        <li><a href="edit-course.php">تعديل دورة</a></li>
                    </ul>
                </li>
                <?php
                        if ($_SESSION['user']['role'] === 'admin') {
                        ?>
                            <li class="submenu active">
                                <a href="#"><i class="fas fa-book-reader"></i> <span class="me-4"> المستخدمين</span> <span class="menu-arrow"></span></a>
                                <ul>
                                    <li><a href="users.php">قائمة المستخدمين</a></li>
                                    <li><a href="add_user.php">اضافة مستخدم</a></li>
                                </ul>
                            </li>
                        <?php
                        } ?>
                <li class="submenu">
                    <a href="#"><i class="fas fa-building"></i> <span>الدبلوم</span> <span
                            class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="departments.php">عرض الدبلومات</a></li>
                        <li><a href="add-department.php">اضافة دبلوم</a></li>
                        <li><a href="departments.php"> تعديل دبلوم</a></li>
                    </ul>
                </li>
                <li class="menu-title">
                    <span>إدارة</span>
                </li>

                <li class="submenu">
                    <a href="#"><i class="fas fa-certificate"></i> <span class="me-4"> الشهادات</span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="add_certfcation.php">اضافة شهادة</a></li>
                        <li><a href="Certfcation.php">عرض الشهادات</a></li>
                        <li><a href="certificted_student.php">الطلاب المستحقين لشهادات</a></li>
                        <li><a href="dibloma_certfcation.php"> شهادات الدبلومات</a></li>

                    </ul>
                </li>

                <!-- <li class="submenu">
                    <a href="attendance.php"><i class="fas fa-book-reader"></i> <span class="me-4"> التقارير</span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="start-end-report.php">كشف البداية والنهاية لدبلوم</a></li>
                        <li><a href="edit-subject.php">كشف أستخراج شهادة</a></li>
                    </ul>
                </li> -->
                <li class="submenu">
                    <a href="attendance.php"><i class="fas fa-book-reader"></i> <span class="me-4"> التقارير</span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li class="submenu">
                            <a>كشف البداية والنهاية  </span> <span class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="start-end-report.php?diplom_name=الحاسوب">دبلوم حاسوب</a></li>
                                <li><a href="start-end-report.php?diplom_name=اللغة الإنجليزية">دبلوم لغة أنجليزية</a></li>
                            </ul>
                        </li>
                        <li><a href="edit-subject.php">كشف أستخراج شهادة</a></li>
                    </ul>
                </li>
                <li class="">
                    <a href="attendance.php"><i class="fas fa-book-reader"></i> <span class="me-4"> الغياب</span> </span></a>
                </li>

            </ul>
        </div>
    </div>
</div>
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col-sm-12">
                        <div class="page-sub-header">
                            <h3 class="page-title">اضف مستخدم</h3>
                            <ul class="breadcrumb">
<!--                                <link class="breadcrumb-item"><a href="students.php">مدرب</a></link>-->
                                <li class="breadcrumb-item active">اضف المستخدم</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="card comman-shadow">
                        <div class="card-body">
                            <form method="get" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-12">
                                        <h5 class="form-title student-info">معلومات المستخم <span><a href="javascript:;"><i
                                                        class="feather-more-vertical"></i></a></span></h5>
                                    </div>
                                    <div class="col-12 ">
                                        <div class="form-group local-forms">
                                            <label>اسم المستخدم <span class="login-danger">*</span></label>
                                            <input class="form-control" type="text" placeholder=" ادخل اسم المدرب" name="Arabic_name" value="<?=$listsql['name'] ?>" required>
                                        </div>
                                    </div>
                                    <input name="id" value="<?= $id ?>" type="hidden" >
                                    <div class="col-12 ">
                                        <div class="form-group local-forms">
                                            <label>الايميل </label>
                                            <input class="form-control" type="email" placeholder="ادخل الايميل"
                                                   name="phone" value="<?=$listsql['email'] ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-12 ">
                                        <div class="form-group local-forms">
                                            <label>كلمة المرور </label>
                                            <input class="form-control" type="password" placeholder="ادخل المرور"
                                                   name="cv" value="<?=$listsql['password'] ?>" >
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="student-submit">
                                            <button type="submit" class="btn btn-primary" name="submit">ارسال</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
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

<script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<script src="assets/plugins/select2/js/select2.min.js"></script>

<script src="assets/plugins/moment/moment.min.js"></script>
<script src="assets/js/bootstrap-datetimepicker.min.js"></script>

<script src="assets/js/script.js"></script>
</body>
</html>