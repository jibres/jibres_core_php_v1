<?php foreach (\dash\data::resultAnswer() as $key => $value) {?>
  <div class='printArea pageBreak' data-size='A4' data-height='auto'>
    <table class="tbl1 v6 repeatHead">
      <thead>
        <tr>
          <td colspan="2"><?php echo \dash\data::formDetail_title() ?></td>
          <td><?php echo T_("Form ID") ?></td>
          <td><code class="compact txtB"><?php echo \dash\request::get('id'); ?></code></td>
        </tr>
        <tr>
          <td><?php echo T_("Filter ID") ?></td>
          <td><code class="compact txtB"><?php echo \dash\request::get('fid'); ?></code></td>
          <td><?php echo T_("Answer ID") ?></td>
          <td><code class="compact txtB"><?php echo $key; ?></code></td>

        </tr>
      </thead>
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
<div class=""></div>
<?php } //endif ?>

<?php \dash\utility\pagination::html() ?>
