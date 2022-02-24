<div class="f">
  <div class="c6">
    <a class="dcard x1" href='<?php echo \dash\url::this(); ?>/datalist'>
      <div class="statistic pink">
        <div class="value"><?php echo \dash\utility\icon::svg('list-columns-reverse', 'bootstrap') ?></div>
        <div class="label"><?php echo T_("SMS list"); ?></div>
      </div>
    </a>
  </div>

  <div class="c6">
    <a class="dcard x1" href='<?php echo \dash\url::this(); ?>/sending'>
      <div class="statistic pink">
        <div class="value"><?php echo \dash\utility\icon::svg('send-fill', 'bootstrap' , null, 'p-8') ?></div>
        <div class="label"><?php echo T_("Sendign queue"); ?></div>
      </div>
    </a>
  </div>

   <div class="c6">
    <a class="dcard x1" href='<?php echo \dash\url::this(); ?>/sending?manual=run'>
      <div class="statistic pink">
        <div class="value"><?php echo \dash\utility\icon::svg('radioactive', 'bootstrap' , null, 'p-4') ?></div>
        <div class="label"><?php echo T_("Manual run"); ?></div>
      </div>
    </a>
  </div>
</div>