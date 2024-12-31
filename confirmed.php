<?php
$servername = "localhost";
$username = "root";
$password = "";
$databaseName = "alnajah";

$course_id = '';
session_start();
if(!isset($_SESSION['user'])){
    header('Location: login.php');
}
try {
    $conn = new mysqli($servername, $username, $password, $databaseName);
    $sql = "SELECT * FROM student";
    $result = $conn->query($sql);
    $courses = array();
    $row = $result->fetch_assoc();
    $id = $row['std_id'];

    // $sql3 = "SEL"

    /* if () {
        
        //  echo "id: " . $row["id"]. " - Name: " . $row
        

       // echo "Database created successfully";
    } else {
        echo "Error creating database: " . $conn->error;
    }
 */
} catch (Exception $th) {
    die('' . mysqli_error($conn));
}
if (!empty($_GET['course_id'])) {
    global $course_id;
    $course_id = $_GET['course_id'];
    $sql = "SELECT s.* FROM student s JOIN register_in r ON s.std_id = r.stud_id JOIN course c ON r.cour_id = c.cour_id WHERE c.cour_id = $course_id;";
    $result = $conn->query($sql);
    $sql_course = "SELECT * FROM course WHERE cour_id = $course_id";
    $result_course  = $conn->query($sql_course);
    $row_course = $result_course->fetch_assoc();
    global $course_name;
    $course_name = $row_course['cour_name'];
}
//$row = $result->fetch_assoc();
//$student_id = $row['std_id'];

//if (isset($_GET['complete'])){
//    $student_id = $_GET['std_id'];
//    $course_id = $_GET['course_id'];
//    $sql_pay = "UPDATE register_in SET isComlpted=1 WHERE stud_id=$student_id AND cour_id=$course_id";
//    $conn->query($sql_pay);
//    header("Location:confirmed.php?course_id=$course_id");
//}
if (isset($_GET['pay'])){
    $s = $_GET['std_id'];
    $c = $_GET['course_id'];
    $sql_pay = "UPDATE register_in SET ispay=1 WHERE stud_id=$s AND cour_id=$c";
    $conn->query($sql_pay);
                                        header("Location:confirmed.php?course_id=$c");
}

if (isset($_GET['complete'])){
    $s = $_GET['std_id'];
    $c = $_GET['course_id'];
    $sql_complete = "UPDATE register_in SET isComlpted=1 WHERE stud_id=$s AND cour_id=$c";
    $conn->query($sql_complete);
    header("Location:confirmed.php?course_id=$c");
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

    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,700;0,900;1,400;1,500;1,700&display=swap"
          rel="stylesheet">

    <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/style.css">

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


            <div class="student-group-form">
                <div class="row">

                    <div class="col-lg-3 col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="البحث بأسم الطالب ...">
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
                    <div class="card card-table comman-shadow">
                        <div class="card-body">

                            <div class="page-header">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h3 class="page-title">قائمة بأسماء جميع الطلاب في دورة   </h3>
                                    </div>
                                    <div class="col-auto text-end float-end ms-auto download-grp">

                                        <a href="add-student.php" class="btn btn-primary"><i class="fas fa-plus"></i>اضافة طالب جديد</a>

                                    </div>

                                </div>

                            </div>

                            <div class="table-responsive">

                                <table class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">

                                    <thead class="student-thread">

                                    <tr>

                                        <th>ID</th>
                                        <th>الأسم</th>
                                        <th>رقم الجوال</th>
                                        <th>العنوان</th>
                                        <th>التأكيد</th>
                                        <th>الدفع</th>
                                        <th>اكمال الدورة</th>
                                        <th class="text-start">العمليات</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    while ($row = $result->fetch_assoc()) {
                                    $std_id=$row["std_id"];
                                    $sql_confirmed = "SELECT isConfirm FROM register_in WHERE stud_id=$std_id AND cour_id=$course_id";
                                    $result_confirmed = $conn->query($sql_confirmed);
                                    $row_confirmed = $result_confirmed->fetch_assoc();
                                    $isConfirmed = $row_confirmed['isConfirm'];
                                    $sql_payed = "SELECT ispay FROM register_in WHERE stud_id=$std_id AND cour_id=$course_id ";
                                    $result_payed = $conn->query($sql_payed);
                                    $row_payed = $result_payed->fetch_assoc();
                                    $isPayed = $row_payed['ispay'];
                                    $sql_completed = "SELECT isComlpted FROM register_in WHERE stud_id=$std_id AND cour_id=$course_id";
                                    $result_completed = $conn->query($sql_completed);
                                    $row_completed = $result_completed->fetch_assoc();
                                    $isCompleted = $row_completed['isComlpted'];




                                    ?>
                                    <tr>

                                        <td><?= $row["std_id"] ?></td>
                                        <td>
                                            <h2 class="table-avatar">
                                                <a href="student-details.php?id=<?= $row["std_id"] ?>"
                                                   class="avatar avatar-sm  "><img class="avatar-img rounded-circle"
                                                                                   src="assets/img/profiles/avatar-01.jpg"
                                                                                   alt="User Image"></a>
                                                <a href="student-details.php?id=<?= $row["std_id"] ?>"
                                                   class="me-4"><?= $row["name_Ar"] ?></a>
                                            </h2>
                                        </td>

                                        <td><?= $row["phone"] ?></td>
                                        <td><?= $row["addrass"] ?></td>
                                        <td>
                                            <?php
                                            if ($isConfirmed == 1) {
                                                echo "<span class='badge badge-success'>مؤكد</span>";
                                            } else {
                                                echo "<span class='badge badge-danger'>غير مؤكد</span>";
                                            ?>
                                                <a href="confirm.php?id=<?= $row["std_id"] ?>" title="تأكيد الطالب"
                                                   class="btn btn-sm bg-danger-light me-2">
                                                    <i class="feather-send"></i>
                                                </a>
                                            <?php
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                                  if ($isPayed == 1){
                                                      echo "<span class='badge badge-success'>دفع</span>";
                                                  }else{
                                                      echo "<span class='badge badge-danger'>لم يدفع</span>";
                                                  ?>
                                                  <form>
                                                      <input type="hidden" value="<?= $course_id ?>" name="course_id">
                                                      <input type="hidden" value="<?= $std_id ?>" name="std_id">
                                                      <button type="submit" href="confirmed.php?id="
                                                         class="btn btn-sm bg-danger-light me-2" name="pay">
                                                          دفع
                                                      </button>
                                                  </form>
                                            <?php
                                                  }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            if ($isCompleted == 1) {
                                                echo "<span class='badge badge-success'>أكمل الدورة</span>";
                                            } else {
                                                echo "<span class='badge badge-danger'>لم يكمل الدورة</span>";
                                            ?>
                                                <form>
                                                    <input type="hidden" value="<?= $course_id ?>" name="course_id">
                                                    <input type="hidden" value="<?= $std_id ?>" name="std_id">
                                                    <button type="submit" href="confirmed.php?id="
                                                            class="btn btn-sm bg-danger-light me-2" name="complete">
                                                        أكمل الدورة
                                                    </button>
                                                </form>
                                            <?php
                                            }
                                            ?>
                                        </td>
                                        <td class="text-end">
                                            <div class="actions">
                                                <a href="student-details.php?id=<?= $row["std_id"] ?>" title="استعراض "
                                                   class="btn btn-sm bg-success-light me-2 ">
                                                    <i class="feather-eye"></i>
                                                </a>
                                                <a href="students.php?deletid=<?= $row["std_id"] ?>" title="حذف الطالب"
                                                   class="btn btn-sm bg-danger-light me-2">
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

<script src="assets/plugins/datatables/datatables.min.js"></script>

<script src="assets/js/script.js"></script>

</body>

</html>