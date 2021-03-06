
<?php if(\dash\data::countFile()) {?>
<div class="avand-md ltr">
  <?php foreach (\dash\data::countFile() as $key => $value) {?>
    <div class="msg row font-14">
      <div class="c txtB"><?php echo $key ?></div>
      <div class="c"><?php echo \dash\fit::number_en($value) ?></div>
    </div>
  <?php } //endif ?>
</div>
<?php } //endif ?>

<form method="get" autocomplete="off" action="<?php echo \dash\url::this(); ?>">
  <div class="avand-md">
    <div class="box ltr txtL">
      <div class="pad">
        <label>IP</label>
        <div class="input ltr">
          <input type="text" name="ip" value="<?php echo \dash\data::myIP() ?>">
        </div>
        <?php if(\dash\data::ipDetail()) {?>
          <div class="row">
            <div class="c"><div class="btn block danger" data-confirm data-data='{"status": "block"}'>Block</div></div>
            <div class="c"><div class="btn block warn" data-confirm data-data='{"status": "isolate"}'>Isolate</div></div>
            <div class="c"><div class="btn block success" data-confirm data-data='{"status": "unblock"}'>Unblock</div></div>
            <div class="c"><div class="btn block master" data-confirm data-data='{"status": "whitelist"}'>Whitelist</div></div>
            <div class="c"><div class="btn block secondary" data-confirm data-data='{"status": "blacklist"}'>Blacklist</div></div>
          </div>
        <?php } //endif ?>
      </div>
      <footer class="txtLa">
        <button class="btn master">Check</button>
      </footer>
    </div>
  </div>
</form>

<?php if(\dash\data::ipNotFound()) {?>
<div class="avand-md">
<div class="msg warn2"><?php echo T_("IP detail not found") ?></div>
</div>
<?php }elseif(\dash\data::ipDetail()) {?>
<pre>
  <?php print_r(\dash\data::ipDetail()) ?>
</pre>
<?php } //endif ?>