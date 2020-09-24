<div class="avand-md">
  <div class="box">
    <div class="body">
      <p><?php echo T_("Remove analytics") ?></p>
      <div class="fc-red"><?php echo T_("All filter and analytics data will be removed") ?></div>
    </div>
    <footer class="f">
      	<div class="cauto"><a class="btn link" href="<?php echo \dash\url::that(). '?id='. \dash\request::get('id') ?>"><?php echo T_("Cancel") ?></a></div>
        <div class="c"></div>
        <div class="cauto"><div data-confirm data-data='{"removeanalytics": "removeanalytics"}' class="btn linkDel" ><?php echo T_("Remove analytics"); ?></div></div>

    </footer>
  </div>

</div>