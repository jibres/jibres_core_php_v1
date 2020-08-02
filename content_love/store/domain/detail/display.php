<?php $value = \dash\data::dataRow(); ?>

<div class="box">
  <div class="body">
    <div class="txtL ltr">

  <li>domain: <b><?php echo \dash\get::index($value, 'domain'); ?></b> </li>
  <li>subdomain: <b><?php echo \dash\get::index($value, 'subdomain'); ?></b> </li>
  <li>root: <b><?php echo \dash\get::index($value, 'root'); ?></b> </li>
  <li>tld: <b><?php echo \dash\get::index($value, 'tld'); ?></b> </li>
  <li>datecreated: <b><?php echo \dash\get::index($value, 'datecreated'); ?></b> </li>
  <li>dns1: <b><?php echo \dash\get::index($value, 'dns1'); ?></b> </li>
  <li>dns2: <b><?php echo \dash\get::index($value, 'dns2'); ?></b> </li>
  <li>dnsrecord: <b><?php echo \dash\get::index($value, 'dnsrecord'); ?></b> </li>
  <li>dnsip: <b><?php echo \dash\get::index($value, 'dnsip'); ?></b> </li>
  <li>https: <b><?php echo \dash\get::index($value, 'https'); ?></b> </li>
  <li>status: <b><?php echo \dash\get::index($value, 'status'); ?></b> </li>
  <li>message: <b><?php echo \dash\get::index($value, 'message'); ?></b> </li>
  <li>datemodified: <b><?php echo \dash\get::index($value, 'datemodified'); ?></b> </li>
  <li>master: <b><?php echo \dash\get::index($value, 'master'); ?></b> </li>
  <li>cronjobstatus: <b><?php echo \dash\get::index($value, 'cronjobstatus'); ?></b> </li>
  <li>cronjobdate: <b><?php echo \dash\get::index($value, 'cronjobdate'); ?></b> </li>
  <li>sslrequestdate: <b><?php echo \dash\get::index($value, 'sslrequestdate'); ?></b> </li>
  <li>sslfailed: <b><?php echo \dash\get::index($value, 'sslfailed'); ?></b> </li>

    </div>
  </div>
  <footer class="txtRa">
          <td><div class="btn primary" data-confirm data-data='{"send": "again", "domain" : "<?php echo \dash\get::index($value, 'domain'); ?>"}'><?php echo T_("Send request again") ?></div></td>

  </footer>
</div>

