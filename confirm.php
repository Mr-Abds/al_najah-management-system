<?php
$servername = "localhost";
$username = "root";
$password = "";
$databaseName = "alnajah";
//$std_id = 1;
session_start();
if(!isset($_SESSION['user'])){
    header('Location: login.php');
}
if(isset($_GET['id'])){
    $std_id = $_GET['id'];
    //setcookie('std_id',$std_id);
}
try {
    //$std_id = $_COOKIE['std_id'];
    $conn = new mysqli($servername, $username, $password, $databaseName);
    $sql1 = "SELECT * FROM student WHERE std_id = $std_id";
    $result = $conn->query($sql1);
    $row1 = $result->fetch_assoc();
    $name = $row1['name_Ar'];



} catch (Exception $th){
    die(''. mysqli_error($conn));
}
$mysql = "UPDATE `student` SET";
if(isset($_GET['submit'])){
    $name_Ar = $_GET['name_Ar'];
    $Gender = $_GET['Gender'];
    $phone = $_GET['phone'];
    $std_id = $_GET['id'];
    $sql2 = "SELECT cour_id FROM register_in WHERE stud_id = $std_id";
    $result2 = $conn->query($sql2);
    $row2 = $result2->fetch_assoc();
    $cour_id = $row2['cour_id'];
    var_dump($cour_id);
    var_dump($std_id);
    $sql3 = "UPDATE `register_in` SET isConfirm = 1 WHERE stud_id = $std_id AND cour_id = $cour_id" ;
    if (!mysqli_query($conn, $sql3, MYSQLI_REPORT_ERROR)) {
        echo "Error: " . mysqli_error($conn);
        exit;
    }
    /* if($conn->query($sql3)){
        echo "hhhhhhhhhhhhhhhhhhhhhhhh";
    } */
    $mysql .= " `name_Ar` = '$name_Ar', `phone` = '$phone', `Gender` = '$Gender' ";

    if(isset($_GET['name_En'])){
        $name_En = $_GET['name_En'];
        $mysql .= " , `name_En`= '$name_En'";
    }
    if(isset($_GET['national'])){
        $national = $_GET['national'];
        $mysql .= " , `national`= '$national'";
    }
    if(isset($_GET['addrass'])){
        $addrass = $_GET['addrass'];
        $mysql .= " , `addrass`= '$addrass'";
    }
    if(isset($_GET['card_id'])){
        $card_id = $_GET['card_id'];
        $mysql .= " , `Id-card`= '$card_id'";
    }
    if(isset($_GET['phone'])){
        $phone = $_GET['phone'];
        $mysql .= " , `phone`= '$phone'";
    }
    if(isset($_GET['email'])){
        $email = $_GET['email'];
        $mysql .= " , `email`= '$email'";
    }
    /* if(isset($_GET['photo'])){
        $photo = $_GET['photo'];
//        $targetDir = "./";
//        $targetFile = $targetDir . basename($_FILES["fileToUpload"]["name"]);
//        move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile);
//        header("Location: " . $_SERVER['PHP_SELF']);
//        exit;
        $mysql .= " , `photo`= '$photo'";
    } */
    if(isset($_GET['DOB'])){
        $DOB = $_GET['DOB'];
        $mysql .= " , `DOB`= '$DOB'";
    }
    $mysql .= " WHERE `student`.`std_id` =$std_id";
    if($conn->query($mysql)){
        echo 'fffffffffffffff';
        header("Location:confirmed.php?course_id=$cour_id");
    }
        //header("Location: student-details.php?id=$std_id");
    
}
//        if ($_SERVER["REQUEST_METHOD"] == "POST") {
//            // الحصول على الاسم من form
//            $name_Ar = trim($_POST["name_Ar"]);
//
//            // حساب عدد الكلمات باستخدام str_word_count
//            $word_count = str_word_count($name_Ar, 0, "اأإآءبتثجحخدذرزسشصضطظعغفقكلمنهوي");
//
//            if ($word_count == 5) {
//                echo "الاسم الخماسي صالح.";
//            } else {
//                echo "الرجاء إدخال اسم خماسي.";
//            }
//        }
?>

<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Preskool - Students</title>

    <link rel="shortcut icon" href="assets/img/favicon.png">

    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,700;0,900;1,400;1,500;1,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">

    <link rel="stylesheet" href="assets/plugins/feather/feather.css">

    <link rel="stylesheet" href="assets/plugins/icons/flags/flags.css">

    <link rel="stylesheet" href="assets/css/bootstrap-datetimepicker.min.css">

    <link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="assets\plugins\scrollbar\scroll.min.css">
    <link rel="stylesheet" href="assets/plugins/select2/css/select2.min.css">

    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

<div class="main-wrapper">

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

                <li class="submenu active">
                    <a href="#"><i class="fas fa-book-reader"></i> <span class="me-4"> الدورات</span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="courses.php" class="active">قائمة الدورات</a></li>
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


    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col-sm-12">
                        <div class="page-sub-header">
                            <h3 class="page-title">تأكيد الطالب</h3>

                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="card comman-shadow">
                        <div class="card-body">
                            <form>
                                <div class="row">
                                    <div class="col-12">
                                        <h3 class= "mb-2 ">معلومات الطالب</h3>
                                        <p>الحقول التي تحتوي على <span class="login-danger">*</span> لا يمكن ان تكون فارغة</p>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>الأسم <span class="login-danger">*</span></label>
                                            <input name="name_Ar" class="form-control" type="text" value="<?=$row1['name_Ar']?>" required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>الأسم الأنجليزي <span class="login-danger"></span></label>
                                            <input name="name_En" class="form-control" type="text" value="<?= $row1['name_En']?>" required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>الجنس <span class="login-danger">*</span></label>
                                            <select name="Gender" class="form-control select" required>

                                                <option  selected value="<?= $row1['Gender']?>"><?= $row1['Gender'] == 'm' ? 'ذكر' : 'أنثى' ?></option>
                                                <option  value="<?= $row1['Gender'] == 'm' ? 'f' : 'm' ?>"><?= $row1['Gender'] == 'm' ? 'أنثى' : 'ذكر' ?></option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms calendar-icon">
                                            <label>تاريخ الميلاد <span class="login-danger"></span></label>
                                            <input name="DOB" class="form-control datetimepicker" type="date" value="<?= $row1['DOB']?>" placeholder="" required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>الأيميل <span class="login-danger"></span></label>
                                            <input name="email" class="form-control" type="text" value="<?= $row1['email']?>" required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>العنوان <span class="login-danger"></span></label>
                                            <input name="addrass" class="form-control" type="text" value="<?= $row1['addrass']?>" required>
                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label><span class="login-danger">*</span> الجنسية </label>
                                            <input name="national" class="form-control" type="text" value="<?= $row1['national']?>" required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>الجوال <span class="login-danger">*</span></label>
                                            <input name="phone" class="form-control" type="text" value="<?= $row1['phone']?>" required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>رقم البطاقة الشخصية <span class="login-danger">*</span></label>
                                            <input name="card_id" class="form-control" type="text" value="<?= $row1['Id-card']?>" required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group students-up-files">
                                            <label> <b>الصورة الشخصية</b></label>
                                            <div class="upload">
                                                <label class="file-upload image-upbtn mb-0">
                                                    اختر ملف <input name="photo" type="file">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <input name="id" value="<?=$_GET['id']?>" type="hidden">
                                    
                                    <div class="col-12">
                                        <div class="student-submit">
                                            <button name="submit" type="submit" class="btn btn-primary">تأكيد</button>
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
