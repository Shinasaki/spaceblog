<!DOCTYPE html>
<html>
    <head>


        <!-- ดึงไฟล์ -->
        <?php require_once 'autoload/init.php' ?>


        <meta charset="utf-8">


        <!-- ชื่อเว็ปแก้ไขได้ใน config/baseName.php -->
        <title><?php echo baseName; ?></title>
    </head>
    <body>
        <!-- ดึงส่วน Header -->
        <?php require_once 'views/layout/header.php' ?>

        <!-- ดึงส่วน Content -->
        <?php require_once 'autoload/route.php' ?>

        <!-- ดึงส่วน Footer -->
        <?php require_once 'views/layout/footer.php' ?>
    </body>
</html>
