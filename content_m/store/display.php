

  <div class="cbox fs12">
  <form method="get" action='<?php echo \dash\url::this(); ?>' data-action>

    <div class="input">
      <input type="search" name="q" placeholder='<?php echo T_("Search"); ?>' id="q" value="<?php echo \dash\request::get('q'); ?>" autofocus autocomplete='off'>

      <button class="addon btn "><?php echo T_("Search"); ?></button>
    </div>
  </form>
</div>

<table class="tbl1 v6 fs11">
  <thead>
    <tr>
      <th><?php echo T_("id"); ?></th>
      <th><?php echo T_("subdomain"); ?></th>
      <th><?php echo T_("title"); ?></th>
      <th><?php echo T_("owner"); ?></th>
      <th><?php echo T_("status"); ?></th>
      <th><?php echo T_("plan"); ?></th>
      <th><?php echo T_("datecreated"); ?></th>
      <th><?php echo T_("dbversion"); ?></th>
      <th><?php echo T_("dbversiondate"); ?></th>
      <th><?php echo T_("creator"); ?></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach (\dash\data::dataTable() as $key => $value) {?>

    <tr>
      <td><code><?php echo @$value['id']; ?></code></td>
      <td><div class=""><?php echo @$value['subdomain']; ?></div></td>
      <td><?php echo @$value['title']; ?></td>
      <td><?php echo @$value['owner']; ?></td>
      <td><?php echo @$value['t_status']; ?></td>
      <td><?php echo @$value['t_plan']; ?></td>
      <td><?php echo \dash\fit::date(@$value['datecreated']); ?></td>
      <td><?php echo @$value['dbversion']; ?></td>
      <td><?php echo \dash\fit::date(@$value['dbversiondate']); ?></td>
      <td><?php echo @$value['creator']; ?></td>
    </tr>

    <?php } //endfor ?>
  </tbody>
</table>

<?php \dash\utility\pagination::html(); ?>


