<div class="layout">
    <div class="layout-box">
        <div class="layout-highlight">
            <?php if(isset($_SESSION['id'])) : ?>
                <a href="?">
                    Blog
                    <a href="?page=profile">
                        <img src="<?php echo $_SESSION['avatar'] ?>" style="width: 200px; height: 200px; border-radius: 50%; transform: translateY(33%)"/>
                    </a> Space
                </a>
            <?php else : ?>
                <a href="?">Blog <i class="fa fa-rocket" aria-hidden="true"></i> Space</a>
            <?php endif; ?>

        </div>
    </div>
    <div class="layout-box">
    </div>
</div>
