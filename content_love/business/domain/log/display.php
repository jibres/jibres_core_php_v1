<?php require_once(root. 'content_love/business/domain/pageStep.php'); ?>
<form method="post" autocomplete="off">
  <div class="avand-xl">

        <?php if(!\dash\data::dataTable()) {?>
          <div class="msg warn"><?php echo T_("No action found for this domain") ?></div>
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
              <td class="collapsing"><code><?php echo \dash\get::index($value, 'id'); ?></code></td>
              <td><?php echo \dash\get::index($value, 'action'); ?></td>
              <td><?php echo \dash\fit::date_time(\dash\get::index($value, 'datecreated')); ?></td>
              <td class="collapsing">
                <?php if(\dash\get::index($value, 'meta')) {?>
                <span data-kerkere=".showDetail<?php echo \dash\get::index($value, 'id'); ?>">
                  <i class="sf-list-ul"></i>
                </span>
              <?php } //endif ?>
              </td>
            </tr>
            <?php if(\dash\get::index($value, 'meta')) {?>
            <tr class="fs08 showDetail<?php echo \dash\get::index($value, 'id'); ?>" data-kerkere-content='hide'>
              <td colspan="4" class="txtL"><pre><?php if(is_array($value['meta'])){ echo json_encode($value['meta'], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT); }else{ echo htmlspecialchars($value['meta']);} ?></pre></td>
            </tr>
            <?php } //endif ?>
          <?php } //endfor ?>

            </tbody>
          </table>
          <?php \dash\utility\pagination::html() ?>
        <?php } //endif ?>

  </div>
</form>
