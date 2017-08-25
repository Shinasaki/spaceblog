<?php
# เช็คว่ามีไฟล์ upload ขึ้นมาหรือไม่
if(isset($_FILES['blogimg']['tmp_name'])) {
    # เช็คว่าไฟล์นั้นเป็นภาพหรือใหม่จากการเช็คขนาดภาพ
    if(getimagesize($_FILES['blogimg']['tmp_name'])) {

        # สร้างชื่อไฟล์ใหม่และรวมกับ directory
        $blogimg_name = $_FILES['blogimg']['name'];
        $blogimg_name = substr($blogimg_name, strrpos($blogimg_name, '.')+1);
        $blogimg_name = date('Y-m-d-s') . "." .$blogimg_name;
        $blogimg_dir = "storage/blog/" . $blogimg_name;

        if (move_uploaded_file($_FILES['blogimg']['tmp_name'], $blogimg_dir)) {

            # กันการ injection
            $topic = mysqli_real_escape_string($conn, $_POST['topic']);
            $content = mysqli_real_escape_string($conn, $_POST['content']);
            $catalog = mysqli_real_escape_string($conn, $_POST['catalog']);

            # อัพเดทที่อยู่ภาพในฐานข้อมูล
            mysqli_query($conn, "
            insert into blog
            (topic, content, catalog, own, image) values
            ('$topic', '$content', '$catalog', '$_SESSION[id]', '$blogimg_dir')
            ")or die(mysqli_error($conn));

            //header('refresh:0; ?page=myblog');
        } else {
            echo "<script>alert('ผิดพลาดกรุณาลองภาพอื่น')</script>";
            header('refresh:0; ?page=editavatar');
        }
    }
}

?>


<div class="layout" style="padding: 0 20% 0 20%;">
    <div class="layout-box">
        <div class="layout-highlight">
            Write Blog <i class="fa fa-pencil" aria-hidden="true"></i>
        </div>
    </div>
    <div class="layout-box">
        <form method="post" action="" enctype="multipart/form-data">
            <div class="layout-header">
                Write Blog
            </div>
            <div class="layout-content">
                <input type="text" name="topic" required placeholder="Topic" style="width: 80%;"/>
                <textarea name="content" style="width: 80%;" required placeholder="Your Content..."></textarea><br />

                Catalog :
                <select name="catalog">
                    <?php
                        $query = mysqli_query($conn, "select * from catalog");
                        while($result = mysqli_fetch_assoc($query)) {
                            echo "<option value='$result[catalog]'>$result[catalog]</option>";
                        }
                    ?>
                </select>
                <input type="file" name="blogimg" required class="upload"/>
            </div>
            <div class="layout-footer">
                <input type="submit" value="Write!"/>
            </div>
        </form>
    </div>
</div>
