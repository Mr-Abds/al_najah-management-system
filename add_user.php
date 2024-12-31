<?php
/* include "Validator.php"; */
session_start();
if(!isset($_SESSION['user'])){
    header('Location: login.php');
}
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

$conn = Createconn();
if (isset($_POST['submit'])) {
    $data = [
        'name' => $_POST['name'],
        'email' => $_POST['email'],
        'password' => $_POST['password'],

    ];
    /* $rollno=['name'=> 'required','email'=>'required|max:9','password'=>'required'];
    $valdetro=new Validator();
    if ($valdetro->validate($data,$rollno)) {

    }else{
        $vl=$valdetro->errors();

    } */

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sqlinsert = "INSERT INTO user(name,email,password) VALUES('$name','$email','$password') ";
    $conn->query($sqlinsert);
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>- Students</title>

    <link rel="shortcut icon" href="assets/img/favicon.png">

    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,700;0,900;1,400;1,500;1,700&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">

    <link rel="stylesheet" href="assets/plugins/feather/feather.css">

    <link rel="stylesheet" href="assets/plugins/icons/flags/flags.css">

    <link rel="stylesheet" href="assets/css/bootstrap-datetimepicker.min.css">

    <link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">
    <link href="assets/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="assets\plugins\scrollbar\scroll.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body dir="rtl">

    <div class="main-wrapper">

        <div class="page-wrapper">
            <div class="content container-fluid">
                 <div class="header">

            <div class="header-left">
                <a href="index.html" class="logo">
                    <img src="assets/img/logo.jpg" width="90" height="70" alt="Logo">
                </a>

            </div>

            <div class="menu-toggle">
                <a href="javascript:void(0);" id="toggle_btn">
                    <i class="fas fa-bars"></i>
                </a>
            </div>

            <div class="top-nav-search">
                <form>
                    <input type="text" class="form-control" placeholder="ابحث هنا">
                    <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                </form>
            </div>
            <div class="col-auto text-start float-start   mt-3 m-4 download-grp" style="margin-left: 30px;">

                <a href="logout.php" class="btn btn-primary"> تسجيل خروج</a>

            </div>





        </div>
        <div class="sidebar scroll-bar-wrap" id="sidebar">
            <div class="sidebar-inner vertical-scroll scroll-demo">
                <div id="sidebar-menu" class="sidebar-menu ">
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
                                            <li><a href="add_user.php" class="active">اضافة مستخدم</a></li>
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
                                            <a>كشف البداية والنهاية لدبلوم </span> <span class="menu-arrow"></span></a>
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
                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col-sm-12">
                            <div class="page-sub-header">
                                <h3 class="page-title">اضف المستخدم</h3>
                                <ul class="breadcrumb">
                                    <!--                                <li class="breadcrumb-item"><a href="students.php">المستخدم</a></li>-->
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
                                <form method="POST" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-12">
                                            <h5 class="form-title student-info">معلومات المستخدم <span><a href="javascript:;"><i
                                                            class="feather-more-vertical"></i></a></span></h5>
                                        </div>
                                        <div class="col-12 ">
                                            <div class="form-group local-forms">
                                                <label>اسم المستخدم <span class="login-danger"> <?php if (isset($vl['name'][0])) {
                                                                                                    echo "ادخل اسم المستخدم";
                                                                                                } ?></span></label>
                                                <input class="form-control" type="text" placeholder=" ادخل اسم المستخدم"
                                                    name="name">
                                            </div>
                                        </div>

                                        <div class="col-12 ">
                                            <div class="form-group local-forms">
                                                <span class="login-danger"></span>
                                                <label>الايميل <span class="login-danger"></span></label>
                                                <input class="form-control" type="email" placeholder="ادخل ايميل المستخدم"
                                                    name="email">
                                            </div>
                                        </div>

                                        <div class="col-12 ">
                                            <div class="form-group local-forms">
                                                <label>كلمة المرور <span class="login-danger"> <?php if (isset($vl['password'][0])) {
                                                                                                    echo "ادخل كلمة المرور";
                                                                                                } ?></span></label>

                                                <input class="form-control" type="password" placeholder="ادخل كلمة المرور"
                                                    name="password">
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