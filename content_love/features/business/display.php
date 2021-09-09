
<div class="tblBox">

<table class="tbl1 v1 fs12 selectable">
  <thead>
    <tr>
      <th><?php echo T_("id"); ?></th>
      <th><?php echo T_("Url"); ?></th>
      <th><?php echo T_("subdomain"); ?></th>
      <th><?php echo T_("title"); ?></th>
      <th><?php echo T_("owner"); ?></th>
      <th><?php echo T_("status"); ?></th>

      <th><?php echo T_("Feature"); ?></th>
      <th class="collapsing"><?php echo T_("Setting"); ?></th>

    </tr>
  </thead>
  <tbody>
    <?php foreach (\dash\data::dataTable() as $key => $value) {?>

    <tr>
      <td><code><?php echo a($value, 'id'); ?></code></td>
      <td><a href="<?php echo \dash\url::kingdom(). '/'.\dash\store_coding::encode(a($value, 'id'));?>"><code><?php echo \dash\store_coding::encode(a($value, 'id')); ?></code></a></td>
      <td><div class=""><a target="_blank" href="<?php echo \dash\url::protocol(). '://'. a($value, 'subdomain'). '.jibres.'. \dash\url::tld(); ?>"><?php echo a($value, 'subdomain'); ?></a></div></td>
      <td>
        <img src="<?php echo a($value, 'logo'); ?>" class="avatar">
        <?php echo a($value, 'title'); ?>

      </td>
      <td>
        <img src="<?php echo a($value, 'user_detail', 'avatar'); ?>" class="avatar">
          <?php echo a($value, 'user_detail', 'displayname'); ?>
          <br>
          <div class="badge light"><?php echo \dash\fit::mobile(a($value, 'user_detail', 'mobile')); ?></div>
          <a target="_blank" href="<?php echo \dash\url::kingdom(). '/enter?userid='. \dash\coding::decode(a($value, 'creator')); ?>"><i class="sf-in-alt"></i></a>
      </td>


      <td><?php echo T_(a($value, 'store_status')); ?></td>
      <td title="<?php echo \dash\fit::date_time(a($value, 'datecreated')); ?>">

        <code>
          <?php echo a($value, 'feature_key'); ?>
        </code>

      </td>
      <td class="collapsing">
        <a href="<?php echo \dash\url::this(). '/setting?id='. a($value, 'id') ?>" class="link btn"><?php echo T_("Setting") ?></a>
      </td>

    </tr>

    <?php } //endfor ?>
  </tbody>
</table>
</div>


<?php \dash\utility\pagination::html(); ?>


