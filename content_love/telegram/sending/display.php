

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
      <th class="collapsing"><?php echo T_("SMS ID"); ?></th>
      <th class=""><?php echo T_("Status"); ?></th>
      <th class="collapsing"><?php echo T_("datecreated"); ?></th>
      <th class="collapsing"><?php echo T_("datemodified"); ?></th>

    </tr>
  </thead>
  <tbody>
    <?php foreach (\dash\data::dataTable() as $key => $value) {?>

    <tr>
      <td><?php echo $value['id']; ?></td>
      <td><?php echo $value['telegram_id']; ?></td>
      <td><?php echo $value['status']; ?></td>
      <td><?php echo $value['datecreated']; ?></td>
      <td><?php echo $value['datemodified']; ?></td>

    </tr>

    <?php } //endfor ?>
  </tbody>
</table>

<?php \dash\utility\pagination::html(); ?>


