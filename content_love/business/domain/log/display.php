<?php require_once(root. 'content_love/business/domain/pageStep.php'); ?>
<form method="post" autocomplete="off">
  <div class="avand-xl">

        <?php if(!\dash\data::dataTable()) {?>
          <div class="alert-warning"><?php echo T_("No action found for this domain") ?></div>
        <?php }else{ ?>
          <table class="tbl1 v4 fs14">
            <thead>
              <tr>
                <th class="collapsing"></th>
                <th><?php echo T_("Action") ?></th>
                <th><?php echo T_("Time") ?></th>
                <th class="collapsing"></th>
              </tr>
            </thead>
            <tbody>

          <?php foreach (\dash\data::dataTable() as $key => $value) {?>
            <tr>
              <td class="collapsing"><code><?php echo a($value, 'id'); ?></code></td>
              <td><?php echo a($value, 'action'); ?></td>
              <td><?php echo \dash\fit::date_time(a($value, 'datecreated')); ?></td>
              <td class="collapsing">
                <?php if(a($value, 'meta')) {?>
                <span data-kerkere=".showDetail<?php echo a($value, 'id'); ?>">
                  <?php echo \dash\utility\icon::svg('CircleInformation', 'major', 'black', 'w-4'); ?>
                </span>
              <?php } //endif ?>
              </td>
            </tr>
            <?php if(a($value, 'meta')) {?>
            <tr class=" w-fit showDetail<?php echo a($value, 'id'); ?>" data-kerkere-content='hide'>
              <td colspan="4">
<samp class="text-left block"><?php
  if(is_string($value['meta']))
  {
    $value['meta'] = json_decode(stripslashes($value['meta']), true);
  }
  if(is_array($value['meta']))
  {
    echo json_encode($value['meta'], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
  }
  else
  {
    echo htmlspecialchars(stripslashes($value['meta']));
  }
?></samp>
              </td>
            </tr>
            <?php } //endif ?>
          <?php } //endfor ?>

            </tbody>
          </table>
          <?php \dash\utility\pagination::html() ?>
        <?php } //endif ?>

  </div>
</form>
