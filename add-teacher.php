<?php
//include "Validator.php";
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
if(!isset($_SESSION['user'])){
    header('Location: login.php');
}
$conn = Createconn();
if (isset($_POST['submit'])) {
    $data=[
            'name'=>$_POST['name'],
            'phone'=>$_POST['phone'],
            'Address'=>$_POST['Address'],
            'cv'=>$_POST['cv'],
    ];
    /* $rollno=['name'=> 'required','phone'=>'required','Address'=>'required','photo'=>'required','cv'=>'required'];
    $valdetro=new Validator();
    if ($valdetro->validate($data,$rollno)) {

    }else{
        $vl=$valdetro->errors();

    } */

    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $address = $_POST['Address'];
    $cv = $_POST['cv']?? null;

    $photo = null;
    if ($_FILES ['photo']['type'] == "image/jpeg") {
        if (move_uploaded_file($_FILES['photo']['tmp_name'],
            "uploads/" . $_FILES['photo']['name'])) ;
        {
            echo "Upload success";
        }
    } else {
        echo "Upload error";
    }
    if ($_FILES ['cv']['type'] == "application/pdf") {
        if (move_uploaded_file($_FILES['cv']['tmp_name'],
            "uploads/" . $_FILES['cv']['name'])) ;
        {
            echo "Upload success";
        }
    } else {
        echo "Upload error";
    }
    $sqlinsert = "INSERT INTO teacher(name,cv,addrass,phone,photo) VALUES('$name' ,'$cv','$address','$phone','$photo') ";
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

    <link rel="stylesheet" href="assets/plugins/select2/css/select2.min.css">

    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<div class="main-wrapper">

    <div class="page-wrapper">
        <div class="content container-fluid">
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
                <li class="submenu active">
                    <a href="#"><i class="fas fa-chalkboard-teacher"></i> <span class="me-4"> المدربين </span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="teachers.php">قائمة المدربين</a></li>
                        
                        <li><a href="add-teacher.php" class="active">أضافة مدرب</a></li>
                        
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
                            <li class="submenu">
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
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col-sm-12">
                        <div class="page-sub-header">
                            <h3 class="page-title">اضف مدرب</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="students.php">مدرب</a></li>
                                <li class="breadcrumb-item active">اضف مدرب</li>
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
                                        <h5 class="form-title student-info">معلومات المدرب <span><a href="javascript:;"><i
                                                            class="feather-more-vertical"></i></a></span></h5>
                                    </div>
                                    <div class="col-12 ">
                                        <div class="form-group local-forms">
                                            <label>اسم المدرب <span class="login-danger"> <?php if (isset($vl['name'][0])){echo "ادخل اسم المدرب";} ?></span></label>
                                            <input class="form-control" type="text" placeholder=" ادخل اسم المدرب"
                                                   name="name" >
                                        </div>
                                    </div>

                                    <div class="col-12 ">
                                        <div class="form-group local-forms">
                                            <span class="login-danger"></span>
                                            <label>الجوال <span class="login-danger"><?php if (isset($vl['phone'][0])){echo "ادخل رقم الجوال";} ?></span></label>
                                            <input class="form-control" type="text" placeholder="ادخل رقم الجوال"
                                                   name="phone" >
                                        </div>
                                    </div>

                                    <div class="col-12 ">
                                        <div class="form-group local-forms">
                                            <label>العنوان <span class="login-danger">    <?php if (isset($vl['Address'][0])){echo "ادخل العنوان";} ?></span></label>

                                            <input class="form-control" type="text" placeholder="ادخل العنوان"
                                                   name="Address">
                                        </div>
                                    </div>
                                    <div class="col-6 ">
                                        <div class="form-group students-up-files">
                                            <label> <span class="login-danger">    <?php if (isset($vl['cv'][0])){echo "ادخل بصيغة (PDF)";} ?></span></label>
                                            <div class="upload">
                                                <label class="form-control file-upload image-upbtn mb-0" style="text-align: center">
                                                     cv <input class="form-control" name="cv" type="file">
                                                </label>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-6 ">
                                        <div class="form-group students-up-files">
                                            <label> <span class="login-danger">    <?php if (isset($vl['photo'][0])){echo "ادخل الصوره";} ?></span></label>
                                            <div class="upload">
                                                <label class="form-control file-upload image-upbtn mb-0" style="text-align: center">
                                                    ادخل صوره<input name="photo" type="file">
                                                </label>
                                            </div>
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