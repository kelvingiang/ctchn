<div class="clear"></div>
</div>
<?php if(! is_category()) { ?>
<footer id="footer" role="contentinfo" class="footer">
    <div id="info" class="row">
        
    </div> 
    <div class="clear"></div>
    <div class="row copyright">
        <div class="col-xl-9 col-lg-8 col-md-12 col-sm-12">
            <label><?php //_e('Address'); ?><i class="fas fa-map-marker-alt"></i> : <?php echo get_option('about_address_' . $_SESSION['languages']) ?></label><br>
            <label><?php //_e('Phone'); ?><i class="fas fa-phone-alt"></i> : <?php echo get_option('about_phone') ?></label><br>
            <label><?php //_e('Email'); ?><i class="fas fa-envelope"></i> : <?php echo get_option('about_email') ?></label>
        </div>
        <div class="col-xl-3 col-lg-4 col-md-12 col-sm-12">
            <div>
                <label>
                    <i><?php _e('Online User'); ?> :</i>
                </label>
            </div>
            <div>
                <label>
                    <i><?php _e('Total User'); ?> :</i>
                </label>
            </div>
        </div>
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
            <a href="http://digiwin.com.vn" target="blank">
                Copyright © - 2022 Design by Digiwin Software (Vietnam) Co., Ltd.
            </a>
        </div>
    </div>
</footer>
<?php } ?>
<script type="text/javascript">
    jQuery(document).ready( function () {
       
    });
    
</script>
</body>
</html>