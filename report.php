<?php
// الاتصال بقاعدة البيانات
$servername = "localhost"; // أو عنوان السيرفر
$username = "username"; // اسم المستخدم
$password = "password"; // كلمة المرور
$dbname = "database_name"; // اسم قاعدة البيانات

$conn = new mysqli($servername, $username, $password, $dbname);

// التحقق من الاتصال
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// تعيين اسم الكورس والدبلوم
$cour_name = 'اسم الكورس المحدد';
$diplom_name = 'اسم الدبلوم المحدد';

// إعداد الاستعلام
$sql = "SELECT 
            s.std_id, 
            s.name AS student_name, 
            c.cour_name, 
            d.name AS diplom_name
        FROM 
            student s
        JOIN 
            register_in r ON s.std_id = r.stud_id
        JOIN 
            course c ON r.cour_id = c.batch
        JOIN 
            diplome d ON c.diplom_id = d.dip_id
        WHERE 
            c.cour_name = ? 
            AND d.name = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $cour_name, $diplom_name);
$stmt->execute();
$result = $stmt->get_result();

// عرض النتائج
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "Student ID: " . $row["std_id"] . " - Name: " . $row["student_name"] . "<br>";
    }
} else {
    echo "No results found.";
}

// إغلاق الاتصال
$stmt->close();
$conn->close();
?>