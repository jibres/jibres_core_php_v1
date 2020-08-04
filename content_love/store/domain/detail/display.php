<?php $value = \dash\data::dataRow(); ?>

<div class="box">
  <header><h2><?php echo \dash\get::index($value, 'domain'); ?></h2></header>
  <div class="body">
    <table class="tbl1 v4">
      <tbody>
        <tr><td><?php echo T_("Domain") ?></td><td><code><a target="_blank" href="http://<?php echo \dash\get::index($value, 'domain'); ?>"><?php echo \dash\get::index($value, 'domain'); ?> <i class="sf-external-link"></i></a></code></td></tr>

        <tr><td><?php echo T_("Date created") ?></td><td><?php echo \dash\fit::date_time(\dash\get::index($value, 'datecreated')); ?>  | <small><?php echo \dash\fit::date_human(\dash\get::index($value, 'datecreated')); ?></small></td></tr>
        <tr><td><?php echo T_("Date modified") ?></td><td><?php echo \dash\fit::date_time(\dash\get::index($value, 'datemodified')); ?>  | <small><?php echo \dash\fit::date_human(\dash\get::index($value, 'datemodified')); ?></small></td></tr>

        <tr>
          <td><?php echo T_("Status") ?></td>
          <td>
            <?php echo \dash\get::index($value, 'status'); ?>
            <div data-confirm data-data='{"status": "ok", "setstatus": "setstatus"}' class="ibtn mA10"><?php echo T_("Set status on ok") ?> <i class="sf-check fc-green"></i></div>
            <div data-confirm data-data='{"status": "failed", "setstatus": "setstatus"}' class="ibtn mA10"><?php echo T_("Set status on failed") ?> <i class="sf-times fc-red"></i></div>
            <div data-confirm data-data='{"status": "pending", "setstatus": "setstatus"}' class="ibtn mA10"><?php echo T_("Set status on pending") ?> <i class="sf-refresh"></i></div>
          </td>
        </tr>

        <tr>
          <td><?php echo T_("Message") ?></td>
          <td><?php echo \dash\get::index($value, 'message'); ?></td>
        </tr>

        <tr>
          <td><?php echo T_("Setting") ?></td>
          <td>
            <div class="ibtn mA10"><?php echo T_("DNS record") ?> <?php if(\dash\get::index($value, 'dnsrecord')) {?><i class="sf-check fc-green"></i><?php }else{ ?><i class="sf-times fc-red"></i><?php } //endif ?></div>
            <div class="ibtn mA10"><?php echo T_("HTTPS") ?> <?php if(\dash\get::index($value, 'https')) {?><i class="sf-check fc-green"></i><?php }else{ ?><i class="sf-times fc-red"></i><?php } //endif ?></div>
            <div class="ibtn mA10"><?php echo T_("Master domain") ?> <?php if(\dash\get::index($value, 'master')) {?><i class="sf-check fc-green"></i><?php }else{ ?><i class="sf-times fc-red"></i><?php } //endif ?></div>
          </td>
        </tr>

        <tr>
          <td><?php echo T_("Cronjob status") ?></td>
          <td><?php echo \dash\get::index($value, 'cronjobstatus'); ?></td>
        </tr>

        <tr>
          <td><?php echo T_("Cronjob date") ?></td>
          <td><?php echo \dash\fit::date_time(\dash\get::index($value, 'cronjobdate')); ?></td>
        </tr>

        <tr>
          <td><?php echo T_("Cronjob status") ?></td>
          <td><?php echo \dash\get::index($value, 'cronjobstatus'); ?></td>
        </tr>

        <tr>
          <td><?php echo T_("SSL request date") ?></td>
          <td><?php echo \dash\fit::date_time(\dash\get::index($value, 'sslrequestdate')); ?></td>
        </tr>




      </tbody>
    </table>


  </div>
  <footer class="txtRa">
          <td><div class="btn primary" data-confirm data-data='{"send": "again", "domain" : "<?php echo \dash\get::index($value, 'domain'); ?>"}'><?php echo T_("Send request again") ?></div></td>
          <td><div class="btn danger" data-confirm data-data='{"send": "reset", "domain" : "<?php echo \dash\get::index($value, 'domain'); ?>"}'><?php echo T_("Reset config") ?></div></td>

  </footer>
</div>

