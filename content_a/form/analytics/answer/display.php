<?php foreach (\dash\data::resultAnswer() as $key => $value) {?>
  <div class='printArea pageBreak' data-size='A4' data-height='auto'>
    <table class="tbl1 v6 repeatHead">
      <thead>
        <tr>
          <td colspan="2"><?php echo \dash\data::formDetail_title() ?> <span class="compact txtB"><?php echo \dash\fit::text(\dash\request::get('id')); ?></span></td>
          <td><?php echo T_("Filter ID") ?> <span class="compact txtB"><?php echo \dash\fit::text(\dash\request::get('fid')); ?></span></td>
          <td><?php echo T_("Answer ID") ?> <span class="compact txtB"><?php echo \dash\fit::text($key) ?></span></td>

        </tr>
      </thead>
      <tbody class="font-12">
        <?php $items = \dash\data::fields(); ?>
        <?php $i=0; foreach ($value as $k => $v) { $extra = in_array($v['item_type'], ['descriptive_answer']); if(isset($items[$v['item_id']]['visible']) && $items[$v['item_id']]['visible']) {}else{continue;} $i++;  ?>
        <?php  if(($i % 2) || ($extra)) { echo '<tr>';} ?>

        <th <?php if($extra) { echo 'colspan=""'; }else{echo 'class="w25p"'; } ?>><?php echo \dash\get::index($v, 'item_title'); ?></th>
        <td <?php if($extra) { echo 'colspan="3"'; }else{echo 'class="w25p"'; } ?>><?php echo \dash\get::index($v, 'answer'); ?><?php echo \dash\get::index($v, 'textarea'); ?></td>
        <?php  if(!($i % 2) || ($extra)) { echo '</tr>'; } ?>
      <?php } //endif ?>
    </tbody>
  </table>
</div>
<div class=""></div>
<?php } //endif ?>

<?php \dash\utility\pagination::html() ?>
