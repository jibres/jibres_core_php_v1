<?php require_once(root. 'content_a/form/analytics/pageStep.php'); ?>
<?php require_once(root. 'content_a/form/analytics/pageStep.php'); ?>
<div class="avand-lg">
  <?php if(\dash\data::itemDetail()) {?>
    <?php require_once('display-condition.php'); ?>
  <?php }else{ ?>
    <?php require_once('display-chose-item.php'); ?>
  <?php } //endif ?>
</div>