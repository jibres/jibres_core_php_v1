<div class="avand-xl">
  <form method="post">
    <div class="box">
      <div class="pad">
        <div class="body">
          <div class="switch1">
            <input type="checkbox" name="active" id="active" <?php if(\dash\data::cronjob()) { echo 'checked';} ?>>
            <label for="active"></label>
            <label for="active"><?php echo T_("Run cronjob for this service"); ?></label>
        </div>
      </div>
    </div>
    <footer class="txtRa">
      <button class="btn primary"><?php echo T_("Save"); ?></button>
      <a class="btn danger" target="_blank" href="<?php echo \dash\url::site(); ?>/hook/crontab"><?php echo T_("Manual execute"); ?></a>
      <a class="btn secondary outline" target="_blank" href="<?php echo \dash\url::this(); ?>?download=crontabme"><?php echo T_("Downalod crontab me file"); ?></a>
      <a class="btn secondary outline" target="_blank" href="<?php echo \dash\url::this(); ?>?download=result"><?php echo T_("Downalod Execut result"); ?></a>

    </footer>
  </div>
</form>
  <div class="ltr">
    <h3><code>UNIX crontab</code></h3>
    <?php echo nl2br(\dash\data::unixcrontab()); ?>
  </div>
</div>







