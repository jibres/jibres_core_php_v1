

<?php if(!\dash\data::dataTable()){?>

  <div class="msg warn2 txtC txtB fs14"><?php echo T_("No result found") ?></div>

<?php }else{ ?>

  <table class="tbl1 v6 fs11">
    <thead>
      <tr>
        <th><?php echo T_("Domain"); ?></th>
        <th><?php echo T_("Status"); ?></th>
        <th><?php echo T_("Last modified"); ?></th>
        <th class="collapsing"></th>
      </tr>
    </thead>
    <tbody>
   <?php foreach (\dash\data::dataTable() as $key => $value) {?>
      <tr>
        <td class="ltr txtL">
          <div class="">
            <a target="_blank" href="<?php echo \dash\url::protocol(). '://'. \dash\get::index($value, 'domain'); ?>">
              <code><?php echo \dash\get::index($value, 'domain'); ?></code><i class="sf-external-link"></i>
            </a>
          </div>
        </td>
        <td><?php echo \dash\get::index($value, 'tstatus'); ?></td>
        <td><div><?php echo \dash\fit::date_time(\dash\get::index($value, 'last_log_time')); ?></div><div><?php echo \dash\fit::date_human(\dash\get::index($value, 'last_log_time')); ?></div></td>
        <td class="collapsing"><a class="btn primary" href="<?php echo \dash\url::that(). '/manage?domain='. \dash\get::index($value, 'domain'); ?>"><?php echo T_("Setting") ?></a></td>
      </tr>
    <?php } //endfor ?>
    </tbody>
  </table>

<?php \dash\utility\pagination::html(); ?>

<?php } //endif ?>