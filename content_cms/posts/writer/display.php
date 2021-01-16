<section class="f" data-option='cms-post-writer'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Change post writer");?></h3>
      <div class="body">
        <p><?php echo T_("You can change the author of the post manually");?></p>

         <?php if(\dash\data::postWriterOld()) {?>
          <p><?php echo T_("Current post wirter") ?></p>
          <div class="mB10 txtB"><?php echo \dash\data::postWriterOld_displayname(); ?></div>
          <div><?php echo \dash\fit::mobile(\dash\data::postWriterOld_mobile()); ?></div>
         <?php } //endif ?>

      </div>
    </div>
  </div>
  <form method="post" class="c4 s12" data-patch>
    <div class="action">
        <select name="creator" class="select22" data-placeholder='<?php echo T_("Please select on item") ?>'>
          <option value=""><?php echo T_("Please select on item") ?></option>
          <?php foreach (\dash\data::postWriter() as $key => $value) {?>
            <option <?php if(\dash\data::dataRow_user_id() == $value['id']) { echo 'selected';}  ?> value="<?php echo $value['id']; ?>">
              <?php echo a($value, 'displayname'); ?> - <?php echo \dash\fit::text(a($value, 'mobile')); ?>
            </option>
          <?php } //endfor ?>
        </select>
    </div>
  </form>
</section>



<section class="f" data-option='cms-post-showwriter'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Show wrirter name");?></h3>
      <div class="body">

      </div>
    </div>
  </div>
  <form autocomplete="off" class="c4 s12" method="post" data-patch>
    <div class="action">
      <input type="hidden" name="runaction_showwriter" value="1">
      <select class="select22" name="showwriter">
          <option value="default" <?php if(\dash\data::dataRow_showwriter() == 'default') { echo 'selected'; } ?> ><?php echo T_("Default"); ?></option>
          <option value="visible" <?php if(\dash\data::dataRow_showwriter() == 'visible') { echo 'selected'; } ?> ><?php echo T_("Visible"); ?></option>
          <option value="hidden" <?php if(\dash\data::dataRow_showwriter() == 'hidden') { echo 'selected'; } ?> ><?php echo T_("Hidden"); ?></option>
        </select>
    </div>
  </form>
</section>
