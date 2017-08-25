<?php
// ถ้าเกิด login แล้วให้เด้งไปหน้าอื่น
if (isset($_SESSION['id'])) {
    header('location:?page=404');
}

// ต้องเจอค่า POST['email']
if (isset($_POST['email'])) {

    // กันการ Injection (Hackเว็ป)
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // ค้นหาในฐานข้อมูล
    $query = mysqli_query($conn, "select password from users where email = '$email'");
    if ($auth = mysqli_fetch_assoc($query)) {

        if (password_verify($password, $auth['password'])) {

            $query = mysqli_query($conn, "select * from users where email = '$email'");
            $auth = mysqli_fetch_assoc($query);
            // นำค่าที่เจอนั้นใส่เข้าไปใน session
            $_SESSION['id'] = $auth['id'];
            $_SESSION['username'] = $auth['username'];
            $_SESSION['password'] = $auth['password'];
            $_SESSION['date'] = $auth['date'];

            echo "<script>alert('เข้าสู่ระบบ')</script>";
            header('refresh:0; ?page=myblog');
        } else {
            echo "<script>alert('อีเมลล์หรือรหัสผ่านไม่ถูกต้อง')</script>";
            header('refresh:0; ?page=login');
        }


    // ถ้าไม่เจอ
    } else {
        echo "<script>alert('ไม่พบชื่อผู้ใช้นี้ในระบบ')</script>";
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
                Sign
            </div>
            <div class="layout-content">
                <input type="email" name="email" required placeholder="Your Email"/>
                <input type="password" name="password" required placeholder="Your Password"/>
            </div>
            <div class="layout-footer">
                <input type="submit" value="Sign In"/>
            </div>
        </form>
    </div>
</div>
