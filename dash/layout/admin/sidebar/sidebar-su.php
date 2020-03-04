
<li>
  <ul>
    <li><a href="<?php echo \dash\url::here(); ?>/backup"><?php echo T_("Backup"); ?></a></li>
    <li><a href="<?php echo \dash\url::here(); ?>/dbtables"><?php echo T_("Raw table"); ?></a></li>

    <li><a href="<?php echo \dash\url::here(); ?>/time"><?php echo T_("Date and time"); ?></a></li>
    <li><a href="<?php echo \dash\url::here(); ?>/info"><?php echo T_("Server information"); ?></a></li>
    <li><a href="<?php echo \dash\url::here(); ?>/cronjob"><?php echo T_("Cronjob"); ?></a></li>
    <li><a href="<?php echo \dash\url::here(); ?>/ip"><?php echo T_("IP"); ?></a></li>

    <li><a href="<?php echo \dash\url::here(); ?>/gitstatus"><?php echo T_("Git status"); ?></a></li>
    <li><a href="<?php echo \dash\url::here(); ?>/nano"><?php echo T_("Nano"); ?></a></li>
    <li><a href="<?php echo \dash\url::here(); ?>/update" data-shortkey="85+80" data-shortkey-timeout='500'><?php echo T_("Update"); ?><kbd class="floatLa mRa10 fs08">up</kbd></a></li>

    <li><a href="<?php echo \dash\url::here(); ?>/log"><?php echo T_("Log"); ?></a></li>
    <li><a href="<?php echo \dash\url::here(); ?>/tempfile"><?php echo T_("Temp file"); ?></a></li>
    <li><a href="<?php echo \dash\url::here(); ?>/apilog"><?php echo T_("Api Log"); ?></a></li>
    <li><a href="<?php echo \dash\url::here(); ?>/smsclient"><?php echo T_("Sms client"); ?></a></li>

    <?php if(\dash\url::isLocal()) {?>

    <li><a href="<?php echo \dash\url::here(); ?>/permission"><?php echo T_("Permission"); ?></a></li>

    <?php } //endif ?>

    <li><a href="<?php echo \dash\url::here(); ?>/tg" data-shortkey="84+71" data-shortkey-timeout='500'><?php echo T_("Telegram"); ?><kbd class="floatLa mRa10 fs08">tg</kbd></a></li>

  </ul>
</li>

