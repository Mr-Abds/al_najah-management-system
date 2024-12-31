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


$conn = Createconn();
//$id=31;

if (isset($_GET['id'])) {
    $id = $_GET['id'];
//    setcookie('id', $id);

    // $id=$_COOKIE['id'];
    $list = "SELECT * from teacher where teach_id=$id";
    $list1 = $conn->query($list);
    $listsql = $list1->fetch_array();
}
$mysql="UPDATE  `teacher` SET";
if (isset($_GET['submit'])) {
    $ArabicName = $_GET['Arabic_name'];
    $phone = $_GET['phone'];
    $address = $_GET['Address'];

$mysql .="`name`='$ArabicName', `phone`='$phone', `addrass`='$address'";
    if(isset($_GET['cv'])){
        $cv = $_GET['cv'];
        $mysql .=", `cv`='$cv'";
    }
    if(isset($_GET['photo'])){
        $photo = $_GET['photo'];
        $mysql .=", `photo`='$photo'";
    }
    $mysql.=" where `teach_id`=$id";
    if ($conn->query($mysql)){
//        echo "susccfully";
        header("location:teacher-details.php?id=$id");
    }


}
//    if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
//        $photo = $_FILES['photo']['name'];
//        $photo_tmp = $_FILES['photo']['tmp_name'];
//        $upload_dir = 'uploads/';
//    }
//    if (move_uploaded_file($photo_tmp, $upload_dir . $photo)) {
//}else{
//    echo "خطاء في رفع الصوره";
//}




//
//            $row = $conn->query("SELECT teach_id FROM teacher where name_Ar='$ArabicName' ");
//            $row = $row->fetch_array();
//            $teach_id = $row['teach_id'];
//
//            if (isset($_GET['cores'])){
//                $cour_name = $_GET['cores'];
//            }
//            $ss = $conn->query("SELECT cour_id FROM course where cour_name = '$cour_name'");
//            $row= $ss->fetch_array();
//            $cour_id = $row['cour_id'];
//
//            $sqlinsert = "INSERT INTO register_tcch(cour_id,teach_id) VALUES($cour_id,$teach_id) ";
//            $conn->query($sqlinsert);


//    header('location:teachers.php');



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
<body>


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
                            <form method="get" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-12">
                                        <h5 class="form-title student-info">معلومات المدرب <span><a href="javascript:;"><i
                                                            class="feather-more-vertical"></i></a></span></h5>
                                    </div>
                                    <div class="col-12 ">
                                        <div class="form-group local-forms">
                                            <label>اسم المدرب بالعربي <span class="login-danger">*</span></label>
                                            <input class="form-control" type="text" placeholder=" ادخل اسم المدرب" name="Arabic_name" value="<?=$listsql['name'] ?>" required>
                                        </div>
                                    </div>
                                    <input name="id" value="<?= $id ?>" type="hidden" >
                                    <div class="col-12 ">
                                        <div class="form-group local-forms">
                                            <label>الجوال </label>
                                            <input class="form-control" type="text" placeholder="ادخل رقم الجوال"
                                                   name="phone" value="<?=$listsql['phone'] ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-12 ">
                                        <div class="form-group local-forms">
                                            <label>CV </label>
                                            <input class="form-control" type="text" placeholder="ادخل cv"
                                                   name="cv" value="<?=$listsql['cv'] ?>" >
                                        </div>
                                    </div>
                                    <div class="col-12 ">
                                        <div class="form-group local-forms">
                                            <label>العنوان </label>
                                            <input class="form-control" type="text" placeholder="ادخل العنوان"
                                               value="<?=$listsql['addrass'] ?>"    name="Address">
                                        </div>
                                    </div>

                                    <div class="col-12 ">
                                        <div class="form-group students-up-files">
                                            <label>ارفع صوره  </label>
                                            <div class="upload">
                                                <label class="file-upload image-upbtn mb-0">
                                                    اختر الملف <input name="photo" type="file">
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