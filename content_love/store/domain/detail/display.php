<?php $value = \dash\data::dataRow(); ?>

<div class="box">
  <header><h2><?php echo \dash\get::index($value, 'domain'); ?></h2></header>
  <div class="body">
    <div class="ltr link txtB"><code><a target="_blank" href="http://<?php echo \dash\get::index($value, 'domain'); ?>"><?php echo \dash\get::index($value, 'domain'); ?> <i class="sf-external-link"></i></a></code></div>
    <div class="msg"><?php echo T_("Date created") ?>  <?php echo \dash\fit::date_time(\dash\get::index($value, 'datecreated')); ?></b>  | <small><?php echo \dash\fit::date_human(\dash\get::index($value, 'datecreated')); ?></small></div>
    <div class="msg"><?php echo T_("Date modified") ?>  <?php echo \dash\fit::date_time(\dash\get::index($value, 'datemodified')); ?></b> | <small><?php echo \dash\fit::date_human(\dash\get::index($value, 'datemodified')); ?></small></div>
    <div class="msg"><?php echo T_("Status") ?>  <?php echo \dash\get::index($value, 'status'); ?></b> </div>
    <div class="msg"><?php echo T_("Message") ?>  <?php echo \dash\get::index($value, 'message'); ?></b> </div>
    <div class="msg">
      <div class="ibtn mA10"><?php echo T_("DNS record") ?> <?php if(\dash\get::index($value, 'dnsrecord')) {?><i class="sf-check fc-green"></i><?php }else{ ?><i class="sf-times fc-red"></i><?php } //endif ?></div>
      <div class="ibtn mA10"><?php echo T_("HTTPS") ?> <?php if(\dash\get::index($value, 'https')) {?><i class="sf-check fc-green"></i><?php }else{ ?><i class="sf-times fc-red"></i><?php } //endif ?></div>
      <div class="ibtn mA10"><?php echo T_("Master domain") ?> <?php if(\dash\get::index($value, 'master')) {?><i class="sf-check fc-green"></i><?php }else{ ?><i class="sf-times fc-red"></i><?php } //endif ?></div>

    </div>
    <div class="msg"><?php echo T_("Cronjob status") ?>  <?php echo \dash\get::index($value, 'cronjobstatus'); ?></b> </div>

    <div class="msg"><?php echo T_("Cronjob date") ?>  <?php echo \dash\fit::date_time(\dash\get::index($value, 'cronjobdate')); ?></b>  | <small><?php echo \dash\fit::date_human(\dash\get::index($value, 'cronjobdate')); ?></small></div>
    <div class="msg"><?php echo T_("SSL request date") ?>  <?php echo \dash\fit::date_time(\dash\get::index($value, 'sslrequestdate')); ?></b>  | <small><?php echo \dash\fit::date_human(\dash\get::index($value, 'sslrequestdate')); ?></small></div>

    <div class="msg"><?php echo T_("SSL failed date") ?>  <?php echo \dash\fit::date_time(\dash\get::index($value, 'sslfailed')); ?></b>  | <small><?php echo \dash\fit::date_human(\dash\get::index($value, 'sslfailed')); ?></small></div>


  </div>
  <footer class="txtRa">
          <td><div class="btn primary" data-confirm data-data='{"send": "again", "domain" : "<?php echo \dash\get::index($value, 'domain'); ?>"}'><?php echo T_("Send request again") ?></div></td>

  </footer>
</div>

