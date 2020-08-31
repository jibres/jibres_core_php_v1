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

          <td class="collapsing"><?php echo \dash\fit::number(\dash\get::index($value, 'sort')); ?></td>
          <td><?php echo \dash\get::index($value, 'title'); ?></td>
          <td><?php echo \dash\get::index($value, 'type_detail', 'title') ?></td>

          <td class="collapsing">
            <?php if(\dash\get::index($value, 'type_detail', 'chart')) {?>
              <a class="btn link" href="<?php echo \dash\url::that(). '/answer?id='. \dash\get::index($value, 'form_id'). '&iid='. \dash\get::index($value, 'id'); ?>"><i class="sf-chart"></i> <?php echo T_("Report") ?></a></td>
            <?php }else{ ?>
              <a class="btn link" href="<?php echo \dash\url::this(). '/answer/item?id='. \dash\get::index($value, 'form_id'). '&iid='. \dash\get::index($value, 'id'); ?>"><i class="sf-list"></i> <?php echo T_("Answers") ?></a></td>
            <?php } //endif ?>
        </tr>
      <?php } //endif ?>
    </tbody>
  </table>
<?php } //endif ?>

