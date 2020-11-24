

  <div class="cbox fs12">
  <form method="get" action='<?php echo \dash\url::this(); ?>' >

    <div class="input">
      <input type="search" name="q" placeholder='<?php echo T_("Search"); ?>' id="q" value="<?php echo \dash\validate::search_string(); ?>" <?php \dash\layout\autofocus::html() ?> autocomplete='off'>

      <button class="addon btn "><?php echo T_("Search"); ?></button>
    </div>
  </form>
</div>

<table class="tbl1 v1 fs12 selectable">
  <thead>
    <tr>
      <th><?php echo T_("ID"); ?></th>
      <th><?php echo T_("Mobile"); ?></th>
      <th><?php echo T_("Message"); ?></th>
      <th><?php echo T_("Url"); ?></th>
      <th><?php echo T_("Mode"); ?></th>
      <th><?php echo T_("Type"); ?></th>
      <th><?php echo T_("IP"); ?></th>
      <th><?php echo T_("Store"); ?></th>
      <th><?php echo T_("Line"); ?></th>
      <th><?php echo T_("datecreated"); ?></th>
      <th><?php echo T_("User"); ?></th>

    </tr>
  </thead>
  <tbody>
    <?php foreach (\dash\data::dataTable() as $key => $value) {?>

    <tr>
      <td class="collapsing"><code><?php echo $value['id']; ?></code></td>
      <td class="collapsing">
          <?php echo \dash\fit::mobile($value['mobile']); ?>
          <?php if($value['mobiles']) {?>
            <i class="fc-red"><?php echo T_("Multiple mobiles") ?></i>
          <?php } // ?>
      </td>
      <td><?php echo $value['message']; ?></td>
      <td><?php echo $value['url']; ?></td>
      <td><?php echo $value['mode']; ?></td>
      <td><?php echo $value['type']; ?></td>
      <td><?php echo $value['ip']; ?></td>
      <td><?php echo $value['store_id']; ?></td>
      <td><?php echo $value['line']; ?></td>
      <td>
        <div><?php echo \dash\fit::date_time($value['datesend']); ?></div>
      </td>
      <td>
        <img src="<?php echo \dash\get::index($value, 'user_detail', 'avatar'); ?>" class="avatar">
          <?php echo \dash\get::index($value, 'user_detail', 'displayname'); ?>
          <br>
          <div class="badge light"><?php echo \dash\fit::mobile(\dash\get::index($value, 'user_detail', 'mobile')); ?></div>
          <a target="_blank" href="<?php echo \dash\url::kingdom(). '/enter?userid='. \dash\coding::decode(\dash\get::index($value, 'creator')); ?>"><i class="sf-in-alt"></i></a>
      </td>

    </tr>

    <?php } //endfor ?>
  </tbody>
</table>

<?php \dash\utility\pagination::html(); ?>


