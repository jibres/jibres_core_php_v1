
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
      <th><?php echo T_("Domain"); ?></th>
      <th><?php echo T_("Title"); ?></th>
      <th><?php echo T_("DNS"); ?></th>
      <th><?php echo T_("HTTPS"); ?></th>
      <th><?php echo T_("Status"); ?></th>
      <th><?php echo T_("Message"); ?></th>
      <th><?php echo T_("Datemodified"); ?></th>


    </tr>
  </thead>
  <tbody>
<?php foreach (\dash\data::dataTable() as $key => $value) {?>
    <tr>
      <td><code><?php echo \dash\get::index($value, 'id'); ?></code></td>
      <td><div class=""><?php echo \dash\get::index($value, 'domain'); ?></div></td>
      <td><?php echo \dash\get::index($value, 'title'); ?></td>
      <td><?php echo \dash\get::index($value, 'dns1'). ' - '. \dash\get::index($value, 'dns2'); ?></td>
      <td><?php echo \dash\fit::number(\dash\get::index($value, 'https')); ?></td>
      <td><?php echo \dash\fit::number(\dash\get::index($value, 'status')); ?></td>
      <td><?php echo \dash\fit::number(\dash\get::index($value, 'message')); ?></td>
      <td><?php echo \dash\fit::date_human(\dash\get::index($value, 'datemodified')); ?></td>
    </tr>
<?php } //endfor ?>
  </tbody>
</table>


<?php \dash\utility\pagination::html(); ?>