<?php
    # ถ้าเจอค่า edit และค่านั้นไม่ว่างปล่าวให้
    if (isset($_GET['edit']) && !empty($_GET['edit'])) {
        require_once ('views/blog/editblog.php');
    } elseif (isset($_GET['del']) && !empty($_GET['del'])) {
        require_once ('views/blog/delblog.php');
    } else {
?>


<div class="layout">
    <div class="layout-box">
        <div class="layout-highlight">
            <?php if(isset($_SESSION['id'])) : ?>
                <a href="?" class="main">
                    Blog
                    <a href="?page=profile" id="mainimg">
                        <img src="<?php echo $_SESSION['avatar'] ?>"/>
                    </a> Space
                </a>
            <?php else : ?>
                <a href="?">Blog <i class="fa fa-rocket" aria-hidden="true"></i> Space</a>
            <?php endif; ?>
        </div>
    </div>
    <div class="layout-box" style="margin-top: 60px; text-align: left;">
        <table class="myblog">


        <?php
            # นับจำนวนข้อมูลทั้งหมด
            $count = mysqli_query($conn, "select count(id) as total from blog where own = '$_SESSION[id]'");
            $count = mysqli_fetch_assoc($count);
            $count = $count['total'];

            # ดึงข้อมูลทั้งหมด
            $query = mysqli_query($conn, "select * from blog where own = '$_SESSION[id]' order by date desc ");


            for ($i=0; $i < $count / 3 ; $i++) {
                for ($x=0; $x < 3 ; $x++) {
                    if ($result = mysqli_fetch_assoc($query)) {
                        echo "

                        <tr>
                            <td width='100px'><a href='?page=read&read=$result[id]'><img src='$result[image]' /></a></td>
                            <td><a href='?page=read&read=$result[id]'>$result[topic]</a></td>
                            <td width='10%';><a href='?page=myblog&edit=$result[id]'><div class='submit'>Edit</div></a></td>
                            <td width='10%';><a href='?page=myblog&del=$result[id]'><div class='submit'>Delete</div></a></td>
                        </tr>
                        ";

                    }
                }
            }


        ?>
        <?php $query = mysqli_query($conn, "select * from blog"); ?>
        <?php while($result = mysqli_fetch_assoc($query)) : ?>



        <?php endwhile ?>
        </table>
    </div>
</div>

<?php } ?>
