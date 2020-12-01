
<?php
$sortLink = \dash\data::sortLink();
?>
 <div class="tblBbox">
  <table class="tbl1 v1">
    <thead>
      <tr>
        <th data-sort=<?php echo \dash\get::index($sortLink, 'user_id', 'order'); ?>><a href="<?php echo \dash\get::index($sortLink, 'user_id', 'link'); ?>"><?php echo T_("User"); ?></a></th>
        <th data-sort=<?php echo \dash\get::index($sortLink, 'title', 'order'); ?>><a href="<?php echo \dash\get::index($sortLink, 'title', 'link'); ?>"><?php echo T_("Title"); ?></a></th>
        <th data-sort=<?php echo \dash\get::index($sortLink, 'plus', 'order'); ?>><a href="<?php echo \dash\get::index($sortLink, 'plus', 'link'); ?>"><i class="sf-plus-circle"></i></a></th>
        <th data-sort=<?php echo \dash\get::index($sortLink, 'minus', 'order'); ?>><a href="<?php echo \dash\get::index($sortLink, 'minus', 'link'); ?>"><i class="sf-minus-circle"></i></a></th>
        <th data-sort=<?php echo \dash\get::index($sortLink, 'budget', 'order'); ?>><a href="<?php echo \dash\get::index($sortLink, 'budget', 'link'); ?>"><?php echo T_("Budget"); ?></a></th>
        <th data-sort=<?php echo \dash\get::index($sortLink, 'condition', 'order'); ?>><a href="<?php echo \dash\get::index($sortLink, 'condition', 'link'); ?>"><?php echo T_("Condition"); ?></a></th>
        <th data-sort=<?php echo \dash\get::index($sortLink, 'verify', 'order'); ?>><a href="<?php echo \dash\get::index($sortLink, 'verify', 'link'); ?>"><?php echo T_("Verify"); ?></a></th>
        <th data-sort=<?php echo \dash\get::index($sortLink, 'datecreated', 'order'); ?>><a href="<?php echo \dash\get::index($sortLink, 'datecreated', 'link'); ?>"><?php echo T_("Date"); ?></a></th>
    <?php if(\dash\permission::supervisor()) {?>
        <th><?php echo T_("Detail") ?></th>
      <?php } //endif ?>
      </tr>
    </thead>

    <tbody>
      <?php foreach (\dash\data::dataTable() as $key => $value) {?>

      <tr <?php if(isset($value['verify']) && $value['verify']) {?> class="positive" <?php } ?>>
    <td>
      <div>
        <img src="<?php echo \dash\get::index($value, 'avatar'); ?>" class="avatar">
        <?php echo \dash\get::index($value, 'displayname'); ?>
      </div>
      <?php if(isset($value['user_id']) && $value['user_id']) {?><a href="<?php echo \dash\url::here(); ?>/member/glance?id=<?php echo $value['user_id']; ?>"><?php echo \dash\fit::mobile(\dash\get::index($value, 'mobile')); ?></a><?php }else{ ?><small class="hidden"><?php echo T_("Anonymous"); ?></small><?php } ?>
    </td>

    <td><?php echo \dash\get::index($value, 'title'); ?></td>

    <td><?php if(isset($value['plus']) && $value['plus']) {?><b>+<?php echo \dash\fit::number($value['plus']); ?></b><?php }//endif ?></td>
    <td><?php if(isset($value['minus']) && $value['minus']) {?><b>-<?php echo \dash\fit::number($value['minus']); ?></b><?php }//endif ?></td>

    <td title='<?php echo T_("Budget before"); ?> <?php echo \dash\fit::number($value['budget_before']); ?>'><?php echo \dash\fit::number($value['budget']) ?></td>

    <td><a href="<?php echo \dash\url::here(); ?>/transactions?condition=<?php echo \dash\get::index($value, 'condition'); ?>"><?php echo T_(\dash\get::index($value, 'condition')); ?></a></td>
    <td><?php if(isset($value['verify']) && $value['verify']) {?><i class="sf-check fc-green"></i><?php }else{ ?><i class="sf-times fc-red"></i><?php }//endif ?></td>
    <td title="<?php echo $value['datecreated']; ?>">
      <?php echo \dash\fit::date_time($value['datecreated']); ?>

    </td>
    <?php if(\dash\permission::supervisor()) {?>
      <td><a class="btn link" href="<?php echo \dash\url::kingdom(). '/pay/'. \dash\get::index($value, 'token') ?>"><?php echo T_("Detail") ?></a></td>
    <?php } //endif ?>
      </tr>
      <?php } //endfor ?>
    </tbody>
  </table>
  <?php \dash\utility\pagination::html(); ?>

 </div>