<?php
$servername = "localhost";
$username = "root";
$password = "";
$databaseName = "alnajah";
//$std_id = 1;
if (isset($_GET['id'])) {
    $std_id = $_GET['id'];
    //setcookie('std_id',$std_id);
}
    try {
        //$std_id = $_COOKIE['std_id'];
        $conn = new mysqli($servername, $username, $password, $databaseName);
        $sql = "SELECT * FROM student WHERE std_id = $std_id ";
        $result = $conn->query($sql);
        $row = $result->fetch_array();
    } catch (Exception $th) {
        die('' . mysqli_error($conn));
    }
    $mysql = "UPDATE `student` SET";
    if (isset($_GET['name_Ar'])) {
        $name_Ar = $_GET['name_Ar'];
        $Gender = $_GET['Gender'];
        $phone = $_GET['phone'];
        $mysql .= " `name_Ar` = '$name_Ar', `phone` = '$phone', `Gender` = '$Gender' ";

        //WHERE `student`.`std_id` = 1

        if (isset($_GET['name_En'])) {
            $name_En = $_GET['name_En'];
            $mysql .= " , `name_En`= '$name_En'";
        }
        if (isset($_GET['national'])) {
            $national = $_GET['national'];
            $mysql .= " , `national`= '$national'";
        }
        if (isset($_GET['addrass'])) {
            $addrass = $_GET['addrass'];
            $mysql .= " , `addrass`= '$addrass'";
        }
        if (isset($_GET['Id-card'])) {
            $Idcard = $_GET['Id-card'];
            $mysql .= " , `Id-card`= '$Idcard'";
        }
        if (isset($_GET['phone'])) {
            $phone = $_GET['phone'];
            $mysql .= " , `phone`= '$phone'";
        }
        if (isset($_GET['email'])) {
            $email = $_GET['email'];
            $mysql .= " , `email`= '$email'";
        }
        if (isset($_GET['photo'])) {
            $photo = $_GET['photo'];
            $mysql .= " , `photo`= '$photo'";
        }
        if (isset($_GET['DOB'])) {
            $DOB = $_GET['DOB'];
            $mysql .= " , `DOB`= '$DOB'";
        }
        $mysql .= " WHERE `student`.`std_id` =$std_id";
        if ($conn->query($mysql)) {
            header("Location: student-details.php?id=$std_id");
        }
    }

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
                                <h3 class="page-title">تعديل الطالب</h3>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card comman-shadow">
                            <div class="card-body">
                                <form>
                                    <?php if (isset($_GET['id'])) {
                                             $std_id = $_GET['id'];
                                        //setcookie('std_id',$std_id);
                                        
                                    }?>
                                <input name="id" type="hidden" value="<?=$std_id?>">
                                    <div class="row">
                                        <div class="col-12">
                                            <h3 class="mb-2 ">معلومات الطالب</h3>
                                            <p>الحقول التي تحتوي على <span class="login-danger">*</span> لا يمكن ان تكون فارغة</p>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                            <div class="form-group local-forms">
                                                <label>الأسم <span class="login-danger">*</span></label>
                                                <input name="name_Ar" class="form-control" type="text" value="<?= $row['name_Ar'] ?>">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                            <div class="form-group local-forms">
                                                <label>الأسم الأنجليزي <span class="login-danger"></span></label>
                                                <input name="name_En" class="form-control" type="text" value="<?= $row['name_En'] ?>">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                            <div class="form-group local-forms">
                                                <label>الجنس <span class="login-danger">*</span></label>
                                                <select name="Gender" class="form-control select">

                                                    <option selected value="<?= $row['Gender'] ?>"><?= $row['Gender'] == 'm' ? 'ذكر' : 'أنثى' ?></option>
                                                    <option value="<?= $row['Gender'] == 'm' ? 'f' : 'm' ?>"><?= $row['Gender'] == 'm' ? 'أنثى' : 'ذكر' ?></option>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                            <div class="form-group local-forms calendar-icon">
                                                <label>تاريخ الميلاد <span class="login-danger"></span></label>
                                                <input name="DOB" class="form-control datetimepicker" type="date" value="<?= $row['DOB'] ?>" placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                            <div class="form-group local-forms">
                                                <label>الأيميل <span class="login-danger"></span></label>
                                                <input name="email" class="form-control" type="text" value="<?= $row['email'] ?>">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                            <div class="form-group local-forms">
                                                <label>العنوان <span class="login-danger"></span></label>
                                                <input name="addrass" class="form-control" type="text" value="<?= $row['addrass'] ?>">
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-4">
                                            <div class="form-group local-forms">
                                                <label>الجنسية </label>
                                                <input name="national" class="form-control" type="text" value="<?= $row['national'] ?>">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                            <div class="form-group local-forms">
                                                <label>الجوال <span class="login-danger">*</span></label>
                                                <input name="phone" class="form-control" type="text" value="<?= $row['phone'] ?>">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                            <div class="form-group local-forms">
                                                <label>رقم البطاقة الشخصية </label>
                                                <input name="Id-card" class="form-control" type="text" value="<?= $row['Id-card'] ?>">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                            <div class="form-group students-up-files">
                                                <label> <b>الصورة الشخصية</b</label>
                                                        <div class="uplod">
                                                            <label class="file-upload image-upbtn mb-0">
                                                                اختر ملف <input name="photo" type="file">
                                                            </label>
                                                        </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-12">
                                            <div class="student-submit">
                                                <button name="submit" type="submit" class="btn btn-primary">تعديل</button>
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