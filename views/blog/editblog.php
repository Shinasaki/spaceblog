<?php
# กันการ injection (hack)
$editid = mysqli_real_escape_string($conn, $_GET['edit']);

# เมื่อมีการส่งค่าผ่านฟอร์มมาให้
if (isset($_POST['topic'])) {

        # กันการ injection
        $edit =
        $topic = mysqli_real_escape_string($conn, $_POST['topic']);
        $content = mysqli_real_escape_string($conn, $_POST['content']);
        $catalog = mysqli_real_escape_string($conn, $_POST['catalog']);
        $confirmpass = mysqli_real_escape_string($conn, $_POST['confirmpassword']);

        $query = mysqli_query($conn, "select password from users where id = '$_SESSION[id]'") or die(mysqli_error($conn));
        $password = mysqli_fetch_assoc($query);


        # ถ้า password ตรงกับ password ที่เข้ารหัสในฐานข้อมูลให้
        if (password_verify($confirmpass, $password['password'])) {
            # เช็คว่ามีไฟล์ upload ขึ้นมาหรือไม่
            if(isset($_FILES['blogimg']['tmp_name']) && !empty($_FILES['blogimg']['name'])) {
                # เช็คว่าไฟล์นั้นเป็นภาพหรือใหม่จากการเช็คขนาดภาพ
                if(getimagesize($_FILES['blogimg']['tmp_name'])) {
                    # สร้างชื่อไฟล์ใหม่และรวมกับ directory
                    $blogimg_name = $_FILES['blogimg']['name'];
                    $blogimg_name = substr($blogimg_name, strrpos($blogimg_name, '.')+1);
                    $blogimg_name = date('Y-m-d-s') . "." .$blogimg_name;
                    $blogimg_dir = "storage/blog/" . $blogimg_name;
                    if (!move_uploaded_file($_FILES['blogimg']['tmp_name'], $blogimg_dir)) {
                        echo "<script>alert('ผิดพลาดกรุณาลองภาพอื่น')</script>";
                        echo "<script>window.history.back()</script>";
                    }
                }
            # ถ้าไม่มีภาพที่อัพโหลดมาให้ใช้ข้อมูลจากในฐานข้อมูลมา
            } else {
                $query = mysqli_query($conn," select image from blog where id = '$editid'");
                $blogimg_dir = mysqli_fetch_assoc($query);
                $blogimg_dir = $blogimg_dir['image'];
            }

            # อัพเดทที่อยู่ภาพในฐานข้อมูล
            mysqli_query($conn, "
            update blog set
            topic = '$topic',
            content = '$content',
            catalog = '$catalog',
            own = '$_SESSION[id]',
            image = '$blogimg_dir'
            where id = '$editid'
            ") or die(mysqli_error($conn));

            echo "<script>alert('แก้ไขเสร็จสิ้น')</script>";
            header('refresh:0; ?page=myblog');
        } else {
            echo "<script>alert('รหัสผ่านไม่ถูกต้อง')</script>";
            echo "<script>window.history.back()</script>";
        }


}






# ดึงข้อมูลจากฐานข้อมูลโดย id = $editid และ own = $_SESSION[id]
$query = mysqli_query($conn, "select * from blog where id = '$editid' and own = '$_SESSION[id]'");

# ถ้าเกิดว่าไม่เจอแสดงว่าไม่ใช่ blog ของเราให้เปลี่ยนหน้าไป 404
if (!$result = mysqli_fetch_assoc($query)) {
    header('location:?page=404');
}
?>


<div class="layout" style="padding: 0 20% 0 20%;">
    <div class="layout-box">
        <div class="layout-highlight">
            Edit <img src="<?php echo $result['image'] ?>"> Blog
        </div>
    </div>
    <div class="layout-box">
        <form method="post" action="" enctype="multipart/form-data">
            <div class="layout-header">
                Edit Blog
            </div>
            <div class="layout-content">
                <input type="text" name="topic" required placeholder="Topic" style="width: 80%;" value="<?php echo $result['topic'] ?>"/>
                <textarea name="content" style="width: 80%;" required placeholder="Your Content..."><?php echo $result['content'] ?></textarea><br />

                Catalog :
                <select name="catalog">
                    <?php
                        $query = mysqli_query($conn, "select * from catalog");
                        while($catalog = mysqli_fetch_assoc($query)) {
                            ?>
                                <option value="<?php echo $catalog['catalog'] ?>"
                                    <?php if ($catalog['catalog'] == $result['catalog']) : ?>
                                        selected
                                    <?php else : ?>
                                    <?php endif; ?>
                                    >
                                    <?php echo $catalog['catalog'] ?>
                                </option>
                            <?php
                        }
                    ?>
                </select>
                <input type="file" name="blogimg" class="upload"/>
                <hr />
                <input type="password" name='confirmpassword' required placeholder="Confirm Password" style="width: 80%"/>
            </div>
            <div class="layout-footer">
                <input type="submit" value="Write!"/>
            </div>
        </form>
    </div>
</div>
