<?php
session_start();
include "header.php";


$result = "";

$localhost = 'localhost';
$username = 'root';
$password = '';
$dbname = 'alnajah';

$cour_id = ' ';
$name = ' ';
$discreption = ' ';
$period = ' ';
$batch = ' ';
$teatcherID = ' ';
$hours = ' ';
$startDate = ' ';
$endDate = ' ';
$cost = ' ';
$diplom_id = ' ';


if (isset($_POST['edit'])) {
    $cour_id = $_POST['cour_id'];
    $name = $_POST['cour_name'];
    $discreption = $_POST['description'];
    $period = $_POST['period'];
    $batch = $_POST['batch'];
    $teatcherID = $_POST['teach_id'];
    $hours = $_POST['hours'];
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];
    $cost = $_POST['cost'];
    $diplom_id = $_POST['diplom_id'];
    //  $studet_limit=$_POST['studet_limit'];
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $sql = "UPDATE course SET cour_name = '$name',description = '$discreption' ,period= '$period',batch='$batch',teach_id='$teatcherID',
                  hours='$hours',startDate='$startDate',endDate='$endDate',cost='$cost',diplom_id='$diplom_id' where cour_id=$id";
    }
    $coon = new mysqli($localhost, $username, $password, $dbname);
    if ($coon->query($sql)) {
        header("Location: courses.php");
    }
}


$coon = new mysqli($localhost, $username, $password, $dbname);
try {
    global $result;
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $result = $coon->query("SELECT * FROM course where cour_id=$id");
        //var_dump($result);
        if ($result->num_rows > 0) {
            echo '<div class="container"></div>';
            echo '<table class="table table-hover table-striped">';
        }
    }
} catch (Exception $ex) {
    echo 'eroor';
    $ex->getMessage();
}
//finally{
//    $coon->close();
//}
?>

<div class="page-wrapper">
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

                    <li class="submenu active">
                        <a href="#"><i class="fas fa-book-reader"></i> <span class="me-4"> الدورات</span> <span class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="courses.php">قائمة الدورات</a></li>
                            <li><a href="add-course.php">اضافة دورة</a></li>
                            <li><a href="#" class="active">تعديل دورة</a></li>
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
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">تعديل الدورات</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="subjects.html">Course</a></li>
                        <li class="breadcrumb-item active">Add Course</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">

                <div class="card">
                    <div class="card-body">
                        <form action="" method="post">
                            <div class="row">
                                <div class="col-12">
                                    <h5 class="form-title"><span>معلومات الكورس</span></h5>
                                </div>

                                <?php
                                $row = $result->fetch_array();

                                ?>

                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>اسم الدورة<span class="login-danger">*</span></label>
                                        <input type="text" value="<?= $row['cour_name'] ?>" name="cour_name" class="form-control">
                                    </div>
                                </div>
                                <input type="hidden" name="cour_id" value="<?= $id ?>">
                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>الوصف<span class="login-danger">*</span></label>
                                        <input type="text" name="description" value="<?= $row['description'] ?>" class="form-control">
                                    </div>
                                </div>

                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>الفترة<span class="login-danger">*</span></label>
                                        <select id="period" name="period" value="<?= $row['period'] ?>" class="form-control">
                                            <option value="morning">صباحا</option>
                                            <option value="evening">مساء</option>

                                        </select>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>الدفعة<span class="login-danger">*</span></label>
                                        <input type="number" value="<?= $row['batch'] ?>" name="batch" class="form-control">
                                    </div>
                                </div>

                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <?php
                                        $sql = "SELECT teach_id ,name FROM teacher";
                                        $sqlResult = $coon->query($sql);
                                        ?>
                                        <script>
                                            console.log('<?= $sql ?>')
                                        </script>
                                        <?php ?>
                                        <label for="list"> المدرس<span class="login-danger">*</span></label>
                                        <input list="teacher" name="teach_id" value="<?= $row['teach_id'] ?>" class="form-control">
                                        <datalist id="teacher">
                                            <?php while ($row1 = $sqlResult->fetch_assoc()) {
                                                $dId = $row1['teach_id'];

                                            ?>
                                                <option name="teach_id" value="<?= $dId ?>"> <?= $row1['name'] ?> </option>
                                            <?php } ?>

                                        </datalist>
                                    </div>
                                </div>


                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>عدد الساعات<span class="login-danger">*</span></label>
                                        <input type="text" value="<?= $row['hours'] ?>" name="hours" class="form-control">
                                    </div>
                                </div>


                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>تاريخ البداية<span class="login-danger">*</span></label>
                                        <input type="date" name="startDate" value="<?= is_null($row['startDate']) ? " " : $row['startDate'] ?>" class="form-control">
                                    </div>
                                </div>

                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>تاريخ النهاية<span class="login-danger">*</span></label>
                                        <input type="date" name="endDate" value="<?= $row['endDate'] ?>" class="form-control">
                                    </div>
                                </div>


                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>السعر<span class="login-danger">*</span></label>
                                        <input type="text" name="cost" value="<?= $row['cost'] ?>" class="form-control">
                                    </div>
                                </div>

                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <?php
                                        $sql = "SELECT dip_id ,name FROM diplome";
                                        $sqlResult = $coon->query($sql);
                                        ?>
                                        <script>
                                            console.log('<?= $sql ?>')
                                        </script>
                                        <label for="list">رقم الدبلوم الخاص بهذه الدورة<span class="login-danger">*</span></label>
                                        <input list="deplome" name="diplom_id" value="<?= $row['diplom_id'] ?>" class="form-control">
                                        <datalist id="deplome">
                                            <?php while ($row = $sqlResult->fetch_assoc()) {
                                                $dId = $row['dip_id'];

                                            ?>
                                                <option name="diplom_id" value="<?= $dId ?>"> <?= $row['name'] ?> </option>
                                            <?php } ?>

                                        </datalist>
                                    </div>
                                </div>


                                <div class="col-12">
                                    <div class="student-submit">
                                        <button type="submit" name="edit" class="btn btn-primary">تعديل</button>
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

<script src="assets/js/script.js"></script>