<?php
$tg = \dash\data::tg();
?>
<div class="f mB25">
  <div class="c3 s12">
    <div class="dcard x4 mB10 ">
      <h2><a href="https://t.me/<?php echo \dash\get::index($tg, 'info', 'bot'); ?>" target="_blank"><?php echo \dash\get::index($tg, 'info', 'bot'); ?></a></h2>
      <pre class="mT25"><?php echo \dash\get::index($tg, 'info', 'token'); ?></pre>
      <a class="btn dark outline mT25" href="<?php echo \dash\url::this(); ?>/log"><?php echo T_("Logs"); ?></a>
      <a class="btn dark outline mT25" href="<?php echo \dash\url::this(); ?>/users"><?php echo T_("Users"); ?></a>
      <a class="btn dark outline mT25" href="<?php echo \dash\url::this(); ?>/system"><?php echo T_("System"); ?></a>
    <?php if(\dash\user::id() === 1) {?>
      <a class="btn danger outline mT10" href="<?php echo \dash\url::this(); ?>/webhook"><?php echo T_("Webhook"); ?></a>
    <?php } ?>
    </div>
  </div>
  <div class="c s12">
    <div class="dcard x2 mB10">
      <a class="btn primary" href="<?php echo \dash\url::this(); ?>/sendmessage"><?php echo T_("Send message"); ?></a>
    </div>
    <div class="dcard x2 mB10">
      salam
    </div>

  </div>
  <div class="c s12">
    <div class="dcard x2 mB10">
      <a class="btn" href="<?php echo \dash\url::this(); ?>/sendphoto"><?php echo T_("Send photo"); ?></a>
    </div>
    <div class="dcard x2 mB10">
      salam
    </div>
  </div>
</div>
