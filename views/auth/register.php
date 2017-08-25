<?php

if (isset($_POST['email'])) {

    if ($_POST['password'] != $_POST['confirm_password']) {
        echo "<script>alert('กรุณายืนยันรหัสผ่านให้ถูกต้อง')</script>";
        header('refresh:0; ?page=register');
    }

    // กันการ Injection (Hackเว็ป)
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $password = password_hash(mysqli_real_escape_string($conn, $_POST['password']), PASSWORD_DEFAULT);
    $avatar = "storage/auth/avatar.png";

    // ค้นหาในฐานข้อมูลว่ามีซ้ำไหม
    $query = mysqli_query($conn, "select * from users where email = '$email'");
    if (mysqli_fetch_assoc($query)) {
        echo "<script>alert('ไม่สามารถใช้อีเมลล์นี้ได้')</script>";
        header('refresh:0; ?page=register');


    // ถ้าไม่ซ้ำให้ insert เข้า table users
    } else {
        mysqli_query($conn, "insert into users (email, name, password, avatar) values ('$email', '$name', '$password', '$avatar')") or die(mysqli_error($conn));
        echo "<script>alert('สมัครสมาชิกเสร็จสิ้น')</script>";
        header('refresh:0; ?page=login');
    }

}
?>
<div class="layout" style="padding: 0 30% 0 30%;">
    <div class="layout-box">
        <div class="layout-highlight">
            <a href="?">Blog <i class="fa fa-rocket" aria-hidden="true"></i> Space</a>
        </div>
    </div>
    <div class="layout-box">
        <form method="post" action="">
            <div class="layout-header">
                Sign Up
            </div>
            <div class="layout-content">
                <input type="email" name="email" required placeholder="Your Email"/><br />
                <input type="text" name="name" required placeholder="Your Name"/><br />
                <hr />
                <input type="password" name="password" required placeholder="Your Password"/><br />
                <input type="password" name="confirm_password" required placeholder="Confirm Password"/>
            </div>
            <div class="layout-footer">
                <input type="submit" value="Sign Up"/>
            </div>
        </form>
    </div>
</div>
