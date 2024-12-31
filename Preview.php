<?php

include "DB.php";
$tap='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
    $studname= $tap;
    $addrass=$tap;
    $cetnum=$tap;
    $dob=$tap;
    $dostart=$tap;
    $doend=$tap;
    $hour=$tap;
    $gradbersnt=$tap;
    $grad=$tap;
    $course=$tap;
    $ntion=$tap;
$db=new DB();
if(isset($_GET['delete'])){
    $db->dropcertfcat($_GET['delete']);
    header("location:certificted_student.php");
}
if(isset($_GET['studname'])){
    $studname= $_GET['studname'];
    $studnameEN= $_GET['studnameEN'];
    $addrass=$_GET['addrass'];
    $addrassEN=$_GET['addrassEN'];
    $cetnum=$_GET['cetnum'];
    $dob=$_GET['dob'];
    $dostart=$_GET['dostart'];
    $doend=$_GET['doend'];
    $hour=$_GET['hour'];
    $gradbersnt=$_GET['gradbersnt'];
    $grad=$_GET['grad'];
    $gradEN=$_GET['gradEN'];
    $course=$_GET['course'];
    $courseEN=$_GET['courseEN'];
    $ntionEN=$_GET['ntionEN'];
    $ntion=$_GET['ntion'];
    $id=$_GET['id'];
    $studid=$_GET['studid'];
$db->addcertifica($cetnum ,date('Y-m-d'),$id);
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="jspdf.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/2.3.4/jspdf.plugin.autotable.min.js"></script>
    <link href="bootstrap.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

    <style>
    .maindiv {


        width: 1000px;
        display: flex;
        height:720px;

    }

    #div1 {
        position: relative;
        width: 1000px;
        height: 720px;
        display: flex;
    }

    .text {
        position: relative;
        right: -70px;
        top: 300px;
        direction: rtl;

    }

    .text1 {
        position: relative;
        left: 70px;
        top: 300px;
        direction: ltr;

    }

    h5 {
        font-size: 1.2vw;
        margin-bottom: 10px;
    }

   

    #mainphoto {
        position: absolute;
        width: 1000px;
       
    }

    strong {
        font-size: 1.2vw;
    }

    #photo{
        margin: 0px;
      
        position: relative;
        left: -800px;
        top: 170px;
      

    }
    #porsonalphoto{
        width: 120px;
        height:120px;
        border-radius: 10%;
    }
    </style>
</head style="">

<body>

<div class="container justify-content-right">
   <button id="getPDF" class="btn btn-success " onclick="convertToImage()">استخراج</button>
        <a href="http://localhost/backend/html/add_certfcation.php" class="btn btn-warning" >العودة الى عرض الطلاب</a>
        <a href="http://localhost/backend/html/Preview.php?delete=<?=$cetnum?>" class="btn btn-danger" >التراجع</a>


</div>
   
    <div class="maindiv" id="pdfg"> <img id="mainphoto" src="cer2.jpg" alt="">
   
        <div id="div1">
            <div class="text1">
                <h5> The Success Institute certifies that :<strong><?=$studnameEN?><strong></h5>
                <h5> born in <?=$addrassEN?> on <?=$dob?>, <?=$ntionEN?> nationality</h5>
                <h5> successfully completed the requirements of the training course</h5>
                <h5>(<?=$course?>) for (<?=$hour?>) hours</h5>
                <h5> from <?=$dostart?>م to <?=$doend?>م</h5>
                <h5>He received a grade of (<?=$gradEN?>) with a percentage of (<?=$gradbersnt?>%)</h5>
                <h5>This certificate is recorded under number (<?=$cetnum?>)</h5>
                <p class="text-center " style="margin-right:110px;margin-bottom:0px">مرخص من ززارة التعليم الفني
                    والتدريب المهني <br />(185)  <span>برقم</span> </p>

                <p></p>
            </div>
            <div class="text">
                <h5> يشهد معهد النجاح بان الطالبـ/ـة <strong><?=$studname?></strong></h4>
                    <h5> المولود في <?=$addrass?> بتاريخ <?=$dob?>م  <?=$ntion?> جنسية  </h>
                        <h5> <strong>اكمل بنجـاح متطلبات الـدورة التدريبية </strong></h5>
                        <h5>)<?=$course?>( لمدة )<?=$hour?>( ساعة </h5>
                        <h5> في فترة من <?=$dostart?>م الـى <?=$doend?>م</h5>
                        <h5>وحصل على تقدير )<?=$grad?> ( بنسبة )%<?=$gradbersnt?>(</h5>
                        <h5>قد قيدت هذه الشهادة برقـم )<?=$cetnum?>(</h5>
                        <p class="text-center " style="margin-left:150px;margin-bottom:0px">مدير المعهد</p>
                        <p class="text-center " style="margin-left:150px">Institute dirctor</p>
            </div>
        </div>
        <div id="photo" >
        <img id="porsonalphoto" src="assets/img/<?=$studid?>.jpg">
        </div>
        
    </div>
   
 <input type="hidden" id="id" name="" value="<?=$id?>">
    <script>


function generatePDF() {
    function generatePDF() {
    // إنشاء ملف PDF جديد
    var doc = new jsPDF('l', 'mm', 'a4');

    // الحصول على عنصر div الذي يحتوي على الشهادة
   html2canvas(document.getElementById('pdf')).then(function(canvas) {
    var imgData = canvas.toDataURL('image/JPG');
    doc.addImage(imgData, 'JPG', 0, 0,);
});
    // حفظ الملف
    doc.save('الشهادة.pdf');
    
}}
function convertToImage() {
    var id = document.getElementById('id');
    var data ={'id' : id.value};
    //var doc = new jsPDF('l', 'mm', 'a4');
    html2canvas(document.getElementById('pdfg')).then(function(canvas) {
      var imgData = canvas.toDataURL('image/PNG');
      //doc.addImage(imgData, 'PNG', 0, 0,290,270);
      var link = document.createElement('a');
      link.download = '<?=$cetnum?>.png';
      link.href = imgData;
      link.click();   
     //doc.save('الشهادة.pdf');
     fetch("http://localhost/backend/html/Preview.php",{
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
     }
     )
                .then(response => response.text())
                .then(data => {
                  //  document.getElementById('messages').innerText = `الرسالة: `;
                    
                })
                .catch(error => {
                    console.error('Error:', error);
                });
     

    });
}
    </script>
</body>

</html>