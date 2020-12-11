<div class="avand-md">
  <?php if(\dash\data::postWriterOld()) {?>
    <div class="box">
      <div class="pad">
        <p><?php echo T_("Current post wirter") ?></p>
        <div class="mB10 txtB"><?php echo \dash\data::postWriterOld_displayname(); ?></div>
        <div><?php echo \dash\fit::mobile(\dash\data::postWriterOld_mobile()); ?></div>
      </div>
    </div>
  <?php } //endif ?>

  <form method="post" autocomplete="off" id="editFormSEO">
    <div class="box">
      <div class="pad">
        <p><?php echo T_("You can change the author of the post manually");?></p>
        <select name="creator" class="select22">
          <option value="0"><?php echo T_("Change post writer") ?></option>
          <?php foreach (\dash\data::postWriter() as $key => $value) {?>
            <option <?php if(\dash\data::dataRow_user_id() == $value['id']) { echo 'selected';}  ?> value="<?php echo $value['id']; ?>">
              <?php echo a($value, 'displayname'); ?> - <?php echo \dash\fit::text(a($value, 'mobile')); ?>
            </option>
          <?php } //endfor ?>
        </select>
      </div>
      <footer class="txtRa">
        <button class="btn master"><?php echo T_("Save") ?></button>
      </footer>
    </div>
  </form>
</div>