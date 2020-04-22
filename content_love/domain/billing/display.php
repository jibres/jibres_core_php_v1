<?php if(\dash\data::groupByAction() && is_array(\dash\data::groupByAction())) {?>
<div class="f">
    <?php foreach (\dash\data::groupByAction() as $key => $value): ?>
        <div class="c pRa5">
            <a href="<?php echo \dash\url::that(). '?action='. $key ?>" class="stat x70 <?php if(\dash\request::get('action') == $key) { echo ' active';} ?>" >
                <h3><?php echo T_(ucfirst($key)); ?></h3>
                <div class="val"><?php echo \dash\fit::number($value); ?></div>
            </a>
        </div>
    <?php endforeach ?>
</div>
<?php } //endif ?>
<div class="fs14">


    <?php if(\dash\data::dataTable()) {?>

    <div class="tblBox">
        <table class="tbl1 v1">
            <thead>
                <th><?php echo T_("Domain"); ?></th>
                <th><?php echo T_("Action"); ?></th>
                <th><?php echo T_("Period"); ?></th>
                <th><?php echo T_("Price"); ?></th>
                <th><?php echo T_("Discount"); ?></th>
                <th><?php echo T_("Final price"); ?></th>
                <th><?php echo T_("Date"); ?></th>
                <th><?php echo T_("User"); ?></th>
            </thead>
            <tbody>
              <?php foreach (\dash\data::dataTable() as $key => $value) {?>
                <tr>
                    <td><?php echo \dash\get::index($value, 'domain'); ?></td>
                    <td><?php echo T_(ucfirst(\dash\get::index($value, 'action'))); ?></td>
                    <td><?php echo \dash\get::index($value, 'period_title'); ?></td>
                    <td><?php if(\dash\get::index($value, 'price')) {?><?php echo \dash\fit::number(\dash\get::index($value, 'price')); ?> <small><?php echo T_("Toman"); ?></small><?php }//endif ?></td>
                    <td><?php if(\dash\get::index($value, 'discount')) {?><?php echo \dash\fit::number(\dash\get::index($value, 'discount')); ?> <small><?php echo T_("Toman"); ?></small><?php }//endif ?></td>
                    <td><?php if(\dash\get::index($value, 'finalprice')) {?><?php echo \dash\fit::number(\dash\get::index($value, 'finalprice')); ?> <small><?php echo T_("Toman"); ?></small><?php }//endif ?></td>
                    <td class="collapsing"><?php echo \dash\fit::date_time(\dash\get::index($value, 'datecreated')); ?></td>
                    <td class="collapsing">
                      <a href="<?php echo \dash\url::that(). '?user='.\dash\get::index($value, 'user_id'); ?>" class="f userPack">
                        <div class="c pRa10">
                          <div class="mobile"><?php echo \dash\fit::mobile(\dash\get::index($value, 'user_detail', 'mobile')); ?></div>
                          <div class="name"><?php echo \dash\get::index($value, 'user_detail', 'displayname'); ?></div>
                        </div>
                        <img class="cauto" src="<?php echo \dash\get::index($value, 'user_detail', 'avatar'); ?>">
                      </a>
                    </td>
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
