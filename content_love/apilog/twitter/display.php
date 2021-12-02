<div class="tblBox font-14">
   <table class="tbl1 v1">
      <thead>
         <tr>
            <th>ID</th>
            <th>Request type</th>
            <th>Date</th>
         </tr>
      </thead>
      <tbody>
         <?php foreach (\dash\data::dataTable() as $key => $value) { ?>
            <tr>
               <td><a class="btn" href="<?php echo \dash\url::that(). '/view?id='. a($value, 'id'); ?>"><?php echo a($value, 'id') ?></a></td>
               <td><?php echo a($value, 'request_type') ?></td>
               <td><?php echo \dash\fit::date_time(a($value, 'datecreated')) ?></td>
            </tr>
         <?php } //endfor ?>
      </tbody>
   </table>
</div>
<?php \dash\utility\pagination::html() ?>