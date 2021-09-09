<?php $dataRow = \dash\data::dataRow(); ?>
<div class="avand">

<div class="tblBox font-14">
  <table class="tbl1 v4">
    <thead>
      <tr>
        <th><?php echo T_("Feature") ?></th>
        <th><?php echo T_("Status") ?></th>
        <th><?php echo T_("Price") ?></th>
        <th><?php echo T_("Added by") ?></th>
        <th><?php echo T_("Datecreated") ?></th>
        <th><?php echo T_("Expire date") ?></th>
        <th><?php echo T_("Date modified") ?></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach (\dash\data::featuresList() as $key => $value) {?>
        <tr>
          <td><?php echo a($value, 'feature_key') ?></td>
          <td><?php echo a($value, 'status') ?></td>
          <td><?php echo \dash\fit::number(a($value, 'price')) ?></td>
          <td><?php echo a($value, 'feataddedby') ?></td>
          <td><?php if(a($value, 'datecreated')) {echo \dash\fit::date_time(a($value, 'datecreated'));}else{echo '-';}  ?></td>
          <td><?php if(a($value, 'expiredate')) {echo \dash\fit::date_time(a($value, 'expiredate'));}else{echo '-';}  ?></td>
          <td><?php if(a($value, 'datemodified')) {echo \dash\fit::date_time(a($value, 'datemodified'));}else{echo '-';}  ?></td>
        </tr>
      <?php } //endfor ?>
    </tbody>
  </table>
</div>



  <form method="post" autocomplete="off">
    <input type="hidden" name="addfeatures" value="1">
    <div class="box">
      <div class="body">
        <label for="features"><?php echo T_("Add new feature to this business") ?></label>
        <div>
          <select class="select22" name="features" id="features">
            <?php foreach (\dash\data::allFeatures() as $key => $value) { ?>

              <option value="<?php echo a($value, 'feature_key') ?>" ><?php echo a($value, 'title') ?></option>
            <?php } //endif ?>
          </select>
        </div>
      </div>
      <footer class="txtRa">
        <button class="btn master"><?php echo T_("Add") ?></button>
      </footer>
    </div>
  </form>


</div>