<?php
session_start();
if(!isset($_SESSION['user'])){
    header('Location: login.php');
}
include "header.php";
//include "sidebar.php";
$localhost='localhost';
$username='root';
$password='';
$dbname='alnajah';
$coon=new mysqli($localhost,$username,$password,$dbname);
$sql="SELECT * FROM diplome ";
$result=$coon->query($sql);
$ms ="";
if($result->num_rows>0){

if(isset($_POST['$result'])) {
    echo '<div class="container"></div>';
    echo '<table class="table table-hover table-striped">';
}

if(isset($_POST['delete'])){
    $id = $_POST['delete'];
    try{

        $sql="DELETE FROM diplome where dip_id= '$id' ";

       if($coon->query($sql)){
        header('location:departments.php');

       }
       if(isset($sql)) {

            $ms= "<div class='alert alert-info pt-4 pt-4'><h4 style='color:forestgreen;' > !!تم الحذف بنجاح</h4> </div>";
           
       }

    }
    catch(Exception $ex){
        echo "هناك خطاء في التعديل ";
    }


}
$coon->close();
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
                <li class="submenu active">
                    <a href="#"><i class="fas fa-building"></i> <span>الدبلوم</span> <span
                            class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="departments.php" class="active">عرض الدبلومات</a></li>
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
                            <!-- <h3 class="page-title">Departments</h3> -->
                            <ul class="breadcrumb">
                                <!-- <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                                <li class="breadcrumb-item active">Departments</li> -->
                            </ul>
                        </div>
                    </div>
                </div>

                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <?php echo $ms; ?>
                        <div class="card card-table">
                            <div class="card-body">
                                <div class="page-header">
                                    <div class="row align-items-center">
                                        <div class="col">

                                            <h3 class="page-title">دورات الدبلوم </h3>
                                        </div>

                                        <div class="col-auto text-end float-end ms-auto download-grp">
                                            <!-- <a href="#" class="btn btn-outline-primary me-2"><i
                                                    class="fas fa-download"></i> </a> -->
                                            <a href="add-department.php" class="btn btn-primary"><i
                                                    class="fas fa-plus"></i> إضافة دبلوم</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="container">
                                    <!-- <h5 >قسم الدملومات</h5> -->
                                    <h5 >إجمالي الدبلوم(<?php echo $result->num_rows; ?>)</h5>

                                    <hr class="display-3">
                                    <div action="" method="post"class="mt-3">
                                        <table class="table table-striped">
                                            <tr>
                                                <th><h4>الرقم</h4></th>
                                                <th><h4>رقم الدورة</h4></th>
                                                <th><h4>اسم الدورة</h4></th>
                                                <th colspan='2' ><h4>الـعـملـيـة</h4></th>
                                            </tr>
                                            <?php  foreach( $result->fetch_all() as $fetc ){
                                              
                                                ?>
                                                 <tr>
                                                    <?php
                                                 $count=1;
                                                ?>
                                                    <td><h5><?=$count?></h5></td>
                                                     <td><h5><?=$fetc[0]?></h5></td>
                                                     <td><h5><?=$fetc[1]?></h5></td>
                                                     <?php
                                                $count++;
                                                ?>
                                                    <td>
                                                        <form action="" method="post">

                                                            <a class="btn btn-primary" href="edit-department.php?id=<?=$fetc[0]?>">تعديل</a>
                                                            <button type="submit" value="<?=$fetc[0]?>" name="delete" onclick="let mes=confirm('هل أنت متأكد من الحدف!!')" class="btn btn-danger">حذف</button>
                                                 
                                                        </form>
                                                    </td>
                                                </tr>
                                                <?php

                                              
                                            }
                                            }
                                            ?>
                                        </table>
                         </div>
                                </div>
                 </div>




        </div>

    </div>


    <script src="assets/js/jquery-3.6.0.min.js"></script>

    <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="assets/js/feather.min.js"></script>

    <script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <script src="assets/plugins/datatables/datatables.min.js"></script>

    <script src="assets/js/script.js"></script>
</body>
                        <footer>
                            <p>Copyright © 2024 Alnajah Institute.</p>
                        </footer>
</html>