

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

      <th class="collapsing"><?php echo T_("Store"); ?></th>
      <th class="collapsing"><?php echo T_("datecreated"); ?></th>

    </tr>
  </thead>
  <tbody>
    <?php foreach (\dash\data::dataTable() as $key => $value) {?>

    <tr>
      <td class="collapsing">
        <a class="btn-outline-primary" href="<?php echo \dash\url::this(). '/view?id='. $value['id'] ?>">
          <i class="sf-eye"></i>
          <code><?php echo $value['id'] ?></code>
        </a>
      </td>
      <td class="collapsing">
          <?php echo \dash\fit::mobile($value['mobile']); ?>
      </td>
      <td><?php echo $value['message']; ?></td>
      <td class="collapsing">
        <div><?php echo $value['status']; ?></div>
        <div><?php echo $value['type']; ?></div>
        <div><?php echo $value['mode']; ?></div>
      </td>
      <td class="collapsing"><?php echo a($value, 'store_id'); ?></td>
      <td class="collapsing">
        <div><?php echo \dash\fit::date_time($value['datecreated']); ?></div>
      </td>


    </tr>

    <?php } //endfor ?>
  </tbody>
</table>

<?php \dash\utility\pagination::html(); ?>


