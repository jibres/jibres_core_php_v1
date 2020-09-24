<?php require_once(root. 'content_a/form/analytics/pageStep.php'); ?>
<div class="avand-md">
  <div class="box">
    <div class="body">
    	<div class="msg f">

    	<div class="cauto"><?php echo T_("Export filter data") ?></div>
    	<div class="c"></div>
    	<div class="cauto"><a href="<?php echo \dash\url::current(). '?'. \dash\request::fix_get(['export' => 'export']); ?>" target="_blank" class="btn master" ><?php echo T_("Export now") ?></a></div>
    	</div>

    </div>
    <footer class="f">
      	<div class="cauto"><div data-confirm data-data='{"removefilter": "removefilter"}' class="btn linkDel" ><?php echo T_("Remove filter"); ?></div></div>
    	<div class="c"></div>

    </footer>
  </div>

</div>