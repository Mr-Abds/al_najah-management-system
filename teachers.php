<?php

//include "controller.php";

session_start();
if(!isset($_SESSION['user'])){
    header('Location: login.php');
}
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
$sql = "SELECT * FROM teacher";
$result = $conn->query($sql);
if (isset($_GET['id_delete'])) {
    $id = $_GET['id_delete'];
    $sqldelete = "DELETE FROM teacher WHERE teach_id=$id";
    if ($conn->query($sqldelete)) {
        header("Location:teachers.php");
    }
}



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Preskool - Teachers</title>

    <link rel="shortcut icon" href="assets/img/favicon.png">

    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,700;0,900;1,400;1,500;1,700&display=swap"
        rel="stylesheet">

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
                                <li><a href="teachers.php" class="active">قائمة المدربين</a></li>

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
                        <div class="col">
                            <h3 class="page-title">Teachers</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">لوحة التحكم</a></li>
                                <li class="breadcrumb-item active">المدربين</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="student-group-form">
                    <div class="row">
                        
                        <div class="col-lg-3 col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="البحث بالاسم">
                            </div>
                        </div>
                        
                        <div class="col-lg-2">
                            <div class="search-student-btn">
                                <button type="btn" class="btn btn-primary">بحث</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card card-table">
                            <div class="card-body">

                                <div class="page-header">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h3 class="page-title">المدربين</h3>
                                        </div>
                                        <div class="col-auto text-end float-end ms-auto download-grp">
                                            
                                            <a href="add-teacher.php" class="btn btn-primary"><i
                                                    class="fas fa-plus"></i></a>
                                        </div>
                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">
                                        <thead class="student-thread">
                                            <tr>
                                                 
                                                <th>ID</th>
                                                <th>اسم المدرب </th>
                                                <th>رقم الجوال</th>
                                                <th class="text-start">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                            while ($row = $result->fetch_assoc()) {

                                            ?>
                                                <tr>

                                                    
                                                    <td><?= $row["teach_id"] ?></td>
                                                    <td>
                                                        <h2 class="table-avatar">
                                                            <a href="teacher-details.php?id=<?= $row["teach_id"] ?>" class="avatar avatar-sm me-2"><img class="avatar-img rounded-circle" src="assets/img/OIP.jpeg" alt="User Image"></a>
                                                            <a href="teacher-details.php?id=<?= $row["teach_id"] ?>" class="me-2"><?= $row["name"] ?></a>
                                                        </h2>
                                                    </td>

                                                    <td><?= $row["phone"] ?></td>
                                                    <td class="text-end">
                                                        <div class="actions ">
                                                            <a href="teacher-details.php?id=<?= $row["teach_id"] ?>" title="استعراض " class="btn btn-sm bg-success-light me-2 ">
                                                                <i class="feather-eye"></i>
                                                            </a>
                                                            <a href="edit-teacher.php?id=<?= $row["teach_id"] ?>" title=" تعديل" class="btn btn-sm bg-danger-light me-2">
                                                                <i class="feather-edit"></i>
                                                            </a>
                                                            <a href="teachers.php?id_delete=<?= $row["teach_id"] ?>" title="حذف المدرب" class="btn btn-sm bg-danger-light">
                                                                <i class="feather-trash-2"></i>
                                                            </a>
                                                        </div>
                                                    </td>
                                                <?php } ?>
                                                </tr>








                                                <!---->
                                                <!--                                    --><?php
                                                                                            //
                                                                                            //                                    while ($row=$result->fetch_assoc()){
                                                                                            //                                        if ($row['Gender'] =="M") {
                                                                                            //                                            $s = $row['Gender'];
                                                                                            //                                            $s = "ذكر";
                                                                                            //                                        }else{
                                                                                            //                                            $s="انثئ";
                                                                                            //                                        }
                                                                                            //                                        echo '<tr>';
                                                                                            //                                        echo '<td><div class="form-check check-tables"> <input class="form-check-input" type="checkbox" value="something">' . '</div></td>';
                                                                                            //                                        echo '<td>' . $row['teach_id'] . '</td>';
                                                                                            //                                        echo '<td> <h2 class="table-avatar"><a href="teacher-details.php?id='.$row['teach_id'].'" class="avatar avatar-sm me-2">
                                                                                            //                                            <img class="avatar-img rounded-circle"
                                                                                            //                                           src="assets/img/profiles/avatar-02.jpg" alt="User Image"> <a href="teacher-details.php?id='.$row['teach_id'].'">' . $row['name_Ar'] . '</a></a></h2></td>';
                                                                                            //                                        echo '<td>' . $row['name_En'] . '</td>';
                                                                                            //                                        echo '<td>' . $s . '</td>';
                                                                                            //                                        echo '<td>' . $row['cv'] . '</td>';
                                                                                            //                                        echo '<td>' . $row['addrass'] . '</td>';
                                                                                            //                                        echo '<td>' . $row['phone'] . '</td>';
                                                                                            //                                        echo '<td class="text-end" > <div class="actions"><a href="edit-teacher.php?id='.$row["teach_id"].'" class="btn btn-sm bg-danger-light" ><i class="feather-edit"> ' . '</li></a></div></td>';
                                                                                            //                                        echo '</tr>';
                                                                                            //                                    
                                                                                            ?>



                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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