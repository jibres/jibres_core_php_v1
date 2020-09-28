<div id="get_started_card">
  <div class="body">
    <div class="pad">
      <h1><?php echo T_("Please wait"); ?></h1>
      <p><?php echo T_("Building your online business in progress."); ?></p>
      <a style="display: none;" id="linkmhe" href="<?php echo \dash\url::this(); ?>"><?php echo T_("Try again"); ?></a>
    </div>
    <img class="loadingGif" src="<?php echo \dash\url::cdn(); ?>/img/business/loading1.gif" alt='<?php echo T_("Loading Jibres"); ?>'>
  </div>
</div>

<div class="hide">
  <div id="urlthat"><?php echo \dash\url::that(). '?'. \dash\request::fix_get(); ?></div>
  <div id="urlthis"><?php echo \dash\url::this(). '?'. \dash\request::fix_get(); ?></div>
  <div id="urlthisopening"><?php echo \dash\url::this(). '/opening?'. \dash\request::fix_get(); ?></div>
  <div id="urlthiserror"><?php echo \dash\url::this(). '/error?'. \dash\request::fix_get(); ?></div>
</div>