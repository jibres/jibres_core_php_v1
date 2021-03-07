
<?php if(\dash\data::countFile()) {?>


<section class="row">
  <?php foreach (\dash\data::countFile() as $key => $value) {?>
  <div class="c">
    <a href="<?php echo \dash\url::this(). '?folder='. $key ?>" class="stat">
      <h3><?php echo $key ?></h3>
      <div class="val"><?php echo \dash\fit::number_en($value);?></div>
    </a>
  </div>
  <?php } //endif ?>
</section>
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
      <footer class="f">
        <div class="cauto"><?php if(\dash\data::ipDetail()) {?><a href="<?php echo \dash\url::this(). \dash\request::full_get(['download' => 'download']); ?>" data-action target='_blank' class="btn">Download file</a><?php } //endif ?></div>
        <div class="c"></div>
        <div class="cauto"><button class="btn master">Check</button></div>

      </footer>
    </div>
  </div>
</form>

<?php if(\dash\data::folderList()) {?>
  <div class="avand-md">

 <nav class="items long">
    <ul>
      <?php foreach (\dash\data::folderList() as $key => $value) {?>
      <li>
        <a class="item f" href="<?php echo \dash\url::this(). '?'. \dash\request::fix_get(['ip' => $value]) ;?>">
          <div class="key"><?php echo $value;?></div>
          <div class="go"></div>
        </a>
      </li>
    <?php } //endif ?>
      </ul>
  </nav>
  </div>
<?php } //endif ?>

<?php if(\dash\data::ipNotFound()) {?>
<div class="avand-md">
<div class="msg warn2"><?php echo T_("IP detail not found") ?></div>
</div>
<?php }elseif(\dash\data::ipDetail()) {?>
<pre>
  <?php print_r(\dash\data::ipDetail()) ?>
</pre>
<?php } //endif ?>