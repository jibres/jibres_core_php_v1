<?php if(\dash\data::formItems()) {?>
  <table class="tbl1 v1">
    <thead>
      <tr>
        <th class="collapsing">#</th>
        <th><?php echo T_("Form item") ?></th>
        <th><?php echo T_("Type") ?></th>
        <th class="collapsing"><?php echo T_("Report") ?></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach (\dash\data::formItems() as $key => $value) {?>
        <tr>

          <td class="collapsing"><?php echo \dash\fit::number(a($value, 'sort') ? $value['sort'] + 1 : $key + 1  ); ?></td>
          <td><?php echo a($value, 'title'); ?></td>
          <td><?php echo a($value, 'type_detail', 'title') ?></td>

          <td class="collapsing">
            <?php if(a($value, 'type_detail', 'chart')) {?>
              <a class="btn-link" href="<?php echo \dash\url::that(). '/answer?id='. a($value, 'form_id'). '&iid='. a($value, 'id'); ?>"><i class="sf-chart"></i> <?php echo T_("Report") ?></a></td>
            <?php }else{ ?>
              <a class="btn-link" href="<?php echo \dash\url::this(). '/answer/item?id='. a($value, 'form_id'). '&iid='. a($value, 'id'); ?>"><i class="sf-list-ul"></i> <?php echo T_("Answers") ?></a></td>
            <?php } //endif ?>
        </tr>
      <?php } //endif ?>
    </tbody>
  </table>
    <?php }else{ ?>
    <div class="alert-warning text-center font-bold">
        <?php echo T_("No item to generate report"); ?>
    </div>
<?php } //endif ?>

