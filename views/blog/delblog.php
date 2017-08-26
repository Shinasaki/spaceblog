




<?php
$delid = mysqli_real_escape_string($conn, $_GET['del']);

# ดึงข้อมูลจากฐานข้อมูลโดย id = $editid และ own = $_SESSION[id]
$query = mysqli_query($conn, "select * from blog where id = '$delid' and own = '$_SESSION[id]'");

# ถ้าเกิดว่าไม่เจอแสดงว่าไม่ใช่ blog ของเราให้เปลี่ยนหน้าไป 404
if (!$result = mysqli_fetch_assoc($query)) {
    header('location:?page=404');
}




# เมื่อมีค่าจากฟอร์มส่งมาก
if (isset($_POST['confirmpassword'])) {

    $confirmpass = mysqli_real_escape_string($conn, $_POST['confirmpassword']);

    $query = mysqli_query($conn, "select password from users where id = '$_SESSION[id]'");
    if($password = mysqli_fetch_assoc($query)) {
        # ถ้ารหัสผ่านถูก
        if (password_verify($confirmpass, $password['password'])) {
            mysqli_query($conn, "delete from blog where id = '$delid'");
            header('location:?page=myblog');
        } else {
            echo "<script>alert('รหัสผ่านไม่ถูกต้อง')</script>";
            echo "<script>window.history.back()</script>";
        }

    }
}
?>


<div class="layout" style="padding: 0 20% 0 20%;">
    <div class="layout-box">
        <div class="layout-highlight">
            Del <img src="<?php echo $result['image'] ?>"> Blog
        </div>
    </div>
    <div class="layout-box">
        <form method="post" action="" enctype="multipart/form-data">
            <div class="layout-header">
                Delete Blog
            </div>
            <div class="layout-content">
                <input type="password" name='confirmpassword' required placeholder="Confirm Password" style="width: 80%"/>
            </div>
            <div class="layout-footer">
                <input type="submit" value="Write!"/>
            </div>
        </form>
    </div>
</div>
