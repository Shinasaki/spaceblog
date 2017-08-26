<?php
    # เช็คว่ามีไฟล์ upload ขึ้นมาหรือไม่
    if(isset($_FILES['avatar']['tmp_name'])) {
        # เช็คว่าไฟล์นั้นเป็นภาพหรือใหม่จากการเช็คขนาดภาพ
        if(getimagesize($_FILES['avatar']['tmp_name'])) {

            # สร้างชื่อไฟล์ใหม่และรวมกับ directory
            $avatar_name = $_FILES['avatar']['name'];
            $avatar_name = substr($avatar_name, strrpos($avatar_name, '.')+1);
            $avatar_name = $_SESSION['id'] . "." .$avatar_name;
            $avatar_dir = "storage/auth/" . $avatar_name;

            # ย้ายไฟล์ภาพที่อัพโหลดมาไปจัดเก็บ
            if (move_uploaded_file($_FILES['avatar']['tmp_name'], $avatar_dir)) {

                # อัพเดทที่อยู่ภาพในฐานข้อมูล
                mysqli_query($conn, "update users set avatar = '$avatar_dir' where id = '$_SESSION[id]'");


                # อัพเดทที่อยู่ภาพใน session
                $_SESSION['avatar'] = $avatar_dir;

                header('refresh:0; ?page=editavatar');
            } else {
                echo "<script>alert('ผิดพลาดกรุณาลองภาพอื่น')</script>";
                header('refresh:0; ?page=editavatar');
            }
        } else {
            echo "<script>alert('กรุณาเลือกภาพ')</script>";
            header('refresh:0; ?page=editavatar');
        }
    }
 ?>

<div class="layout" style="padding: 0 30% 0 30%;">
    <div class="layout-box">
        <div class="layout-highlight">
            <img src="<?php echo $_SESSION['avatar'] ?>" />
        </div>
    </div>
    <div class="layout-box">
        <form method="post" action="" enctype="multipart/form-data">
            <div class="layout-header">
                Edit Avatar
            </div>
            <div class="layout-content">
                <input type="file" name="avatar" required/>
            </div>
            <div class="layout-footer">
                <input type="submit" value="Edit"/>
            </div>
        </form>
    </div>
</div>
