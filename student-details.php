<?php
$servername = "localhost";
$username = "root";
$password = "";
$databaseName = "alnajah";
//$std_id = 1;
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
}
if (isset($_GET['id'])) {
    $std_id = $_GET['id'];
}

try {
    $conn = new mysqli($servername, $username, $password, $databaseName);
    $sql = "SELECT * FROM student WHERE std_id = $std_id ";
    $result = $conn->query($sql);
    $row = $result->fetch_array();
    $sql1 = "SELECT c.* FROM student s JOIN register_in r ON s.std_id = r.stud_id JOIN course c ON r.cour_id = c.cour_id WHERE s.std_id = $std_id;";
    $result1 = $conn->query($sql1);
    //$row1 = $result1->fetch_array();
    $sql2 = "SELECT * FROM register_in WHERE stud_id = $std_id";
    $result2 = $conn->query($sql2);
    //$row2 = $result2->fetch_array();
} catch (Exception $th) {
    die('' . mysqli_error($conn));
}
?>


<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>معهد النجاح - تفاصيل الطالب</title>

    <link rel="shortcut icon" href="assets/img/logo.jpg">
    <!-- <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,700;0,900;1,400;1,500;1,700&display=swap" rel="stylesheet">
 -->
    <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">

    <link rel="stylesheet" href="assets/plugins/feather/feather.css">

    <link rel="stylesheet" href="assets/plugins/icons/flags/flags.css">

    <link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">

    <link rel="stylesheet" href="assets/plugins/datatables/datatables.min.css">
    <link rel="stylesheet" href="assets\plugins\scrollbar\scroll.min.css">
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
                        <li class="submenu active">
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
                                    <a>كشف البداية والنهاية </span> <span class="menu-arrow"></span></a>
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

                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="text-start">
                                    <h4 class="text-start">الملف الشخصي للطالب </h4>
                                </div>
                                <div class="student-profile-head">

                                    <div class="row">
                                        <div class="col-lg-4 col-md-4">
                                            <div class="profile-user-box">
                                                <div class="profile-user-img">
                                                    <img src="assets/img/<?= $row['Gender'] == 'm' ? 'OIP.jpeg' : 'OIP (1).jpeg' ?>" alt="Profile">

                                                    <div class="form-group students-up-files profile-edit-icon mb-0">
                                                        <div class="uplod d-flex">
                                                            <label class="file-upload profile-upbtn mb-0">
                                                                <i class="feather-edit-3"></i>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="names-profiles me-2">
                                                    <h4><?= $row['name_Ar'] ?></h4>
                                                    <h5><?= $row['name_En'] ?></h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 d-flex align-items-center">
                                            <div class="follow-group">

                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 d-flex align-items-center">
                                            <div class="follow-btn-group">
                                                <a href="edit-student.php?id=<?= $row['std_id'] ?>" class="btn btn-info follow-btns ">تعديل </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="student-personals-grp">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="heading-detail">
                                                <h4>معلوماته الشخصية:</h4>
                                            </div>
                                            <div class="personal-activity">
                                                <div class="personal-icons">
                                                    <i class="feather-user"></i>
                                                </div>
                                                <div class="views-personal">
                                                    <h4 class="me-2">أسمه </h4>
                                                    <h5 class="me-2"><?= $row['name_Ar'] ?></h5>
                                                </div>
                                            </div>
                                            <div class="personal-activity">
                                                <div class="personal-icons">
                                                    <i class="feather-user"></i>
                                                </div>
                                                <div class="views-personal">
                                                    <h4 class="me-2">أسمه باللغة الانجليزية </h4>
                                                    <h5 class="me-2"><?= $row['name_En'] ?></h5>
                                                </div>
                                            </div>

                                            <div class="personal-activity">
                                                <div class="personal-icons">
                                                    <i class="feather-phone-call"></i>
                                                </div>
                                                <div class="views-personal">
                                                    <h4 class="me-2"> رقم الجوال</h4>
                                                    <h5 class="me-2"><?= $row['phone'] ?></h5>
                                                </div>
                                            </div>
                                            <div class="personal-activity">
                                                <div class="personal-icons">
                                                    <i class="feather-mail"></i>
                                                </div>
                                                <div class="views-personal">
                                                    <h4 class="me-2">الأيميل</h4>
                                                    <h5 class="me-2"><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="81e5e0e8f2f8c1e6ece0e8edafe2eeec"><?= $row['email'] ?></a></h5>
                                                </div>
                                            </div>
                                            <div class="personal-activity">
                                                <div class="personal-icons">
                                                    <i class="feather-user"></i>
                                                </div>
                                                <div class="views-personal">
                                                    <h4 class="me-2">الجنس</h4>
                                                    <h5 class="me-2"><?= $row['Gender'] == 'm' ? 'ذكر' : 'أنثى' ?> </h5>
                                                </div>
                                            </div>
                                            <div class="personal-activity">
                                                <div class="personal-icons">
                                                    <i class="feather-phone-call"></i>
                                                </div>
                                                <div class="views-personal">
                                                    <h4 class="me-2">الجنسية </h4>
                                                    <h5 class="me-2"><?= $row['national'] ?></h5>
                                                </div>
                                            </div>
                                            <div class="personal-activity">
                                                <div class="personal-icons">
                                                    <i class="feather-calendar"></i>
                                                </div>
                                                <div class="views-personal">
                                                    <h4 class="me-2">تاريخ الميلاد</h4>
                                                    <h5 class="me-2"><?= $row['DOB'] ?></h5>
                                                </div>
                                            </div>
                                            <div class="personal-activity mb-0">
                                                <div class="personal-icons">
                                                    <i class="feather-map-pin"></i>
                                                </div>
                                                <div class="views-personal">
                                                    <h4 class="me-2">العنوان</h4>
                                                    <h5 class="me-2"><?= $row['addrass'] ?></h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-lg-8">
                                <div class="student-personals-grp">
                                    <div class="card mb-0">
                                        <div class="card-body">
                                            <div class="heading-detail">
                                                <h4> الدورات التي شارك فيها الطالب</h4>
                                            </div>

                                            <div class="hello-park">
                                                <?php
                                                while ($row = $result1->fetch_assoc()) {
                                                ?>
                                                    <div class="educate-year">
                                                        <h5><?= $row["cour_name"] ?></h5>
                                                        <p><?= $row["description"] ?></p>
                                                        <h6>من <?= $row["startDate"] ?></h6>
                                                        <h6>ألى <?= $row["endDate"] ?></h6>
                                                        <h6>الفترة <?= $row["period"] == 1 ? 'الصباحية' : 'المسائية' ?></h6>

                                                        <h6> عدد الساعات</h6>
                                                        <p><?= $row["hours"] ?></p>

                                                        <?php
                                                        $row2 = $result2->fetch_assoc();
                                                        if ($row2["isComlpted"] == 1) { ?>
                                                            <div class="skill-blk">
                                                                <div class="skill-statistics">
                                                                    <div class="skills-head">
                                                                        <h5>النسبة النهائية</h5>
                                                                        <p><?= $row2["grad"] ?>%</p>
                                                                    </div>
                                                                    <div class="progress mb-0">
                                                                        <div class="progress-bar bg-photoshop" role="progressbar" style="width: <?= $row2["grad"] ?>%" aria-valuenow="<?= $row2["grad"] ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php } else { ?>
                                                            <h5>لم يكمل</h5>
                                                    </div>
                                                    <hr>
                                            <?php }
                                                    } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <footer>
                <p>Copyright © 2024 Alnajah Institute.</p>
            </footer>

        </div>

    </div>


    <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="assets/js/jquery-3.6.0.min.js"></script>

    <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="assets/js/feather.min.js"></script>

    <script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="assets/plugins/scrollbar/custom-scroll.js"></script>
    <script src="assets/plugins/scrollbar/scrollbar.min.js"></script>
    <script src="assets/js/script.js"></script>
</body>

</html>