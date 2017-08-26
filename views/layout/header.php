<div class="header" id="pc">
    <ul>
        <a href="?"><li>Blog <i class="fa fa-rocket" aria-hidden="true"></i> Space |</li></a>
        <a href="?page=myblog"><li>My Blog </li></a>
        <a href="?page=writeblog"><li>Write Blog </li></a>
    </ul>
    <ul>
        <?php if (!isset($_SESSION['id'])): ?>
            <a href="?page=register"><li>Sign Up</li></a>
            <a href="?page=login"><li>Sign In</li></a>
        <?php else: ?>
            <a href="?page=logout"><li>Logout <i class="fa fa-power-off" aria-hidden="true" style="color:red;"></i></li></a>
            <a href="?page=profile"><li>Profile</li></a>
        <?php endif; ?>
    </ul>
</div>

<div class="header" id="mb">
    <ul>
        <a href="?"><li>Blog <i class="fa fa-rocket" aria-hidden="true"></i> Space |</li></a>

    </ul>
    <ul>
        <li class="header-burger">
            <i class="fa fa-list-ul" aria-hidden="true"></i>
            <ul>
                <a href="?page=myblog"><li>My Blog </li></a>
                <a href="?page=writeblog"><li>Write Blog </li></a>
                <?php if (!isset($_SESSION['id'])): ?>
                    <a href="?page=register"><li>Sign Up</li></a>
                    <a href="?page=login"><li>Sign In</li></a>
                <?php else: ?>
                    <a href="?page=profile"><li>Profile</li></a>
                    <a href="?page=logout"><li>Logout <i class="fa fa-power-off" aria-hidden="true" style="color:red;"></i></li></a>
                <?php endif; ?>
            </ul>
        </li>
    </ul>
</div>
