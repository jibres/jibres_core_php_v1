<?php $urlHere = \dash\url::here(); ?>

<div class="f justify-center">
  <div class="c8 s12 m10 x6 pA20">

    <nav class="items">
      <ul>
        <li><a class="f" href="<?php echo \dash\url::this(); ?>/address"><div class="key"><?php echo T_("Store address"); ?></div><div class="go"></div></a></li>
      </ul>
    </nav>

    <nav class="items">
      <ul>
        <li><a class="f" href="<?php echo \dash\url::that(); ?>/inventory"><div class="key"><?php echo T_("Manage inventory"); ?></div><div class="go"></div></a></li>
      </ul>
    </nav>
  </div>
</div>
