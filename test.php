<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once 'vendor/autoload.php';

use PhpOffice\PhpWord\TemplateProcessor;
if (!class_exists('ZipArchive')) {
    die('ZipArchive is not enabled!');
}
// تحميل القالب
try {
    $templateProcessor = new TemplateProcessor('كشوفات البداية والنهاية الجديد.docx');
    $templateProcessor->setValue('diblomType', 'دبلوم اللغة الأنجليزية');
    $templateProcessor->setValue('courses', ' دورة  intro B  , دورة E1 ');
    $templateProcessor->setValue('startdate', '12/6/2024');
    $templateProcessor->setValue('enddate', '12/6/2025');
    $templateProcessor->setValue('hours', '400000');
    for ($i=0; $i < 10 ; $i++) { 
        $templateProcessor->setValue('stud_name'.$i, "الاسم:".$i);
        $templateProcessor->setValue('address_DOB', "العنوان");
    }
    $templateProcessor->saveAs('nnكشوفات البداية والنهاية الجديد المعدل.docx');

    header("Content-Disposition: attachment; filename=كشوفات البداية والنهاية الجديد المعدل.docx");
    header("Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document");
    readfile('كشوفات البداية والنهاية الجديد المعدل.docx');
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
?>