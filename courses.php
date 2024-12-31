<?php
session_start();
if(!isset($_SESSION['user'])){
    header('Location: login.php');
}
include "header.php";


$localhost = 'localhost';
$username = 'root';
$password = '';
$dbname = 'alnajah';
$coon = new mysqli($localhost, $username, $password, $dbname);

//if(isset($_POST['delete'])){
//    $id = $_POST['id'];
//    try{
//        $sql="DELETE FROM course ";
//    }
//    catch(Exception $ex){
//        echo "errore ";
//    }
//}
$coon = new mysqli($localhost, $username, $password, $dbname);
try {

    $sql = "select * from course";
    $result = $coon->query($sql);
    //    if($result==true) {
    //        echo '<div class="alert alert-success" role="alert">
    //     تمت عرض البيانات بنجاح
    //     </div>';
    //    }
} catch (Exception $ex) {
    echo '<div class="alert alert-danger" role="alert">
       هنالك خطاء موجود في العملية
     </div>' . $ex->getMessage();
}

function getteecher() {}

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
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">

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
                                    <h3 class="page-title">الدورات</h3>
                                </div>

                            </div>
                        </div>

                        <div class="table-responsive">
                            <form action="" method="post">
                                <table
                                    class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">
                                    <thead class="student-thread">
                                        <tr>

                                            <th>الكورس</th>
                                            <!--                                        <th>description</th>-->
                                            <th>المعلم </th>
                                            <th>الساعات</th>
                                            <th>cost</th>
                                            <!--                                        <th>has_test</th>-->
                                            <!-- <th>الدبلوم </th> -->
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        while ($course = $result->fetch_assoc()) {
                                            $teachresult = $coon->query("SELECT `name` FROM `teacher` WHERE `teach_id`= " . $course['teach_id'] . " ");
                                            $teachresult = $teachresult->fetch_column();
                                            $c = $course['diplom_id'];
                                            $dipresult = $coon->query("SELECT `name` FROM `diplome` WHERE `dip_id`='$c'; ");
                                            $dipresult = $dipresult->fetch_column();
                                            $x = 1;
                                        ?>
                                            <tr>
                                                <!-- <td><?= $course["cour_id"] ?></td> -->
                                                <td><a href="confirmed.php?course_id=<?= $course['cour_id'] ?>"><?= $course["cour_name"] ?></a></td>
                                                <!-- <td><?= $course["description"] ?></td> -->
                                                <td><?= $teachresult ?></td>
                                                <td><?= $course["hours"] ?></td>
                                                <td><?= $course["cost"] ?></td>
                                                <!--  <td><? $course["has_test"] ?></td>
                                    <td><?= $dipresult ?></td>
                                    <td><?= $post["body"] ?></td> -->

                                                <td><a type='button' href="edit-course.php?id=<?= $course['cour_id'] ?>" title="تعديل الدورة" class='btn btn-sm bg-danger-light'>
                                                        <i class="feather-edit"></i>
                                                    </a></td>
                                                <!--                                  <td><button type='button' name='del' onclick='let mes=confirm("are you sure")'  class='btn btn-danger'>Delete</button></td>
 -->
                                            </tr>


                                        <?php } ?>
                                    </tbody>
                                </table>
                            </form>
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