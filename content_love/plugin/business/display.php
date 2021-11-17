
<div class="tblBox">

<table class="tbl1 v1 fs12 selectable">
  <thead>
    <tr>
      <th class="collapsing"><?php echo T_("Business"); ?></th>
      <th></th>
      <th><?php echo T_("Feature"); ?></th>
      <th><?php echo T_("Status"); ?></th>

      <th class="collapsing"><?php echo T_("Manage"); ?></th>

    </tr>
  </thead>
  <tbody>
    <?php foreach (\dash\data::dataTable() as $key => $value) {?>

    <tr>
      <td class="collapsing">
        <code><a href="<?php echo \dash\url::that(). '?'.\dash\request::build_query(['business_id' => a($value, 'id')]) ?>"><code><?php echo a($value, 'id'); ?></code></a> /
        <a href="<?php echo \dash\url::kingdom(). '/'.\dash\store_coding::encode(a($value, 'id'));?>"><code><?php echo \dash\store_coding::encode(a($value, 'id')); ?></code></a> /
        <a target="_blank" href="<?php echo \dash\url::protocol(). '://'. a($value, 'subdomain'). '.jibres.'. \dash\url::tld(); ?>"><?php echo a($value, 'subdomain'); ?></a></div>
      </td>
      <td>
        <img src="<?php echo a($value, 'logo'); ?>" class="avatar">
        <?php echo a($value, 'title'); ?>
      </td>

      <td>
        <code><a href="<?php echo \dash\url::that(). '?'.\dash\request::build_query(['plugin' => a($value, 'plugin')]) ?>"><?php echo a($value, 'plugin'); ?></a></code>
      </td>

      <td><a href="<?php echo \dash\url::that(). '?'.\dash\request::build_query(['fstatus' => a($value, 'status')]) ?>"><?php echo T_(a($value, 'status')); ?></a></td>

      <td class="collapsing">
        <a href="<?php echo \dash\url::this(). '/manage?id='. a($value, 'id') ?>" class="btn-outline-info"><?php echo T_("Manage") ?></a>
      </td>

    </tr>

    <?php } //endfor ?>
  </tbody>
</table>
</div>


<?php \dash\utility\pagination::html(); ?>


