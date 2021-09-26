<?php
$orderDetail = \dash\data::orderDetail();
$orderStatus = a($orderDetail, 'factor', 'status');
?>
<?php if($orderStatus === 'deleted') {?>
        <div class="msg danger fs14 txtC"><?php echo T_("This order was deleted") ?></div>
<?php } ?>