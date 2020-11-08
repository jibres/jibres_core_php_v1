<nav class="items">
  <ul>
    <li><a class="f item" href="<?php echo \dash\url::this(). '/detail?id='. \dash\request::get('id'); ?>"><i class="sf-thumbnails"></i><div class="key"><?php echo T_("Detail"); ?></div><div class="go"></div></a></li>
  </ul>
</nav>

<nav class="items">
  <ul>
    <li><a class="f item" href="<?php echo \dash\url::here(). '/chap/a4?id='. \dash\request::get('id'); ?>"><i class="sf-print"></i><div class="key"><?php echo T_("Print"). ' '. T_('A4');?></div><div class="go"></div></a></li>
    <li><a class="f item" href="<?php echo \dash\url::here(). '/chap/receipt?id='. \dash\request::get('id'); ?>"><i class="sf-print"></i><div class="key"><?php echo T_("Print"). ' '. T_('Receipt');?></div><div class="go"></div></a></li>
  </ul>
</nav>

<nav class="items">
  <ul>
    <li><a class="f item" href="<?php echo \dash\url::this(). '/comment?id='. \dash\request::get('id'); ?>"><i class="sf-comments-o"></i><div class="key"><?php echo T_("Comment"); ?></div><div class="go"></div></a></li>
  </ul>
</nav>