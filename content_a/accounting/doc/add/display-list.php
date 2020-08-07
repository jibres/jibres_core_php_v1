<?php if(\dash\data::editMode() && \dash\data::docDetail()) {?>
 <table class="tbl1 v4">
   <thead>
     <tr>
       <th><?php echo T_("Assistant") ?></th>
       <th><?php echo T_("Detail") ?></th>
       <th><?php echo T_("Description") ?></th>
       <th><?php echo T_("Debtor") ?></th>
       <th><?php echo T_("Creditor") ?></th>
     </tr>
   </thead>
   <tbody>
     <?php foreach (\dash\data::docDetail() as $key => $value) {?>
      <tr>
        <td><?php echo \dash\get::index($value, 'assistant_id') ?></td>
        <td><?php echo \dash\get::index($value, 'details_id') ?></td>
        <td><?php echo \dash\get::index($value, 'desc') ?></td>
        <td><?php echo \dash\get::index($value, 'debtor') ?></td>
        <td><?php echo \dash\get::index($value, 'creditor') ?></td>
      </tr>
     <?php } //endfor ?>
   </tbody>

 </table>
<?php } //endif ?>

