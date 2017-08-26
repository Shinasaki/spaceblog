<?php
    # ถ้าไม่เจอ $_GET['read'] หรือ $_GET['read'] ค่าว่างปล่าว
    if (!isset($_GET['read']) || empty($_GET['read'])) {
        header('location:?page=404');
        exit();
    }

    # กัน injection
    $readid = mysqli_real_escape_string($conn, $_GET['read']);

    # ดึงข้อมูลจากฐานข้อมูล
    $query = mysqli_query($conn, "select * from blog where id = '$readid'");
    $blog = mysqli_fetch_assoc($query);
?>

<div class="layout">
    <div class="layout-box">
        <div class="layout-highlight">
                <?php echo $blog['topic'] ?>
        </div>
    </div>

    <div class="layout-box">
        <div class="layout-header">
            <?php echo $blog['topic'] ?>
        </div>
        <div class="layout-content" style="padding: 30px; text-align:left; background: #f2f2f2; color: #1e1e1e">
            <img src="<?php echo $blog['image'] ?>" style="border-radius: 10px;"/> <br />
            <div style='text-align:left;'>
                    <?php echo $blog['content'] ?>
            </div>
        </div>
        <div class="layout-footer">
            Date: <?php echo $blog['date'] ?>
        </div>
    </div>
</div>
