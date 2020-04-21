

    <div id="get_started_card">
      <div class="body">
        <div class="pad">
          <h1><?php echo T_("Please wait"); ?></h1>
          <p><?php echo T_("Building your online store in progress."); ?></p>
          <a style="display: none;" id="linkmhe" href="<?php echo \dash\url::this(); ?>"><?php echo T_("Try again"); ?></a>

        </div>
        <img class="loadingGif" src="<?php echo \dash\url::cdn(); ?>/img/store/loading1.gif" alt='<?php echo T_("Loading Jibres"); ?>'>

      </div>
    </div>

<div class="hide">
  <div id="urlthat"><?php echo \dash\url::that(); ?></div>
  <div id="urlthis"><?php echo \dash\url::this(); ?></div>
</div>