<table class="tbl1 v1 fs12 selectable">
  <thead>
    <tr>
      <th class="collapsing"><?php echo T_("ID"); ?></th>
      <th class="collapsing"><?php echo T_("Chat id"); ?></th>

      <th class="collapsing"><?php echo T_("Status"); ?></th>
      <th class="collapsing"><?php echo T_("Store"); ?></th>
      <th class="collapsing"><?php echo T_("datecreated"); ?></th>

    </tr>
  </thead>
  <tbody>
    <?php foreach (\dash\data::dataTable() as $key => $value) {  ?>

    <tr>
      <td class="collapsing">
        <a class="btn-outline-primary" href="<?php echo \dash\url::this(). '/view?id='. $value['id'] ?>">
          <i class="sf-eye"></i>
          <code><?php echo $value['id'] ?></code>
        </a>
      </td>
      <td class="collapsing"><?php echo a($value, 'chatid'); ?></td>

      <td class="collapsing">
        <div><?php echo $value['status']; ?></div>
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


