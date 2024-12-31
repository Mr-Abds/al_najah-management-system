<?php
session_start();
if(!isset($_SESSION['user'])){
    header('Location: login.php');
}
include "header.php";

include "DB.php";
$db = new DB();
$arr = $db->getdiblomainfo();

?>

<div class="page-wrapper">
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

                    <li class="submenu active">
                        <a href="#"><i class="fas fa-certificate"></i> <span class="me-4"> الشهادات</span> <span class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="add_certfcation.php">اضافة شهادة</a></li>
                            <li><a href="Certfcation.php">عرض الشهادات</a></li>
                            <li><a href="certificted_student.php">الطلاب المستحقين لشهادات</a></li>
                            <li><a href="dibloma_certfcation.php" class="active"> شهادات الدبلومات</a></li>

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
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-sub-header">
                        <h3 class="page-title">Students</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="students.html">Student</a></li>
                            <li class="breadcrumb-item active">All Students</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <?php

            while ($dip_arr = $arr->fetch_array()) {

                $names = array();
                $course_arr = $db->getcourse($dip_arr[0]);
                $diblom = $dip_arr[0]; ?>
                <div class="col-sm-12">
                    <div class="card card-table comman-shadow">
                        <div class="card-body">

                            <div class="page-header">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h3 class="page-title"><?= $dip_arr[1] ?></h3>
                                    </div>

                                </div>
                            </div>

                            <div class="table-responsive">
                                <table
                                    class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">
                                    <thead class="student-thread">
                                        <tr>
                                            <th>اسم الطالب</th>
                                            <?php
                                            $cours = array();

                                            while ($course_info = $course_arr->fetch_array()) {
                                                $cours[] = $course_info[1]; ?>
                                                <th><?= $course_info[0] ?></th>


                                            <?php
                                                // $diplom=$course_info[1];
                                                $info = $db->getstudentName($course_info[1]);
                                                //var_dump($info);
                                                array_push($names, $info);
                                            } ?>
                                            <th class="text-end">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        //var_dump($cours);
                                        $array = array();
                                        foreach ($names as $value) {
                                            foreach ($value as $values) {
                                                $array[] = $values;
                                                # code...
                                            }
                                        }
                                        $array = array_unique($array);
                                        foreach ($array as $values) {
                                        ?>

                                            <tr>

                                                <td><?= $values ?></td>
                                                <?php
                                                $countfiald = 0;
                                                for ($i = 0; $i < count($cours); $i++) {  ?>
                                                    <td>
                                                        <?php
                                                        if ($db->check($values, $cours[$i])) {
                                                            $countfiald++;
                                                            echo "&#10004";
                                                        }
                                                        ?>


                                                    </td>
                                                <?php     }
                                                if ($countfiald == count($cours)) {


                                                ?>


                                                    <td class="text-end">
                                                        <div class="actions ">
                                                            <a href="add_certfcation.php?studentName=<?= $values ?>&diplom=<?= $dip_arr[0] ?>" class="btn btn-sm bg-danger-light">
                                                                <i class="fas fa-download icon"></i>

                                                            </a>
                                                        </div>
                                                    </td>
                                                <?php } else ?>
                                                <td></td>

                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>

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