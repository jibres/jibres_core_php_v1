<?php require_once(root. 'content_cms/posts/postDetail.php'); ?>
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
       <div>
        <div class="radio1">
          <input type="radio" name="showwriter" value="default" id="showwriterdefault" <?php if(\dash\data::dataRow_showwriter() === 'default' || !\dash\data::dataRow_showwriter()) {echo 'checked';} ?>>
          <label for="showwriterdefault"><?php echo \dash\data::defaultTitleShowwriter(); ?></label>
        </div>
        <div class="radio1 green">
          <input type="radio" name="showwriter" value="visible" id="showwritervisible" <?php if(\dash\data::dataRow_showwriter() === 'visible') {echo 'checked';} ?>>
          <label for="showwritervisible"><?php echo T_("Visible"); ?></label>
        </div>
        <div class="radio1 red">
          <input type="radio" name="showwriter" value="hidden" id="showwriterhidden" <?php if(\dash\data::dataRow_showwriter() === 'hidden') {echo 'checked';} ?>>
          <label for="showwriterhidden"><?php echo T_("Hidden"); ?></label>
        </div>
      </div>
    </div>
  </form>
</section>
