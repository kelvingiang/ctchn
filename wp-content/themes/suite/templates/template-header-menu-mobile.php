<!-- Menu Mobile -->
<div id="menu-mobile" class="menu-mobile">
    <div class="menu-mobile-icon">
        <i class="fas fa-bars" aria-hidden="true"></i>
    </div>
    <div class="menu-mobile-content"> 
        <?php
            if($_SESSION['languages'] == 'cn'){
                mobile_menu('mobile-menu-cn');
            }elseif($_SESSION['languages'] == 'vn'){
                mobile_menu('mobile-menu-vn');
            }elseif($_SESSION['languages'] == 'en'){
                mobile_menu('mobile-menu-en');
            }
        ?>
    </div>    
</div>