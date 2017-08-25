<?php
    # เมื่อมีการส่งผ่านฟอร์มมา
    if (isset($_POST['email'])) {
        # กันการ injdection (hack)
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);


        # ดึง password hash(เข้ารหัส) จากฐานข้อมูล
        $query = mysqli_query($conn, "select password from users where id = '$_SESSION[id]'");
        $result = mysqli_fetch_assoc($query);

        # เช็ค password
        if (password_verify($password, $result['password'])) {
            # อัพเดทข้อมูลในฐานข้อมูล
            mysqli_query($conn, "update users set email = '$email', name = '$name' where id = '$_SESSION[id]'");

            # อัพเดทข้อมูลใน session
            $_SESSION['email'] = $email;
            $_SESSION['name'] = $name;

            header('refresh:0; ?page=profile');
        } else {
            echo "<script>alert('รหัสผ่านไม่ถูกต้อง')</script>";
            header('refresh:0; ?page=editprofile');
        }
    }
?>


<div class="layout" style="padding: 0 30% 0 30%;">
    <div class="layout-box">
        <div class="layout-highlight">
            Edit Profile
        </div>
    </div>
    <div class="layout-box">
        <form method="post" action="" enctype="multipart/form-data">
            <div class="layout-header">
                Edit Profile
            </div>
            <div class="layout-content">
                <input type="email" name="email" required placeholder="Your Email" value="<?php echo $_SESSION['email'] ?>"/><br />
                <input type="text" name="name" required placeholder="Your Name" value="<?php echo $_SESSION['name'] ?>"/>
                <hr />
                <input type="password" name="password" required placeholder="Confirm Password"/>
            </div>
            <div class="layout-footer">
                <input type="submit" value="Edit"/>
            </div>
        </form>
    </div>
</div>
