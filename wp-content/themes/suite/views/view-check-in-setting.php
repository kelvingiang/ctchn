<?php $page = getParams('page'); ?>
<div>
    <ul>
        <li>
            <a class="button button-primary" href="<?php echo "admin.php?page=$page&action=export_member"?>">
                <?php _e('Export Member') ?>
            </a>
        </li>
        <li>
            <a class="button button-primary" href="<?php echo "admin.php?page=$page&action=import_member"?>">
                <?php _e('Import Member') ?>
            </a>
        </li>
    </ul>
</div>