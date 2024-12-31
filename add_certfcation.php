<?php
session_start();
include "DB.php";
if(!isset($_SESSION['user'])){
    header('Location: login.php');
}
$db=new DB();
$masseg='<div class="alert alert-danger alert-dismissible text-right" sytle="direction: rtlimportan;">
  <strong>المعذرة!</strong> لم يتم تحديد طالب
  <button type="button" class="close text-right" data-dismiss="alert">&times;</button>
</div>';

$showform=0;
$lastNO =$db->getLstcertfactNO();
if (isset($_GET['id'])) {
    $id=$_GET['id'];

    
$arr=$db->getINFO("register_in",(int)$id);
$studentId=$arr['stud_id'];
$courseId=$arr['cour_id'];
//echo $studentId."<br>".$courseId;
$ispay=$arr['ispay'];
$isConfirm=$arr['isConfirm'];
$isComlpted=$arr['isComlpted'];
$masseg='';
$showform=1;

if ($ispay&$isConfirm&$isComlpted) {
    $arrstudInfo=$db->getINFO('student',$studentId);
    $arrcoursInfo=$db->getINFO('course',$courseId);
    echo "$arrstudInfo[3]";

}else{
    $showform=1;
    $masseg='<div class="alert alert-danger alert-dismissible text-right" sytle="direction: rtlimportan;">
  <strong>المعذرة!</strong> هذا الطالب لم يكمل متطلبات الشهادة 
  <button type="button" class="close text-right" data-dismiss="alert">&times;</button>
</div>';

}
}elseif(isset($_GET['diplom'])){
    $showform=1;
     $masseg='';

   $arrstudInfo =$db->getstudentinfo($_GET['studentName']);
     
     $arrcoursInfo=$db->getdiblomainfo($_GET['diplom']);
     $arrcoursInfo[]='';
     var_dump( $arrcoursInfo);
     $arr=['grad' =>'','',''];
    

}

if(isset($_POST['studname'])){
    //echo "hi";
    $studid=  $arrstudInfo[0];
$studname= $_POST['studname'];
$studnameEN= $_POST['studnameEN'];
$addrass=$_POST['addrass'];
$addrassEN=$_POST['addrassEN'];
$cetnum=$_POST['cetnum'];
$dob=$_POST['dob'];
$dostart=$_POST['dostart'];
$doend=$_POST['doend'];
$hour=$_POST['hour'];
$gradbersnt=$_POST['gradbersnt'];
$grad=$_POST['grad'];
$gradEN=$_POST['gradEN'];
$course=$_POST['course'];
$courseEN=$_POST['courseEN'];
$ntionEN=$_POST['ntionEN'];
$ntion=$_POST['ntion'];

header("location:Preview.php?studid=$studid&studname=$studname&studnameEN=$studnameEN&addrass=$addrass&addrassEN=$addrassEN&ntion=$ntion&course=$course&grad=$grad&gradEN=$gradEN&cetnum=$cetnum&dob=$dob&dostart=$dostart&doend=$doend&hour=$hour&gradbersnt=$gradbersnt&ntionEN=$ntionEN&courseEN=$courseEN&id=$id&submit=genrat");
//http://localhost/backend/certificate/test.php?studname=%D9%87%D8%B4%D8%A7%D9%85+%D8%A8%D9%86+%D8%B9%D8%B7%D9%8A%D9%87&addrass=%D8%A7%D9%84%D9%85%D9%83%D9%84%D8%A7-%D8%A7%D9%84%D8%B4%D8%AD%D8%B1&ntion=%D8%B3%D8%B9%D9%88%D8%AF%D9%8A&course=.net+devloper&grad=%D9%85%D9%85%D8%AA%D8%A7%D8%B2&cetnum=P1-55245&dob=1979-05-10&dostart=2023-02-02&doend=0024-02-02&hour=300&gradbersnt=100&submit=genrat#
}
function getgraduat($grad){
    if($grad<=100 &$grad>90){
        return ["ممتاز","Execlent"];
    }elseif($grad<=90 &$grad>75){
        return ["جيد حدا","very good"];
    }elseif($grad<=75 &$grad>50){
        return ["جيد","good"];
    }elseif($grad<=50&$grad>0){
        return ["مقبول","weak"];
    }else{
        return ["",""];
    }
     }
    
  
include "header.php";
//include "sidebar.php";
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
                            <h3 class="page-title">الشهادات</i></h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="certfcation.php">الشهادات</a></li>
                                <li class="breadcrumb-item active">توليد شهادة</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <?php
echo $masseg;

if ($showform) {
                                ?>
                                <form method="post">
                                    <div class="row">
                                        <div class="col-12">
                                            <h5 class="form-title"><span>التفاصيل</span></h5>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                            
                                            <div class="form-group local-forms ">
                                                <label>رقم الشهادة <span class="login-danger">*</span></label>
                                                <input class="form-control" required name="cetnum" type="text"
                                                    placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                            <div class="form-group local-forms ">
                                                <label>رقم اخر الشهادة <span class="login-danger">*</span></label>
                                                <input class="form-control" required value="<?=$lastNO?>" type="text"
                                                    placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <h5 class="form-title"><span>معلومات الطالب</span></h5>
                                        </div>
                                        <?php
                                       
                                            # code...
                                        
                                        ?>
                                        <div class="col-12 col-sm-4">
                                            <div class="form-group local-forms">
                                                <label>اسم الطالب العربي <span class="login-danger">*</span></label>
                                                <input type="text" class="form-control" required value="<?=$arrstudInfo[1]?>" name="studname">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                            <div class="form-group local-forms">
                                                <label>اسم الطالب بالانجليزي <span class="login-danger">*</span></label>
                                                <input type="text" class="form-control" required value="<?=$arrstudInfo[2]?>" name="studnameEN">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                            <div class="form-group local-forms">
                                               
                                                <label>الجنس <span class="login-danger">*</span></label>
                                                <select class="form-control select" value="<?=$arrstudInfo[3]?>">
                                                <?php
                                                if($arrstudInfo[3]=='F'){?>
                                                    <option >M</option>
                                                    <option selected>F</option>
                                                <?php }else{ ?>
                                                    <option selected>M</option>
                                                    <option>F</option>
                                               <?php }

                                                ?>
                                                 
                                                </select>
                                            </div>
                                        </div>
                                         <div class="col-12 col-sm-4">
                                            <div class="form-group local-forms">
                                                <label>تاريخ الميلاد <span class="login-danger">*</span></label>
                                                <input class="form-control" required type="date" value="<?=$arrstudInfo[5]?>" name="dob">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                            <div class="form-group local-forms">
                                                <label>الحنسية بالعربي <span class="login-danger">*</span></label>
                                                <input type="text" class="form-control" required value="<?=$arrstudInfo[4]?>" name="ntion">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                            <div class="form-group local-forms">
                                                <label>الحنسية بالانجليزي <span class="login-danger">*</span></label>
                                                <input type="text" class="form-control" required name="ntionEN">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                            <div class="form-group local-forms">
                                                <label>العنوان <span class="login-danger">*</span></label>
                                                <input class="form-control " name="addrass" value="<?=$arrstudInfo[7]?>" type="text"
                                                    placeholder="جضرموت-القطن">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                            <div class="form-group local-forms">
                                                <label>العنوان بالانجليزي <span class="login-danger">*</span></label>
                                                <input type="text" class="form-control" required name="addrassEN">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <h5 class="form-title"><span>معلومات الدورة</span></h5>
                                        </div>
                                       
                                        <div class="col-12 col-sm-4 ">
                                            <div class="form-group local-forms">
                                                <label>اسم الدورة بالعربي <span class="login-danger">*</span></label>
                                                <input type="text" class="form-control" required value="<?=$arrcoursInfo[1]?>" name="course">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                            <div class="form-group local-forms">
                                                <label>اسم الدورة بالانجليزي <span class="login-danger">*</span></label>
                                                <input type="text" class="form-control" required value="<?=$arrcoursInfo[2]?>" name="courseEN">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                            <div class="form-group local-forms">
                                                <label>تاريخ يداية الدورة <span class="login-danger">*</span></label>
                                                <input class="form-control" required value="<?=$arrcoursInfo[8]?>" type="date" name="dostart">
                                            </div>
                                        </div>
                                       
                                        <div class="col-12 col-sm-4">
                                            <div class="form-group local-forms">
                                                <label>تاريخ نهاية الدورة <span class="login-danger">*</span></label>
                                                <input type="date" class="form-control" value="<?=$arrcoursInfo[9]?>" required name="doend">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                            <div class="form-group local-forms">
                                                <label>عدد ساعات الدورة<span class="login-danger">*</span></label>
                                                <input type="number" class="form-control" value="<?=$arrcoursInfo[7]?>" required name="hour">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                            <div class="form-group local-forms">
                                                <label>النسبة <span class="login-danger">*</span></label>
                                                <input type="number" class="form-control" value="<?=$arr['grad']?>" required name="gradbersnt">
                                            </div>
                                        </div>
                                        <?php
                                            $arrgrad=getgraduat($arr['grad']);
                                        ?>
                                        <div class="col-12 col-sm-4">
                                            <div class="form-group local-forms">
                                                <label>التقدير بالعربي<span class="login-danger">*</span></label>
                                                <input type="text" class="form-control" required value="<?=$arrgrad[0]?>" name="grad">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                            <div class="form-group local-forms">
                                                <label>التقدير بالانجليزي<span class="login-danger">*</span></label>
                                                <input type="text" class="form-control" required  value="<?=$arrgrad[1]?>" name="gradEN">
                                            </div>
                                        </div>
                                       
                                      
                                       
                                      
                                        <div class="col-12">
                                            <div class="student-submit">
                                                <button type="submit" name="submit"class="btn btn-primary">معاينة الشهادة</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <?php }?>
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

    <script src="assets/plugins/moment/moment.min.js"></script>
    <script src="assets/js/bootstrap-datetimepicker.min.js"></script>

    <script src="assets/plugins/select2/js/select2.min.js"></script>

    <script src="assets/js/script.js"></script>
</body>

</html>