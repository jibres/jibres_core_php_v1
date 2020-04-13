<div class="f justify-center">
 <div class="c9 m12 s12 fs14">

    <?php if(\dash\data::dataTable()) {?>

    <div class="tblBox">
        <table class="tbl1 v1">

            <tbody>
     	      <?php foreach (\dash\data::dataTable() as $key => $value) {?>
                <tr>
                    <td><?php echo \dash\get::index($value, 'title'); ?></td>
                    <td><?php if(\dash\get::index($value, 'price')) {?><?php echo \dash\fit::number(\dash\get::index($value, 'price')); ?> <small><?php echo T_("Toman"); ?></small><?php }//endif ?></td>
                    <td class="collapsing"><?php echo \dash\fit::date_time(\dash\get::index($value, 'datecreated')); ?></td>
                </tr>
              <?php }// endfor ?>
            </tbody>
        </table>
    </div>
    <?php }else{ ?>

      <div class="msg warn2"><?php echo T_("No billing history founded"); ?></div>
    <?php } //endif ?>

<?php \dash\utility\pagination::html(); ?>

</div>
