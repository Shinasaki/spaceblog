<?php
    # เมื่อมีการคลิ๊กฟอร์มมา
    if (isset($_POST['old_pwd'])) {
        # กันการ injection (hack)
        $old_pwd = mysqli_real_escape_string($conn, $_POST['old_pwd']);
        $new_pwd = mysqli_real_escape_string($conn, $_POST['new_pwd']);

        # เช็ค password เก่าว่าถูกไหม
        $query = mysqli_query($conn, "select password from users where id = '$_SESSION[id]'") or die(mysqli_error($conn));
        $result = mysqli_fetch_assoc($query);

        # ถ้ารหัสผ่านเก้าถูก ให้อัพเดทรหัสผ่านใหม่ขึ้นฐานข้อมูล
        if (password_verify($old_pwd, $result['password'])) {
            $new_pwd = password_hash($new_pwd, PASSWORD_DEFAULT);
            mysqli_query($conn, "update users set password = '$new_pwd' where id = '$_SESSION[id]'") or die(mysqli_error($conn));
            echo "<script>alert('รหัสผ่านได้รับการอัพเดท')</script>";
            header('refresh:0; ?p=profile');
        } else {
            echo "<script>alert('รหัสผ่านเก่าไม่ถูกต้อง')</script>";
            header('refresh:0; ?p=changepassword');
        }
    }
?>

<div class="layout" style="padding: 0 30% 0 30%;">
    <div class="layout-box">
        <div class="layout-highlight">
            Change Password
        </div>
    </div>
    <div class="layout-box">
        <form method="post" action="" enctype="multipart/form-data">
            <div class="layout-header">
                Change Password
            </div>
            <div class="layout-content">
                <input type="password" name="old_pwd" required placeholder="Old Password"/><br />
                <input type="password" name="new_pwd" required placeholder="New Password"/><br />
            </div>
            <div class="layout-footer">
                <input type="submit" value="Change"/>
            </div>
        </form>
    </div>
</div>
