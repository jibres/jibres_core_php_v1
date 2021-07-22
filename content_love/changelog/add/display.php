
<div class="avand-md">
  <form method="post" autocomplete="off">
    <div class="box">
      <div class="pad">

        <textarea class="txt" rows="3" data-placeholder='<?php echo T_("Title") ?>'  name="html"><?php echo \dash\data::dataRow_title(); ?></textarea>

        <label><?php echo T_("Date"); ?></label>
        <div class="input">
          <input type="tel" name="date" placeholder="<?php echo T_("Soon"); ?>" value="<?php echo \dash\utility\convert::to_en_number(\dash\fit::date(\dash\data::dataRow_date())); ?>" data-format='date'>
        </div>

        <label><?php echo T_("Link"); ?></label>
        <div class="input">
          <input type="url" name="link" value="<?php echo \dash\data::dataRow_link(); ?>">
        </div>

        <label><?php echo T_("Tag"); ?></label>
        <select name="tag[]" id="tag" class="select22 mB20" data-model="tag" multiple="multiple">
          <?php foreach (\dash\data::listChangelogTag() as $key => $value) {?>
            <option value="<?php echo $value; ?>" <?php if(is_array(\dash\data::currentTag()) && in_array($value, \dash\data::currentTag())) {echo 'selected'; } ?>><?php echo $value; ?></option>
          <?php } //endfor ?>
        </select>

        <?php if(!\dash\data::editMode()) {?>
          <div class="check1 mT10">
            <input type="checkbox" name="sendtg" id="sendtg">
            <label for="sendtg"><?php echo T_("Send in Telegram"); ?></label>
          </div>
        <?php } //endif ?>

      </div>
      <footer>
        <div class="row">
          <div class="c-auto">
            <?php if(\dash\data::editMode()) {?>
              <div class="btn danger outline" data-confirm data-data='{"remove":"remove"}'><?php echo T_("Remove") ?></div>
            <?php } //endif ?>
          </div>
          <div class="c"></div>
          <div class="c-auto">
            <?php if(\dash\data::editMode()) {?>
              <button class="btn primary"><?php echo T_("Edit") ?></button>
            <?php }else{ ?>
              <button class="btn success"><?php echo T_("Add") ?></button>
            <?php } //endif ?>
          </div>

        </div>
      </footer>
    </div>
  </form>
</div>

