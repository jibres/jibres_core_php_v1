

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
      <th class="collapsing"><?php echo T_("ID"); ?></th>
      <th class="collapsing"><?php echo T_("Mobile"); ?></th>
      <th class=""><?php echo T_("Message"); ?></th>
      <th class="collapsing">
        <div><?php echo T_("Type"); ?></div>
        <div><?php echo T_("Mode"); ?></div>
      </th>
      <th class="collapsing"><?php echo T_("IP"); ?></th>
      <th class="collapsing"><?php echo T_("Store"); ?></th>
      <th class="collapsing"><?php echo T_("datecreated"); ?></th>
      <th class="collapsing"><?php echo T_("User"); ?></th>

    </tr>
  </thead>
  <tbody>
    <?php foreach (\dash\data::dataTable() as $key => $value) {?>

    <tr>
      <td class="collapsing">

          <a class="btn primary2" href="<?php echo \dash\url::this(). '/view?id='. $value['id'] ?>">
            <i class="sf-eye"></i>
            <code><?php echo $value['id'] ?></code>
          </a>

      </td>
      <td class="collapsing">
          <?php echo \dash\fit::mobile($value['mobile']); ?>
          <?php if($value['mobiles']) {?>
            <i class="fc-red"><?php echo T_("Multiple mobiles") ?></i>
          <?php } // ?>
      </td>
      <td><?php echo $value['message']; ?></td>

      <td class="collapsing">
        <div><?php echo $value['type']; ?></div>
        <div><?php echo $value['mode']; ?></div>
      </td>
      <td class="collapsing"><?php echo $value['ip']; ?></td>
      <td class="collapsing"><?php echo $value['store_id']; ?></td>
      <td class="collapsing">
        <div><?php echo \dash\fit::date_time($value['datesend']); ?></div>
      </td>
      <td class="collapsing">
        <?php if($value['user_id']) {?>
        <img src="<?php echo \dash\get::index($value, 'user_detail', 'avatar'); ?>" class="avatar">
          <?php echo \dash\get::index($value, 'user_detail', 'displayname'); ?>
          <br>
          <div class="badge light"><?php echo \dash\fit::mobile(\dash\get::index($value, 'user_detail', 'mobile')); ?></div>
          <a target="_blank" href="<?php echo \dash\url::kingdom(). '/enter?userid='. \dash\coding::decode(\dash\get::index($value, 'creator')); ?>"><i class="sf-in-alt"></i></a>
        <?php }else{ ?>
          <i>-</i>
        <?php } //endif ?>
      </td>

    </tr>

    <?php } //endfor ?>
  </tbody>
</table>

<?php \dash\utility\pagination::html(); ?>


