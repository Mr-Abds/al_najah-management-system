<?php
$servername = "localhost";
$username = "root";
$password = "";
$databaseName = "alnajah";

$conn = new mysqli($servername, $username, $password, $databaseName);
$massge = '';
session_start();
if(!isset($_SESSION['user'])){
    header('Location: login.php');
}
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$course_id = 0;
if (isset($_GET['course_id'])) {
    $course_id = $_GET['course_id'];
}

$sql = "SELECT s.* FROM student s JOIN register_in r ON s.std_id = r.stud_id JOIN course c ON r.cour_id = c.cour_id WHERE c.cour_id = '$course_id'";
$result = $conn->query($sql);

$courses = array();
$sql1 = "SELECT * FROM course";
$result2 = $conn->query($sql1);
while ($row = $result2->fetch_assoc()) {
    $courses[] = $row;
}

// معالجة إرسال عدد أيام الغياب
if (isset($_POST['submit'])) {
    foreach ($_POST['absentdayNO'] as $student_id => $absent_days) {
        $sql = "INSERT INTO attendance (reg_id, absentdayNO) VALUES ((SELECT r.reg_id FROM register_in r JOIN student s ON r.stud_id = s.std_id JOIN course c ON r.cour_id = c.cour_id WHERE c.cour_id = '$course_id' AND s.std_id = '$student_id'), '$absent_days')";
        if ($conn->query($sql)) {
            $massge = "<div class='alert alert-secondary alert-dismissible fade show'
                role='alert'><h5>تم تحديث كشف الغياب </h5></div>";
        }
    }
}

?>

<!DOCTYPE html>
<html dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>معهد النجاح - الغياب</title>

    <link rel="shortcut icon" href="assets/img/logo.jpg">

    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,700;0,900;1,400;1,500;1,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">

    <link rel="stylesheet" href="assets/plugins/feather/feather.css">

    <link rel="stylesheet" href="assets/plugins/icons/flags/flags.css">

    <link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="assets\plugins\scrollbar\scroll.min.css">
    <link rel="stylesheet" href="assets/plugins/datatables/datatables.min.css">

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
                        <li class="active">
                            <a href="attendance.php" class="active"><i class="fas fa-book-reader"></i> <span class="me-4"> الغياب</span> </span></a>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
        <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card card-table comman-shadow">
                            <div class="card-body">

                                <div class="page-header">

                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h3 class="page-title">كشف تحضير الطلاب</h3>
                                        </div>
                                    </div>

                                </div>
                                <form action="" method="get">

                                    <div class="col-12 col-sm-4  mt-2">
                                        <div class="form-group local-forms ">
                                            <label>فلترة الطلاب حسب الدورة </label>
                                            <select name="course_id" class="form-control select form-inline">
                                                <option value="">كل الطلاب </option>
                                                <?php foreach ($courses as $course) { ?>
                                                    <option value="<?= $course['cour_id']; ?>" <?php if ($course_id == $course['cour_id']) echo 'selected'; ?>><?php echo $course['cour_name']; ?></option>
                                                <?php } ?>
                                            </select>
                                            <div class="student-submit mt-2">
                                                <input type="submit" class="btn btn-primary" value="فلترة">
                                            </div>
                                        </div>
                                    </div>

                                </form>
                                <?= $massge ?>
                                <form action="" method="post">
                                    <div class="table-responsive">

                                        <table class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">

                                            <thead class="student-thread">

                                                <tr>

                                                    <th>ID</th>
                                                    <th>الأسم</th>
                                                    <th>عدد الغياب</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php while ($row = $result->fetch_assoc()) { ?>
                                                    <tr>

                                                        <td><?= $row["std_id"] ?></td>
                                                        <td>
                                                            <h5 class="table-avatar">
                                                                <a href="student-details.php?id=<?= $row["std_id"] ?>" class="me-4"><?= $row["name_Ar"] ?></a>
                                                            </h5>
                                                        </td>
                                                        <td>
                                                            <div class="col-12 col-sm-4  mt-2">
                                                                <div class="input-group">
                                                                    <input name="absentdayNO[<?= $row["std_id"] ?>]" type="number" class="form-control" />
                                                                    <span class="input-group-text">يوم</span>
                                                                </div>
                                                            </div>
                                                        </td>

                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <input type="hidden" name="course_id" value="<?= isset($_GET['course_id']) ? $_GET['course_id'] : '' ?>">
                                    <div class="student-submit mt-2">
                                        <input type="submit" name="submit" id="position-bottom-start" class="btn btn-primary" value="تاكيد">
                                    </div>
                                </form>
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


    <script src="assets/js/jquery-3.6.0.min.js"></script>

    <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="assets/js/feather.min.js"></script>

    <script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <script src="assets/plugins/sweetalert/sweetalert2.all.min.js"></script>
    <script src="assets/plugins/sweetalert/sweetalerts.min.js"></script>

    <script src="assets/js/script.js"></script>
</body>

</html>