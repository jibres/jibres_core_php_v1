<?php foreach (\dash\data::resultAnswer() as $key => $value) {?>
  <div class="printArea" data-size='A4'>
    <div class="msg info2 txtL ltr txtB">
      <span><?php echo T_("Answer ID") ?></span>
      <span><code class="compact txtB"><?php echo \dash\request::get('id'). '_'. $key; ?></code></span>
    </div>
    <table class="tbl1 v6">
      <tbody class="font-12">
        <?php $items = \dash\data::fields(); ?>
        <?php $i=0; foreach ($value as $k => $v) { $extra = in_array($v['item_type'], ['descriptive_answer']); if(isset($items[$v['item_id']]['visible']) && $items[$v['item_id']]['visible']) {}else{continue;} $i++;  ?>
        <?php  if(($i % 2) || ($extra)) { echo '<tr>';} ?>

        <th class="" <?php if($extra) { echo 'colspan="2"'; } ?>><?php echo \dash\get::index($v, 'item_title'); ?></th>
        <td class="" <?php if($extra) { echo 'colspan="2"'; } ?>><?php echo \dash\get::index($v, 'answer'); ?><?php echo \dash\get::index($v, 'textarea'); ?></td>
        <?php  if(!($i % 2) || ($extra)) { echo '</tr>'; } ?>
      <?php } //endif ?>
    </tbody>
  </table>
</div>
<div class="pageBreak"></div>
<?php } //endif ?>
