<?php
$param = getParams();
if ($param['action'] == 'edit') {
    require_once(DIR_MODEL . 'model-schedule-function.php');
    $getID = new Admin_Model_Schedule_Function();
    $data = $getID->get_item(getParams());

    $vTitle = $data['title'];
    $vSlug = $data['slug'];
    $vDate = $data['date'];
    $vWeekdays = $data['weekdays'];
    if ($data['time']) {
        $time = explode('-', $data['time']);
        $vTimeStart = $time[0];
        $vTimeEnd = $time[1];
    } else {
        $vTimeStart = $data['timeStart'];
        $vTimeEnd = $data['timeEnd'];
    }
    $vPlace = $data['place'];
    $vNote = $data['note'];
    $vBranch = $data['branch'];
}
?>
<!--DOAN SCRIPT HIEN THI NGAY VA THU TRONG TUAN-->

<div class=" wrap">
    <h2><?php echo $lbl ?></h2>
    <?php echo $msg ?>

    <form action="" method="post" enctype="multipart/form-data" id="f1" name="f1">
        <input name="id" value="<?php echo $param['id'] ?>" type="hidden">

        <div class="row-one-column">
            <div class="title-cell">
                <label><?php echo __('Title') ?></label>
            </div>

            <div class="text-cell">
                <input type="text" class="type-text" id='title' name='title' class="my-input" value="<?php echo $vTitle ?>" />
            </div>
        </div>

        <div class="row-one-column">
            <div class="title-cell">
                <label><?php echo __('Date'); ?></label>
            </div>
            <div class="text-cell">
                <input type="text" class="type-date" id='getdate' name='getdate' value="<?php echo $vDate ?>" />
                <label>-</label>
                <input type="text" class="type-date" id='dayOfWeek' name='weekdays' value="<?php echo $vWeekdays ?>" />
            </div>
        </div>

        <div class="row-one-column">
            <div class="title-cell">
                <label><?php echo __('Time')  ?></label>
            </div>
            <div class="text-cell">
                <input type="text" id='timeStart' name='timeStart' class="type-time" maxlength="5" value="<?php echo $vTimeStart ?>" /> 
                <label>至</label>
                <input type="text" id='timeEnd' name='timeEnd' class="type-time" maxlength="5" value="<?php echo $vTimeEnd ?>" />
            </div>
        </div>

        <div class="row-one-column">
            <div class="title-cell">
                <label><?php echo __('地點')  ?></label>
            </div>
            <div class="text-cell">
                <input type="text" class="type-text" id='place' name='place' class="my-input" value="<?php echo $vPlace ?>" />
            </div>
        </div>

        <div class="row-one-column">
            <div class="title-cell">
                <label><?php echo __('備註')  ?></label>
            </div>
            <div class="text-cell">
                <textarea id='note' class="type-text"  name="note" rows='5' style="height: 80%;"><?php echo $vNote ?></textarea>
            </div>
        </div>
        <div class="button-space ">
            <button type="submit" name="submit" id='submit' class="button button-primary"><?php _e('Submit') ?></button>

        </div>

    </form>

</div>

<script type="text/javascript">
    jQuery(function() {
        // $('#dayOfWeek').attr('readonly', true);

        jQuery('#getdate').datepicker({
            dateFormat: 'dd/mm/yy',
            showAnim: 'show',
            onSelect: function(dateText) {
                var seldate = jQuery(this).datepicker('getDate');
                seldate = seldate.toDateString();
                seldate = seldate.split(' ');
                var weekday = new Array();
                weekday['Mon'] = "星期一";
                weekday['Tue'] = "星期二";
                weekday['Wed'] = "星期三";
                weekday['Thu'] = "星期四";
                weekday['Fri'] = "星期五";
                weekday['Sat'] = "星期六";
                weekday['Sun'] = "星期天";
                var dayOfWeek = weekday[seldate[0]];
                jQuery('#dayOfWeek').val(dayOfWeek); //.attr('readonly', true)
            },
            onClose: closeDatePicker_datepicker_1
        });
    });

    function closeDatePicker_datepicker_1() {
        var tElm = jQuery('#datepicker');
        if (typeof datepicker_1_Spry != null && typeof datepicker_1_Spry != "undefined" && test_Spry.validate) {
            datepicker_1_Spry.validate();
        }
        tElm.blur();
    }
</script>