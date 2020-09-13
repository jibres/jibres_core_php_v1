<?php require_once(root. 'content_love/business/domain/pageStep.php'); ?>
<form method="post" autocomplete="off">
  <div class="avand-xl">
    <div class="box">
      <div class="body">
        <?php if(!\dash\data::dataTable()) {?>
          <div class="msg warn"><?php echo T_("No action found for this domain") ?></div>
        <?php }else{ ?>

          <?php foreach (\dash\data::dataTable() as $key => $value) {?>
            <div class="msg">
              <?php echo \dash\get::index($value, 'datecreated'); ?>
            </div>
          <?php } //endif ?>
        <?php } //endif ?>

      </div>
    </div>
  </div>
</form>
