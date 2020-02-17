
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
      <th><?php echo T_("Id"); ?></th>
      <th><?php echo T_("Subdomain"); ?></th>
      <th><?php echo T_("Title"); ?></th>
      <th><?php echo T_("Plan"); ?></th>
      <th><?php echo T_("Last activity"); ?></th>
      <th><?php echo T_("Products"); ?></th>
      <th><?php echo T_("Factors"); ?></th>
      <th><?php echo T_("Sum factors"); ?></th>
      <th><?php echo T_("Customers"); ?></th>

    </tr>
  </thead>
  <tbody>
<?php foreach (\dash\data::dataTable() as $key => $value) {?>
    <tr>
      <td><code><?php echo @$value['id']; ?></code></td>
      <td><div class=""><?php echo @$value['subdomain']; ?></div></td>
      <td><?php echo @$value['title']; ?></td>
      <td><?php echo @$value['t_plan']; ?></td>
      <td><?php echo \dash\fit::date_human(@$value['lastactivity']); ?></td>
      <td><?php echo \dash\fit::number(@$value['product']); ?></td>
      <td><?php echo \dash\fit::number(@$value['factor']); ?></td>
      <td><?php echo \dash\fit::number(@$value['sumfactor']); ?></td>
      <td><?php echo \dash\fit::number(@$value['customer']); ?> <small><?php echo T_("Person"); ?></small></td>
    </tr>
<?php } //endfor ?>
  </tbody>
</table>


<?php \dash\utility\pagination::html(); ?>