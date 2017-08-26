<!DOCTYPE html>
<html>
    <head>


        <!-- ดึงไฟล์ภายนอก -->
        <link href="https://fonts.googleapis.com/css?family=Itim" rel="stylesheet">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
        <link href="favicon.ico" rel="icon" />


        <!-- ดึงไฟล์ภายใน -->
        <?php require_once 'autoload/init.php' ?>

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="utf-8">


        <!-- ชื่อเว็ปแก้ไขได้ใน config/baseName.php -->
        <title><?php echo baseName; ?></title>


    </head>
    <body>


        <!-- ดึงส่วน Header -->
        <?php require_once 'views/layout/header.php' ?>


        <!-- ดึงส่วน Content -->
        <div class="content">
        <?php require_once 'autoload/route.php' ?>
        </div>


        <!-- ดึงส่วน Footer -->
        <?php require_once 'views/layout/footer.php' ?>


    </body>
</html>
