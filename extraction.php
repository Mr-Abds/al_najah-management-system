<?php
$servername = "localhost";
$username = "root";
$password = "";
$databaseName = "alnajah";
session_start();
if(!isset($_SESSION['user'])){
    header('Location: login.php');
}
try {
    $conn = new mysqli($servername, $username, $password, $databaseName);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }



    /*  $sql = "SELECT DISTINCT s.*, c.diplom_id, d.name AS diploma_name
        FROM student s
        JOIN register_in ri ON s.std_id = ri.stud_id
        JOIN course c ON ri.cour_id = c.cour_id
        JOIN diplome d ON c.diplom_id = d.dip_id
        WHERE d.name = '$diplom_name';"; */

    if (!empty($_GET['nameSerch'])) {
        $nameSerch = $_GET['nameSerch'];

        $sql = "SELECT DISTINCT s.*, c.*, d.name AS diploma_name
        FROM student s
        JOIN register_in ri ON s.std_id = ri.stud_id
        JOIN course c ON ri.cour_id = c.cour_id
        JOIN diplome d ON c.diplom_id = d.dip_id
        WHERE `name_Ar` LIKE '%$nameSerch%';";
    }

    /* $sql = "SELECT 
            s.*, 
            c.cour_name, 
            c.batch
        FROM 
            student s
        JOIN 
            register_in r ON s.std_id = r.stud_id
        JOIN 
            course c ON r.cour_id = c.batch
        JOIN 
            diplome d ON c.diplom_id = d.dip_id
        WHERE 
            d.name = ? 
            AND c.batch = ?"; */

    /*  $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $diplom_name, $batch_number);
        $stmt->execute();
        $result = $stmt->get_result(); */
   /// $result = $conn->query($sql);
} catch (Exception $th) {
    die('' . mysqli_error($conn));
}

if (isset($_GET['genreat'])) {
}



if (isset($_GET['deletid'])) {
    $id = $_GET['deletid'];
    $mysql = "DELETE FROM `register_in` WHERE `stud_id` = $id";
    $conn->query($mysql);
    $mysql = "DELETE FROM `student` WHERE `std_id` = $id";
    if ($conn->query($mysql)) {
        header('Location: ' . $_SERVER['PHP_SELF']);
    }
}
?>


<!DOCTYPE html>
<html dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Preskool - Students</title>

    <link rel="shortcut icon" href="assets/img/favicon.png">

    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,700;0,900;1,400;1,500;1,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">

    <link rel="stylesheet" href="assets/plugins/feather/feather.css">

    <link rel="stylesheet" href="assets/plugins/icons/flags/flags.css">

    <link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">

    <link rel="stylesheet" href="assets/plugins/datatables/datatables.min.css">

    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

    <div class="main-wrapper">
        <div class="header">

            <div class="header-left">
                <a href="index.html" class="logo">
                    <img src="assets/img/logo.png" alt="Logo">
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
                            <span>Management</span>
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
                        <li class="submenu active">
                            <a href="attendance.php"><i class="fas fa-book-reader"></i> <span class="me-4"> التقارير</span> <span class="menu-arrow"></span></a>
                            <ul>
                                <li class="submenu active">
                                    <a>كشف البداية والنهاية لدبلوم </span> <span class="menu-arrow"></span></a>
                                    <ul>
                                        <li><a href="start-end-report.php?diplom_name=الحاسوب" class="<?= $_GET['diplom_name'] == 'الحاسوب' ? 'active' : '' ?>">دبلوم حاسوب</a></li>
                                        <li><a href="start-end-report.php?diplom_name=اللغة الإنجليزية" class="<?= $_GET['diplom_name'] == 'اللغة الإنجليزية' ? 'active' : '' ?>">دبلوم لغة أنجليزية</a></li>
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





                <div class="row">
                    <div class="col-sm-12">
                        <div class="card card-table comman-shadow">
                            <div class="card-body">

                                <div class="student-group-form">
                                    <form>
                                        <p>قم بالبحث عن أسم الطالب المراد عمل تقرير أستخراج شهادة له </p>
                                        <div class="row">

                                            <div class="col-lg-6 col-md-6">

                                                <div class="form-group">
                                                    <input name="nameSerch" type="text" class="form-control" placeholder="البحث بأسم الطالب ...">
                                                </div>
                                            </div>

                                            <div class="col-lg-2">

                                                <div class="search-student-btn">
                                                    <button type="btn" class="btn btn-primary">بحث</button>
                                                </div>
                                            </div>

                                        </div>
                                    </form>
                                </div>
                                <?php
                                if (!empty($_GET['nameSerch'])) {
                                ?>
                                    <div class="table-responsive">

                                        <table class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">

                                            <thead class="student-thread">

                                                <tr>

                                                    <th>ID</th>
                                                    <th>الأسم</th>
                                                    <th>رقم الجوال</th>
                                                    <th>العنوان</th>
                                                    <th class="text-start">العمليات</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                while ($row = $result->fetch_assoc()) {
                                                ?>
                                                    <tr>

                                                        <td><?= $row["std_id"] ?></td>
                                                        <td>
                                                            <h2 class="table-avatar">
                                                                <a href="student-details.php?id=<?= $row["std_id"] ?>" class="avatar avatar-sm  "><img class="avatar-img rounded-circle" src="assets/img/profiles/avatar-01.jpg" alt="User Image"></a>
                                                                <a href="student-details.php?id=<?= $row["std_id"] ?>" class="me-4"><?= $row["name_Ar"] ?></a>
                                                            </h2>
                                                        </td>

                                                        <td><?= $row["phone"] ?></td>
                                                        <td><?= $row["addrass"] ?></td>
                                                        <td class="text-end">
                                                            <div class="actions ">
                                                                <a href="student-details.php?id=<?= $row["std_id"] ?>" title="استعراض " class="btn btn-sm bg-success-light me-2 ">
                                                                    <i class="feather-eye"></i>
                                                                </a>
                                                                <a href="edit-student.php?id=<?= $row["std_id"] ?>" title=" تعديل" class="btn btn-sm bg-danger-light me-2">
                                                                    <i class="feather-edit"></i>
                                                                </a>
                                                                <a href="students.php?deletid=<?= $row["std_id"] ?>" title="حذف الطالب" class="btn btn-sm bg-danger-light me-2">
                                                                    <i class="feather-trash-2"></i>
                                                                </a>
                                                            </div>
                                                        </td>
                                                    <?php } ?>
                                                    </tr>

                                            </tbody>
                                        </table>
                                    </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <div class="card card-table comman-shadow">
                            <div class="card-body">
                                <div class="col-sm-2">
                                    <div class="search-student-btn">
                                        <a href="generate.php?diplom_name= " class="btn btn-primary">أنشاء تقرير</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
            </div>

            <footer>
                <p>Copyright © 2022 Dreamguys.</p>
            </footer>

        </div>

    </div>


    <script src="assets/js/jquery-3.6.0.min.js"></script>

    <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="assets/js/feather.min.js"></script>

    <script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <script src="assets/plugins/datatables/datatables.min.js"></script>

    <script src="assets/js/script.js"></script>
</body>

</html>