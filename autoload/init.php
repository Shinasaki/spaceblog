<?php
/**
 * init.php
 *
 * ลิ้งและดึงส่วนจำเป็นต่างๆมาปรับกอบกัน
 */

require_once 'autoload/database.php';

# ดึงไฟล์ทุกไฟล์ใน Folder config
foreach (glob('config/*.php') as $phpname) {
    require_once $phpname;
}

# ดึงไฟล์ css และ js ใน Folder public
foreach (glob('public/css/*.css') as $cssname) {
    echo "<link rel='stylesheet' href='$cssname'/>";
}
foreach (glob('public/js/*.js') as $jsname) {
    echo "<script src='$jsname'></script>";
}
