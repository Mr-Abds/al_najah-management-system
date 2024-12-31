<?php
session_start();
if(!isset($_SESSION['user'])){
    header('Location: login.php');
}
include "header.php";



$localhost='localhost';
$username='root';
$password='';
$dbname='alnajah';
$coon = new mysqli($localhost,$username,$password,$dbname);
try{

    if(isset($_POST['added'])) {
        $cour_id = $_POST['cour_id'];
        $name = $_POST['cour_name'];
        $discreption = $_POST['description'];
        $period= $_POST['period'];
        $batch= $_POST['batch'];
        $teatcherID = $_POST['teach_id'];
        $hours = $_POST['hours'];
        $startDate=$_POST['startDate'];
        $endDate=$_POST['endDate'];
        $cost = $_POST['cost'];
        $diplom_id = $_POST['diplom_id'];
      //  $studet_limit=$_POST['studet_limit'];
        $sql = "INSERT INTO course(cour_name,description,period,batch,teach_id,hours,startDate,endDate,cost,diplom_id) VALUES 
            ('$name','$discreption','$period','$batch','$teatcherID','$hours','$startDate','$endDate','$cost','$diplom_id')";
        $coon = new mysqli($localhost, $username, $password, $dbname);
        if($result = $coon->query(query: $sql)){
            header("Location: courses.php");
        }
    }
    if($result===true) {
        echo '<div class="alert alert-success" role="alert">
     تمت العملية بنجاح

     </div>';
    }
}catch(Exception $ex){
    echo'<div class="alert alert-danger" role="alert">
       هنالك خطاء موجود في العملية
     </div>'.$ex->getMessage();
}
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

                <li class="submenu active">
                    <a href="#"><i class="fas fa-book-reader"></i> <span class="me-4"> الدورات</span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="courses.php">قائمة الدورات</a></li>
                        <li><a href="add-course.php" class="active">اضافة دورة</a></li>
                        <li><a href="#">تعديل دورة</a></li>
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
                            <h3 class="page-title">إضافة دورة</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="subjects.html">دورة</a></li>
                                <li class="breadcrumb-item active">إضافة دورة</li>
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
                                            <h5 class="form-title"><span>معلومات الدورة</span></h5>
                                        </div>



                                            <div class="col-12 col-sm-4">
                                            <div class="form-group local-forms">
                                                <label>اسم الدورة <span class="login-danger">*</span></label>
                                                <input type="text" name="cour_name" required class="form-control">
                                            </div>
                                        </div>



                                        <div class="col-12 col-sm-4">
                                            <div class="form-group local-forms">
                                                <label>الفترة<span class="login-danger">*</span></label>
<!--                                                <input type="text" name="period" class="form-control">-->
                                                <select id="period" name="period" required class="form-control">
                                                    <option value="1">صباحا</option>
                                                    <option value="0">مساء</option>
                                                    <?php
//                                                    if($period=="صباحا"){
//                                                        $period=1;
//                                                    }
//                                                    elseif ($period=="مساء"){
//                                                        $period=0;
//                                                    }
                                                ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-4">
                                            <div class="form-group local-forms">
                                                <label>الدفعة<span class="login-danger">*</span></label>
                                                <input type="number" required name="batch" class="form-control">

                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-4">
                                            <div class="form-group local-forms">
                                                <?php
                                                $sql = "SELECT teach_id ,name FROM teacher";
                                                $sqlResult = $coon->query($sql);
                                                ?>
                                        
                                                <?php ?>
                                                <label for="list">رقم المدرس<span class="login-danger">*</span></label>
                                                <input list="teacher" name="teach_id" class="form-control" required>
                                                <datalist id="teacher">
                                                    <?php while($row = $sqlResult->fetch_assoc()){
                                                        $dId = $row['teach_id'];
                                                        ?>
                                                        <option name="teach_id" value="<?=$dId?>"> <?=$row['name']?> </option>
                                                    <?php } ?>

                                                </datalist>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-4">
                                            <div class="form-group local-forms">
                                                <label>عدد الساعات <span class="login-danger">*</span></label>
                                                <input type="text" name="hours" required class="form-control">
                                            </div>
                                        </div>


                                        <div class="col-12 col-sm-4">
                                            <div class="form-group local-forms">
                                                <label>تاريخ البداية<span class="login-danger">*</span></label>
                                                <input type="date" name="startDate" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-4">
                                            <div class="form-group local-forms">
                                                <label>تاريخ النهاية<span class="login-danger">*</span></label>
                                                <input type="date" name="endDate" class="form-control">
                                            </div>
                                        </div>


                                        <div class="col-12 col-sm-4">
                                            <div class="form-group local-forms">
                                                <label>السعر <span class="login-danger">*</span></label>
                                                <input type="number" name="cost" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-4">
                                            <div class="form-group local-forms">
                                                <?php
                                                $sql = "SELECT dip_id ,name FROM diplome";
                                                $sqlResult = $coon->query($sql);
                                                ?>
                                                <script>console.log('<?=$sql?>')</script>
                                                <?php ?>
                                                <label for="list">رقم الدبلوم الخاص بهذه الدورة<span class="login-danger">*</span></label>
                                                <input list="deplome" name="diplom_id" class="form-control">
                                                <datalist id="deplome">
                                                    <?php while($row = $sqlResult->fetch_assoc()){
                                                        $dId = $row['dip_id'];

                                                        ?>
                                                        <option name="diplom_id" value="<?=$dId?>"> <?=$row['name']?> </option>
                                                    <?php } ?>

                                                </datalist>
                                            </div>
                                        </div>


                                        <div class="col-12 col-sm-4">
                                            <div class="form-group local-forms">
                                                <label>الوصف<span class="login-danger">*</span></label>
                                                <textarea type="text" name="description" class="form-control"></textarea>
                                            </div>
                                        </div>
<!--                                        <div class="col-12 col-sm-4">-->
<!--                                            <div class="form-group local-forms">-->
<!--                                                <label>student limit<span class="login-danger">*</span></label>-->
<!--                                                <input type="text" name="studet_limit" class="form-control">-->
<!--                                            </div>-->
<!--                                        </div>-->

                                        <div class="col-12">
                                            <div class="student-submit">
                                                <button type="submit" name="added" class="btn btn-primary">إضافة</button>
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
</body>

</html>