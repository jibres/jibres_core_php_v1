<nav class="f align-center">
  <div class="c"><?php echo T_("Share"); ?></div>
  <div class="cauto os share1">
    <a target="_blank" title='<?php echo T_("facebook"); ?>' href="https://www.facebook.com/sharer/sharer.php?u=<?php echo \dash\url::pwd(); ?>" class="facebook">
    	<?php echo \dash\face::site(); ?> <?php echo T_("facebook"); ?>
    </a>

    <a target="_blank" title='<?php echo T_("twitter"); ?>' href="https://twitter.com/share?url=<?php echo \dash\url::pwd(); ?>&amp;text=<?php echo urlencode(\dash\face::desc()); ?>" class="twitter">
    	<?php echo \dash\face::site(). ' '. T_("twitter"); ?>
    </a>

    <a target="_blank" title='<?php echo T_("linkedin"); ?>' href="https://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo \dash\url::pwd(); ?>&amp;title=<?php echo urlencode(\dash\face::title()); ?>&amp;summary=<?php echo urlencode(\dash\face::desc()); ?>" class="linkedin">
    	<?php echo \dash\face::site(). ' '. T_("linkedin"); ?>
    </a>

    <a target="_blank" title='<?php echo T_("telegram"); ?>' href="https://t.me/share/url?url=<?php echo \dash\url::pwd(); ?>&amp;text=<?php echo urlencode(\dash\face::title()); ?>" class="telegram">
    	<?php echo \dash\face::site(). ' '. T_("telegram"); ?>
    </a>

  </div>
</nav>