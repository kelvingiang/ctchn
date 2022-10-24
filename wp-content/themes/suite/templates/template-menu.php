<?php 
    if($_SESSION['languages'] == 'cn'){
        suite_menu('computer-menu-cn');
    }elseif($_SESSION['languages'] == 'vn'){
        suite_menu('computer-menu-vn');
    }elseif($_SESSION['languages'] == 'en'){
        suite_menu('computer-menu-en');
    }
?>