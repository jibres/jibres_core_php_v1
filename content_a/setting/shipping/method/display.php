<div class="avand-md">
  <form method="post" autocomplete="off">
    <div class="box">
      <div class="pad">
        <p><?php echo T_("Define shipping methods detail");?></p>

        <label for="title"><?php echo T_("Title"); ?></label>
        <div class="input">
          <input type="text" name="title" value="<?php echo \dash\data::dataRow_title() ?>">
        </div>

        <label for="desc"><?php echo T_("Description"); ?></label>
        <textarea class="txt" name="desc" rows="3"></textarea>



      </div>
      <footer class="txtRa">
        <button  class="btn success" ><?php echo T_("Save"); ?></button>
      </footer>
    </div>
  </form>

  <?php if(\dash\data::methodList()) {?>
    <?php foreach (\dash\data::methodList() as $key => $value){ ?>
      <div class="box">
        <div class="pad">
          <div class="txtB fs14"><?php echo a($value, 'title') ?></div>
          <p><?php echo a($value, 'desc'); ?></p>
        </div>
        <footer class="txtRa">
          <div class="btn danger outline" data-confirm data-data='{"remove": "remove", "title" : "<?php echo a($value, 'title') ?>"}'><?php echo T_("Remove") ?></div>
        </footer>

      </div>
    <?php } ?>
  <?php } //endif ?>
</div>