<?php $dataRow = \dash\data::dataRow(); ?>
<div class="avand">

<div class="tblBox font-16">
  <table class="tbl1 v4">
    <thead>
      <tr>
        <th><?php echo T_("Feature") ?></th>
        <th><?php echo T_("Status") ?></th>
        <!-- <th><?php echo T_("Price") ?></th> -->
        <th><?php echo T_("Added by") ?></th>
        <th><?php echo T_("Datecreated") ?></th>
        <th><?php echo T_("Expire date") ?></th>
        <th><?php echo T_("Date modified") ?></th>
        <th class="collapsing"></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach (\dash\data::featuresList() as $key => $value) {?>
        <tr>
          <td><?php echo a($value, 'feature_key') ?></td>
          <td><?php echo T_(a($value, 'status')) ?></td>
          <!-- <td><?php echo \dash\fit::number(a($value, 'price')) ?></td> -->
          <td><?php echo T_(a($value, 'addedby')) ?></td>
          <td><?php if(a($value, 'datecreated')) {echo \dash\fit::date_time(a($value, 'datecreated'));}else{echo '-';}  ?></td>
          <td><?php if(a($value, 'expiredate')) {echo \dash\fit::date_time(a($value, 'expiredate'));}else{echo '-';}  ?></td>
          <td><?php if(a($value, 'datemodified')) {echo \dash\fit::date_time(a($value, 'datemodified'));}else{echo '-';}  ?></td>
          <td class="collapsing">
            <?php if(a($value, 'status') === 'enable') {?><div data-confirm data-data='{"remove": "feature", "feature_key": "<?php echo a($value, 'feature_key') ?>"}'><i class="sf-trash fc-red font-18"></i></div><?php } //endif ?>
            <?php if(a($value, 'status') !== 'enable') {?><div data-confirm data-data='{"addfeatures": "1", "features": "<?php echo a($value, 'feature_key') ?>"}'><i class="sf-refresh fc-green font-18"></i></div><?php } //endif ?>
          </td>
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
          <select class="select22" name="features" id="features" data-placeholder="<?php echo T_("Please select one item") ?>">
            <option value=""><?php echo T_("Please select one item") ?></option>
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