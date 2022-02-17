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
      <button class="btn-primary"><?php echo T_("Save"); ?></button>
      <a class="btn-danger" target="_blank" href="<?php echo \dash\url::site(); ?>/hook/crontab"><?php echo T_("Manual execute"); ?></a>
      <a class="btn-outline-secondary" target="_blank" data-direct href="<?php echo \dash\url::this(); ?>?download=crontabme"><?php echo T_("Downalod crontab me file"); ?></a>
      <a class="btn-outline-secondary" target="_blank" data-direct href="<?php echo \dash\url::this(); ?>?download=result"><?php echo T_("Downalod Execut result"); ?></a>

    </footer>
  </div>
</form>
  <div class="ltr">
    <h3><code>UNIX crontab</code></h3>
    <?php echo nl2br(\dash\data::unixcrontab()); ?>
  </div>
  <br>
  <div class="mT20 ltr">
    Is busy cronjob?
<?php var_dump(\dash\utility\busy::is_busy('cronjob_business_once')); ?>
  </div>



  <div class="box ltr">
    <div class="body">
      <h2>Jibres Loop while true!</h2>
    <?php if(\lib\app\loop\run::force_stop()) {?>
      <div class="msg danger">Force stoped</div>
      <div class="btn success" data-confirm data-data='{"jibres_while_true" : "start"}'>Start while true</div>
    <?php }else{ ?>
      <div class="msg success">Is running</div>
      <div class="btn danger" data-confirm data-data='{"jibres_while_true" : "force_stop"}'>Stop while true</div>
    <?php } //endif ?>
    <div class="msg warn mT20">
      Current status
<pre>
<?php echo \lib\app\loop\run::status(); ?>
</pre>
    </div>
    </div>
  </div>
</div>









