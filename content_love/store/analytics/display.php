
  <div class="cbox fs12">
  <form method="get" action='<?php echo \dash\url::this(); ?>' >

    <div class="input">
      <input type="search" name="q" placeholder='<?php echo T_("Search"); ?>' id="q" value="<?php echo \dash\request::get('q'); ?>" <?php \dash\layout\autofocus::html() ?> autocomplete='off'>

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
      <td><code><?php echo \dash\get::index($value, 'id'); ?></code></td>
      <td><div class=""><?php echo \dash\get::index($value, 'subdomain'); ?></div></td>
      <td><?php echo \dash\get::index($value, 'title'); ?></td>
      <td><?php echo \dash\get::index($value, 't_plan'); ?></td>
      <td><?php echo \dash\fit::date_human(\dash\get::index($value, 'lastactivity')); ?></td>
      <td><?php echo \dash\fit::number(\dash\get::index($value, 'product')); ?></td>
      <td><?php echo \dash\fit::number(\dash\get::index($value, 'factor')); ?></td>
      <td><?php echo \dash\fit::number(\dash\get::index($value, 'sumfactor')); ?></td>
      <td><?php echo \dash\fit::number(\dash\get::index($value, 'customer')); ?> <small><?php echo T_("Person"); ?></small></td>
    </tr>
<?php } //endfor ?>
  </tbody>
</table>


<?php \dash\utility\pagination::html(); ?>