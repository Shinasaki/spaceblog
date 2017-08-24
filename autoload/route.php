<?php
    # isset = ต้องเจอ
    # empty = ต้องว่างปล่าว (! << ตรงข้าม)
    if (isset($_GET['page']) && !empty($_GET['page'])) {

        # switch = เข้าเงื่อนไขเมื่อค่าตรงกับเงื่อนไขที่เราตั้ง
        switch ($_GET['page']) {
            # หน้า 404
            case '404':
                require_once ('views/404.php');
            break;

            case 'login':
                require_once ('views/auth/login.php');
            break;
            case 'register':
                require_once ('views/auth/register.php');
            break;

            # ถ้าเกิดไม่ตรงเงื่อยไขให้ไปหน้า 404
            default:
                header('localhost:?page=404');
            break;
        }

    } else {
        require_once ('views/layout/main.php');
    }
?>
