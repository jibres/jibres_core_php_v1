
<div class="avand-sm zero">
  <h2><?php echo T_("Social Media Connected to Smart Share"); ?></h2>
  <nav class="items mB25-f">
    <ul>
      <li>
        <a class="f" href="<?php echo \dash\url::this(); ?>/telegram">
          <img src="<?php echo \dash\url::cdn(); ?>/img/logo/social/telegram.svg" alt='<?php echo T_("Telegram"); ?>'>
          <div class="key"><?php echo T_("Telegram"); ?></div>
          <div class="go"></div>
        </a>
      </li>
      <li>
        <a class="f" href="<?php echo \dash\url::this(); ?>/instagram">
          <img src="<?php echo \dash\url::cdn(); ?>/img/logo/social/instagram.svg" alt='<?php echo T_("Instagram"); ?>'>
          <div class="key"><?php echo T_("Instagram"); ?></div>
          <div class="go"></div>
        </a>
      </li>
    </ul>
  </nav>


  <h2><?php echo T_("Social Media"); ?></h2>
  <nav class="items mB25-f">
    <ul>
      <li>
        <a class="f" href="<?php echo \dash\url::this(); ?>/fb">
          <img src="<?php echo \dash\url::cdn(); ?>/img/logo/social/facebook.svg" alt='<?php echo T_("Facebook"); ?>'>
          <div class="key"><?php echo T_("Facebook"); ?></div>
          <div class="go"></div>
        </a>
      </li>

      <li>
        <a class="f" href="<?php echo \dash\url::this(); ?>/tw">
          <img src="<?php echo \dash\url::cdn(); ?>/img/logo/social/twitter.svg" alt='<?php echo T_("Twitter"); ?>'>
          <div class="key"><?php echo T_("Twitter"); ?></div>
          <div class="go"></div>
        </a>
      </li>


      <li>
        <a class="f" href="<?php echo \dash\url::this(); ?>/linkedin">
          <img src="<?php echo \dash\url::cdn(); ?>/img/logo/social/linkedin.svg" alt='<?php echo T_("Linkedin"); ?>'>
          <div class="key"><?php echo T_("Linkedin"); ?></div>
          <div class="go"></div>
        </a>
      </li>

      <li>
        <a class="f" href="<?php echo \dash\url::this(); ?>/github">
          <img src="<?php echo \dash\url::cdn(); ?>/img/logo/social/github.svg" alt='<?php echo T_("Github"); ?>'>
          <div class="key"><?php echo T_("Github"); ?></div>
          <div class="go"></div>
        </a>
      </li>

      <li>
        <a class="f" href="<?php echo \dash\url::this(); ?>/youtube">
          <img src="<?php echo \dash\url::cdn(); ?>/img/logo/social/youtube.svg" alt='<?php echo T_("Youtube"); ?>'>
          <div class="key"><?php echo T_("Youtube"); ?></div>
          <div class="go"></div>
        </a>
      </li>


    </ul>
  </nav>

<?php if (\dash\language::current() === 'fa') { ?>
  <h2><?php echo T_("Iranian Social Media"); ?></h2>
  <nav class="items mB25-f">
    <ul>
      <li>
        <a class="f" href="<?php echo \dash\url::this(); ?>/aparat">
          <img src="<?php echo \dash\url::cdn(); ?>/img/logo/social/aparat.svg" alt='<?php echo T_("Aparat"); ?>'>
          <div class="key"><?php echo T_("Aparat"); ?></div>
          <div class="go"></div>
        </a>
      </li>
    </ul>
  </nav>
<?php } ?>


</div>