
<?php if(\dash\data::myOldIp()) {?>
<form method="post">
  <div class="avand-sm">
    <div class="box">
      <div class="pad">
        <label for="oldip"><?php echo T_("OLD ip") ?></label>
        <div class="input ltr">
          <input type="text" name="oldip" id="oldip" value="45.82.139.124<?php // echo \dash\request::get('oldip') ?>" readonly disabled>
        </div>
        <div class="msg">
          <?php echo \dash\fit::number(\dash\data::myOldIp_count()). ' '. T_("Record founded") ?>
        </div>
        <label for="newip"><?php echo T_("New DNS IP") ?></label>
        <div class="input ltr">
          <input type="text" name="newip" id="newip" value="185.208.180.140" readonly disabled>
        </div>
      </div>
      <footer class="txtRa">
        <button class="btn danger"><?php echo T_("Update") ?></button>
      </footer>
    </div>
  </div>
</form>
<?php } //endif ?>