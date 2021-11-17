<?php
$orderDetail = \dash\data::orderDetail();
$orderStatus = a($orderDetail, 'factor', 'status');
?>
<?php if($orderStatus === 'deleted') {?>
        <div class="alert-danger fs14 txtC"><?php echo T_("This order was deleted") ?></div>
<?php } ?>