  <div class="printArea" data-size='A4'>
    <div class="msg info2 txtL ltr txtB">
      <span><?php echo T_("Answer ID") ?></span>
      <span><code class="compact txtB"><?php echo \dash\request::get('id'). '_'.\dash\request::get('aid'); ?></code></span>
     </div>
  <table class="tbl1 v6">
    <tbody class="font-12">
      <?php $items = \dash\data::fields(); ?>
<?php $i=0; foreach (\dash\data::dataTable() as $key => $value) { if(isset($items[$value['item_id']]['visible']) && $items[$value['item_id']]['visible']) {}else{continue;} $i++;  ?>
      <?php  if($i % 2) { ?>
        <tr>
      <?php } //endif ?>
          <th class=""><?php echo \dash\get::index($value, 'item_title'); ?></th>
          <td class=""><?php echo \dash\get::index($value, 'answer'); ?><?php echo \dash\get::index($value, 'textarea'); ?></td>
      <?php  if(!($i % 2)) { ?>
        </tr>
      <?php } //endif ?>
<?php } //endif ?>
    </tbody>
  </table>
  </div>
