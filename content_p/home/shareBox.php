<nav class="f align-center">
  <div class="c"><?php echo T_("Share"); ?></div>
  <div class="cauto os share1">
    <a target="_blank" title='<?php echo T_("facebook"); ?>' href="https://www.facebook.com/sharer/sharer.php?u=<?php echo \dash\url::pwd(); ?>" class="facebook">
    	<?php echo \dash\data::site_title(); ?> <?php echo T_("facebook"); ?>
    </a>

    <a target="_blank" title='<?php echo T_("twitter"); ?>' href="https://twitter.com/home?status=<?php echo \dash\url::pwd(); ?>" class="twitter">
    	<?php echo \dash\data::site_title(). ' '. T_("twitter"); ?>
    </a>

    <a target="_blank" title='<?php echo T_("linkedin"); ?>' href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo \dash\url::pwd(); ?>&title=<?php echo urlencode(\dash\face::title()); ?>&summary=<?php echo urlencode(\dash\data::page_desc()); ?>" class="linkedin">
    	<?php echo \dash\data::site_title(). ' '. T_("linkedin"); ?>
    </a>

    <a target="_blank" title='<?php echo T_("telegram"); ?>' href="https://t.me/share/url?url=<?php echo \dash\url::pwd(); ?>&text=<?php echo urlencode(\dash\face::title()); ?>" class="telegram">
    	<?php echo \dash\data::site_title(). ' '. T_("telegram"); ?>
    </a>

  </div>
</nav>