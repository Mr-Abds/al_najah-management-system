<?php
session_start();

use PhpOffice\PhpWord\TemplateProcessor;

$servername = "localhost";
$username = "root";
$password = "";
$databaseName = "alnajah";
$conn = new mysqli($servername, $username, $password, $databaseName);

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
}
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
function getgraduat($grad)
{
    if ($grad <= 100 & $grad > 90) {
        return "ممتاز";
    } elseif ($grad <= 90 & $grad > 75) {
        return "جيد حدا";
    } elseif ($grad <= 75 & $grad > 50) {
        return "جيد";
    } elseif ($grad <= 60 & $grad >= 50) {
        return "مقبول";
    } elseif ($grad <= 49 & $grad > 0) {
        return "راسب";
    } else {
        return "";
    }
}

function getCoursesByDiplomId($diplom_id, $conn)
{
    $sql = "SELECT * FROM course WHERE diplom_id = '$diplom_id'";
    $result = $conn->query($sql);
    $courses = array();
    while ($row = $result->fetch_assoc()) {
        $courses[] = $row;
    }
    return $courses;
}

function getStudentsByCourseId($course_id, $conn)
{
    $sql = "SELECT s.* FROM student s JOIN register_in ri ON s.std_id = ri.stud_id WHERE ri.cour_id = '$course_id'";
    $result = $conn->query($sql);
    $students = array();
    while ($row = $result->fetch_assoc()) {
        $students[] = $row;
    }
    return $students;
}

function getGradesByStudentIdAndCourseId($student_id, $course_id, $conn)
{
    $sql = "SELECT grad FROM register_in WHERE stud_id = '$student_id' AND cour_id = '$course_id'";
    $result = $conn->query($sql);
    $grade = $result->fetch_assoc();
    return isset($grade)  ? $grade['grad'] : "";
}

function calculateFinalGrade($diplom_id, $conn)
{
    $courses = getCoursesByDiplomId($diplom_id, $conn);
    $final_grades = array();
    foreach ($courses as $course) {
        $course_id = $course['cour_id'];
        $students = getStudentsByCourseId($course_id, $conn);
        foreach ($students as $student) {
            $student_id = $student['std_id'];
            $grades = array();
            foreach ($courses as $c) {
                $grades[] = getGradesByStudentIdAndCourseId($student_id, $c['cour_id'], $conn);
            }
            $final_grade = array_sum($grades) / count($grades);
            $final_grades[$student_id] = $final_grade;
        }
    }
    return $final_grades;
}






if (isset($_GET['diplom_name'])) {
    $diplom_name = $_GET['diplom_name'];
}

$massege = '';
$sql = "SELECT DISTINCT s.name_Ar, s.DOB, s.addrass, s.Gender, s.phone, s.std_id, s.qualification, c.diplom_id, d.name AS diploma_name
FROM student s
JOIN register_in ri ON s.std_id = ri.stud_id
JOIN course c ON ri.cour_id = c.cour_id
JOIN diplome d ON c.diplom_id = d.dip_id
WHERE d.name = '$diplom_name';";

$result = $conn->query($sql);
$students = array();
while ($row = $result->fetch_assoc()) {
    $students[] = $row;
}
$diplom_id = $students[0]['diplom_id'];
//echo $diplom_id;
//$s = getfinleGrad($diplom_id,$conn);
/* echo 'dddddddddddddddddd <br>';
foreach($s as $ss){
    echo $ss;
    echo 'dddddddddddddddddd <br>';
    echo '<br>';
} */


$sql1 = "SELECT * FROM `course` WHERE `diplom_id` = $diplom_id";
$result1 = $conn->query($sql1);
$courses = array();
while ($row = $result1->fetch_assoc()) {
    $courses[] = $row;
}
//var_dump($courses);
/* $gradsql = "SELECT s.std_id, c.cour_id, ri.grad
FROM student s
JOIN register_in ri ON s.std_id = ri.stud_id
JOIN course c ON ri.cour_id = c.cour_id
WHERE c.diplom_id = '$diplom_id'";
$grad_result = $conn->query($gradsql); */

$final_grades = calculateFinalGrade($diplom_id, $conn);
/* var_dump($final_grades);
echo '<br>dddddddd'; */
$final_results = array();
foreach ($final_grades as $student_id => $final_grade) {
    $final_results[$student_id] = array(
        'final_grade' => $final_grade,
        'final_percentage' => getGraduat($final_grade)
    );
}
//var_dump($final_results);

if (isset($_GET['generete'])) {

    $diblomType = $_GET['diblomType'];
    $coursesss = $_GET['courses'];
    $startdate = $_GET['startdate'];
    $enddate = $_GET['enddate'];
    $hours = $_GET['hours'];
    $from = $_GET['from'];
    $to = $_GET['to'];
    $teacher_name = $_GET['teacher_name'];
    $teacher_qualification = $_GET['teacher_qualification'];
    $instit_name = $_GET['instit_name'];



    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    require_once 'vendor/autoload.php';

    if (!class_exists('ZipArchive')) {
        die('ZipArchive is not enabled!');
    }
    $i = 0;
    // تحميل القالب

    try {
        $templateProcessor = new TemplateProcessor('الكشوفات\كشوفات البداية والنهاية الجديد.docx');
        $cpuntNULL = count($final_grades);
        for ($i = 0; $i < 25; $i++) {
            $templateProcessor->setValue('stud_name' . $i, isset($students[$i]) ? $students[$i]['name_Ar'] : '');
            $templateProcessor->setValue('DOB' . $i, isset($students[$i]) ? $students[$i]['DOB'] . '/' : '');
            $templateProcessor->setValue('address' . $i, isset($students[$i]) ? $students[$i]['addrass'] : '');
            $templateProcessor->setValue('qualification' . $i, isset($students[$i]) ? $students[$i]['qualification'] : '');
            $templateProcessor->setValue('cours_type' . $i, isset($courses[$i]) ? $courses[$i]['cour_name'] : '');
            $templateProcessor->setValue('co_hour' . $i, isset($courses[$i]) ? $courses[$i]['hours'] : '');
            $templateProcessor->setValue('cou_strDate' . $i, isset($courses[$i]) ? $courses[$i]['startDate'] : '');
            $templateProcessor->setValue('cou_endDate' . $i, isset($courses[$i]) ? $courses[$i]['endDate'] : '');

            $templateProcessor->setValue('grad' . $cpuntNULL, '');
            $templateProcessor->setValue('rating' . $cpuntNULL, '');

            $cpuntNULL++;
        }
        for ($i = 0; $i < count($final_grades); $i++) {
            $templateProcessor->setValue('grad' . $i, isset($final_grades[$students[$i]['std_id']]) ? $final_grades[$students[$i]['std_id']] : '');
        }
        for ($i = 0; $i < count($final_grades); $i++) {
            $templateProcessor->setValue('rating' . $i, isset($final_results[$students[$i]['std_id']]) ? $final_results[$students[$i]['std_id']]['final_percentage'] : '');
        }

        $templateProcessor->setValue('diblomType', $diblomType);
        $templateProcessor->setValue('courses', $coursesss);
        $templateProcessor->setValue('startdate', $startdate);
        $templateProcessor->setValue('enddate', $enddate);
        $templateProcessor->setValue('hours', $hours);
        $templateProcessor->setValue('from', $from);
        $templateProcessor->setValue('to', $to);
        $templateProcessor->setValue('teacher_name', $teacher_name);
        $templateProcessor->setValue('teacher_ qualification', $teacher_qualification);
        $templateProcessor->setValue('instit_name', $instit_name);



        $templateProcessor->saveAs("الكشوفات\كشوفات البداية والنهاية الجديد المعدل لدبلوم $diblomType.docx");

        /* header("Content-Disposition: attachment; filename=كشوفات البداية والنهاية الجديد المعدل لدبلوم $diblomType.docx");
        header("Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document");
        readfile('كشوفات البداية والنهاية الجديد المعدل لدبلوم $diblomType.docx'); */
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
}


?>


<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=0" />
    <title>Preskool - Horizontal Form</title>

    <link rel="shortcut icon" href="assets/img/favicon.png" />

    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,700;0,900;1,400;1,500;1,700&display=swap"
        rel="stylesheet" />

    <link
        rel="stylesheet"
        href="assets/plugins/bootstrap/css/bootstrap.min.css" />

    <link rel="stylesheet" href="assets/plugins/feather/feather.css" />

    <link rel="stylesheet" href="assets/plugins/icons/flags/flags.css" />

    <link
        rel="stylesheet"
        href="assets/plugins/fontawesome/css/fontawesome.min.css" />
    <link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css" />

    <link rel="stylesheet" href="assets/plugins/select2/css/select2.min.css" />
    <link rel="stylesheet" href="assets\plugins\scrollbar\scroll.min.css">
    <link rel="stylesheet" href="assets/css/style.css" />
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
                                    <a>كشف البداية والنهاية لدبلوم </span> <span class="menu-arrow"></span></a>
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
                    <div class="row">
                        <div class="col">
                            <h3 class="page-title">المعلومات النهائية للتقرير<?= $massege ?></h3>

                        </div>
                    </div>
                </div>



                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">المعلومات النهائية للتقرير</h5>
                            </div>
                            <div class="card-body">
                                <form>
                                    <div class="row">
                                        <div class="col-xl-6">
                                            <h5 class="card-title">تفاصيل الدورة / الدبلوم</h5>
                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">نوع الدبلوم/الدورة:</label>
                                                <div class="col-lg-9">
                                                    <input name="diblomType" type="text" class="form-control" value="<?= $diplom_name ?>" />
                                                </div>
                                            </div>
                                            <?php
                                            $courses = getCoursesByDiplomId($diplom_id, $conn);
                                            $c = '';
                                            for ($i = 0; $i < count($courses); $i++) {
                                                $c .= $courses[$i]["cour_name"] . ', ';
                                            }
                                            ?>
                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">ويشمل الدبلوم الدورات التالية:</label>
                                                <div class="col-lg-9">
                                                    <textarea
                                                        rows="4"
                                                        cols="5"
                                                        class="form-control"
                                                        placeholder="<?= $c ?>"
                                                        name="courses" value="<?= $c ?>"></textarea>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label class="col-lg-3 col-form-label">تاريخ البداية والنهاية</label>
                                                <div class="col-lg-9">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="form-control">البداية:</label>
                                                                <input
                                                                    type="date"
                                                                    name="startdate"
                                                                    class="form-control" />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="form-control">النهاية:</label>
                                                                <input
                                                                    type="date"
                                                                    name="enddate"
                                                                    class="form-control" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">مدة الدورة بالساعات:</label>
                                                <div class="col-lg-5">

                                                    <input name="hours" type="number" class="form-control">
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-xl-6">

                                            <div class="row">
                                                <label class="col-lg-3 col-form-label">أوقات الدراسة</label>
                                                <div class="col-lg-9">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="form-control">من:</label>
                                                                <input
                                                                    type="text"
                                                                    name="from"
                                                                    class="form-control"
                                                                    value="8 صباحا" />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="form-control">الى:</label>
                                                                <input
                                                                    type="text"
                                                                    name="to"
                                                                    class="form-control"
                                                                    value="12 مساءا" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <h5 class="card-title">تفاصيل المعهد</h5>
                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">اسم مدرب الدورة:</label>
                                                <div class="col-lg-9">
                                                    <input name="teacher_name" type="text" class="form-control" />
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">مؤهل مدرب الدورة:</label>
                                                <div class="col-lg-9">
                                                    <input name="teacher_qualification" type="text" class="form-control" />
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">اسم مدير المعهد:</label>
                                                <div class="col-lg-9">
                                                    <input name="instit_name" value="أيمن خميس هندوم" type="text" class="form-control" />
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <input name="diplom_name" type="hidden" value="<?= $_GET['diplom_name'] ?>">
                                    <div class="text-end">
                                        <button name="generete" type="submit" class="btn btn-primary">
                                            أنـشـــــــــاء
                                        </button>
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

    <script src="assets/plugins/select2/js/select2.min.js"></script>
    <script src="assets/plugins/scrollbar/custom-scroll.js"></script>
    <script src="assets/plugins/scrollbar/scrollbar.min.js"></script>
    <script src="assets/js/script.js"></script>
</body>

</html>