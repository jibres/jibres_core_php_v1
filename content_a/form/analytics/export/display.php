<?php require_once(root. 'content_a/form/analytics/pageStep.php'); ?>
<div class="avand-md">
  <div class="box">
    <div class="body">
      <p><?php echo T_("Export filter data") ?></p>
    </div>
    <footer class="txtRa">
      <a href="<?php echo \dash\url::current(). '?'. \dash\request::fix_get(['export' => 'export']); ?>" target="_blank" class="btn master" ><?php echo T_("Export now") ?></a>
    </footer>
  </div>
</div>