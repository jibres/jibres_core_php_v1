<div class="avand-md">
  <form method="post" autocomplete="off">
    <div class="box">
      <div class="pad">
        <label for="user"><?php echo T_("Group user") ?> <small class="fc-red">* <?php echo T_("Required") ?></small></label>
        <div>
          <select name="group" class="select22" data-placeholder='<?php echo T_("Please choose one group") ?>'>
            <option value="" readonly><?php echo T_("Please choose one group") ?></option>
            <?php foreach (\dash\data::groupList() as $key => $value) {?>
              <option value="<?php echo a($value, 'key') ?>"><?php echo a($value, 'title') ?></option>
            <?php } //endif ?>
          </select>
        </div>
        <textarea name="text" class="txt mB10" rows="3" placeholder="<?php echo T_("Message text ...") ?>"></textarea>
      </div>
      <footer class="txtRa">
        <button class="btn master"><?php echo T_("Send") ?></button>
      </footer>
    </div>
  </form>
</div>