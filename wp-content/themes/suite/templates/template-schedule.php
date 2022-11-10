<div>
    <?php 
        require_once(DIR_MODEL . 'model-schedule-function.php');
        $model = new Admin_Model_Schedule_Function();
        $data = $model->getAllDataSchedule();
        $tmp = array();
        //print_r($data);
        if(!empty($data)){
            foreach ($data as $key => $arg) {
                $tmp[$arg['month'] . ' / ' . $arg['year']][] = $arg['id'];  
                $tmp[$arg['title']] = $arg['title'];
                $tmp[$arg['weekdays']] = $arg['weekdays'];
                $tmp[$arg['day']] = $arg['day'];
                $tmp[$arg['month']] = $arg['month'];
                $tmp[$arg['year']] = $arg['year'];
                $tmp[$arg['time']] = $arg['time'];
                $tmp[$arg['place']] = $arg['place'];
                $tmp[$arg['note']] = $arg['note'];
            }
        }
        //print_r($tmp);
        $output = array();
        foreach($tmp as $type => $labels){
            $output[] = array(
                'month' => $type,
                'id' => $labels,
                //'title', 'weekdays', 'day', 'time', 'note', 'place',
                // 'title' => $labels,
                // 'weekdays' => $labels,
                // 'day' => $labels,
                // 'time' => $labels,
                // 'note' => $labels,
                // 'place' => $labels
            );
        }
        print_r($output);
        $ids = array();
        foreach($output as $val){
            $ids = $val['id'];
            //print_r($val['id']);
            //lay thoi gian dau cuoi
            if ($val['time']) {
                $time = explode('-', $val['time']);
                $vTimeStart = $time[0];
                $vTimeEnd = $time[1];
            } else {
                $vTimeStart = $val['timeStart'];
                $vTimeEnd = $val['timeEnd'];
            }
            
            ?>
            <div class="schedule-month"><?php echo $val['month'] ?></div>
            <div class="schedule-item">
                <div class="schedule-head">
                    <div class="schedule-title">
                        <div><?php echo $val['title'] ?></div>
                        <div><i class="fas fa-angle-double-down"></i></div>
                    </div>
                    <div class="schedule-time">
                        <?php echo $val['weekdays'] . ' ' . $val['day'] . '-' . $val['month'] . '-' . $val['year'] ?>
                        &nbsp;&nbsp;
                        <?php echo _e('Time') . ' : ' . $vTimeStart . ' -- ' . $vTimeEnd ?>
                    </div>
                </div>
                <div class="schedule-content">
                    <div><label><b><?php _e('Place') ?> :</b></label> <?php echo $val['place'] ?></div>
                    <div><label><b><?php _e('Note') ?> :</b></label> <?php echo $val['note'] ?></div>
                </div>
            </div>
            <?php
        } 
    ?>       
</div>
<script type="text/javascript">
    jQuery(document).ready(function () {
        jQuery('.schedule-title').click(function () {
            //dong cac content dang mo
            jQuery(".schedule-content").css('display', 'none');
            //mo content duoc click
            var contentDisplay = jQuery(this).parent().next(".schedule-content").css('display');
            if (contentDisplay === 'none') {
                jQuery(this).parent().next(".schedule-content").slideDown('slow');
                jQuery(this).children('div').children('i').removeClass('fas fa-angle-double-down');
                jQuery(this).children('div').children('i').addClass('fas fa-angle-double-up');
            } else {
                jQuery(this).parent().next(".schedule-content").slideUp('80')
                jQuery(this).children('div').children('i').removeClass('fas fa-angle-double-up');
                jQuery(this).children('div').children('i').addClass('fas fa-angle-double-down');
            }
        });
    });
</script>