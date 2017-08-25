<?php
    # isset = ต้องเจอ
    # empty = ต้องว่างปล่าว (! << ตรงข้าม)
    if (isset($_GET['page']) && !empty($_GET['page'])) {

        # ลิ้งต่างๆที่เข้าได้เมื่อ login
        if (isset($_SESSION['id'])) {
            switch ($_GET['page']) {
                # Auth
                case '404':
                    require_once ('views/404.php');
                break;

                case 'logout':
                    require_once ('views/auth/logout.php');
                break;

                case 'profile':
                    require_once ('views/auth/profile.php');
                break;

                case 'editavatar':
                    require_once ('views/auth/editavatar.php');
                break;

                case 'changepassword':
                    require_once ('views/auth/changepassword.php');
                break;

                case 'editprofile' :
                    require_once ('views/auth/editprofile.php');
                break;


                # Blog
                case 'myblog':
                    require_once ('views/blog/myblog.php');
                break;

                case 'writeblog':
                    require_once ('views/blog/writeblog.php');
                break;

                # ถ้าเกิดไม่ตรงเงื่อยไขให้ไปหน้า 404
                default:
                    header('location:?page=404');
                break;
            }
        } else {
            # switch = เข้าเงื่อนไขเมื่อค่าตรงกับเงื่อนไขที่เราตั้ง
            switch ($_GET['page']) {
                # Auth
                case '404':
                    require_once ('views/404.php');
                break;

                case 'login':
                    require_once ('views/auth/login.php');
                break;

                case 'register':
                    require_once ('views/auth/register.php');
                break;

                # Blog
                case 'myblog':
                    header('location:?page=login');
                break;

                case 'writeblog':
                    header('location:?page=login');
                break;


                # ถ้าเกิดไม่ตรงเงื่อยไขให้ไปหน้า 404
                default:
                    header('location:?page=404');
                break;
            }
        }



    } else {
        require_once ('views/layout/main.php');
    }
?>
