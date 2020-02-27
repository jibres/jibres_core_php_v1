

  <div class="cbox fs12">
  <form method="get" action='<?php echo \dash\url::this(); ?>' data-action>

    <div class="input">
      <input type="search" name="q" placeholder='<?php echo T_("Search"); ?>' id="q" value="<?php echo \dash\request::get('q'); ?>" autofocus autocomplete='off'>

      <button class="addon btn "><?php echo T_("Search"); ?></button>
    </div>
  </form>
</div>

<table class="tbl1 v1 fs12">
  <thead>
    <tr>
      <th><?php echo T_("id"); ?></th>
      <th><?php echo T_("subdomain"); ?></th>
      <th><?php echo T_("title"); ?></th>
      <th><?php echo T_("owner"); ?></th>

      <th><?php echo T_("plan"); ?></th>
      <th><?php echo T_("datecreated"); ?></th>

    </tr>
  </thead>
  <tbody>
    <?php foreach (\dash\data::dataTable() as $key => $value) {?>

    <tr>
      <td><code><?php echo \dash\get::index($value, 'id'); ?></code></td>
      <td><div class=""><a target="_blank" href="<?php echo \dash\url::protocol(). '://'. \dash\get::index($value, 'subdomain'). '.jibres.'. \dash\url::tld(); ?>"><?php echo \dash\get::index($value, 'subdomain'); ?></a></div></td>
      <td><?php echo \dash\get::index($value, 'title'); ?></td>
      <td>
        <img src="<?php echo \dash\get::index($value, 'user_detail', 'avatar'); ?>" class="avatar">
          <?php echo \dash\get::index($value, 'user_detail', 'displayname'); ?>
          <br>
          <div class="badge light"><?php echo \dash\fit::mobile(\dash\get::index($value, 'user_detail', 'mobile')); ?></div>
          <a target="_blank" href="<?php echo \dash\url::kingdom(). '/enter?userid='. \dash\coding::decode(\dash\get::index($value, 'creator')); ?>"><i class="sf-in-alt"></i></a>
      </td>


      <td><?php echo \dash\get::index($value, 't_plan'); ?></td>
      <td>
        <?php echo \dash\fit::date_time(\dash\get::index($value, 'datecreated')); ?>
        <br>
        <?php echo \dash\fit::date_human(\dash\get::index($value, 'datecreated')); ?>

      </td>

    </tr>

    <?php } //endfor ?>
  </tbody>
</table>

<?php \dash\utility\pagination::html(); ?>


