<?php $data = \dash\data::dataRow(); ?>
<div class="box">
  <div class="body">
    <div class="tblBox">
      <table class="tbl1 v4">
        <tbody>
          <?php foreach ($data as $key => $value) {?>
            <tr><td><?php echo $key ?></td><td><?php echo $value; ?></td></tr>
          <?php } //endif ?>

        </tbody>
      </table>
    </div>
  </div>
</div>
