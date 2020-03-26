<div class="f justify-center">
  <div class="c8 s12 m10 x6 pA20">
    <nav class="items">
      <ul>
        <li><a class="f" href="<?php echo \dash\url::this(); ?>/general"><div class="key"><?php echo T_("Store title and logo"); ?></div><div class="go"></div></a></li>
        <li><a class="f" href="<?php echo \dash\url::this(); ?>/address"><div class="key"><?php echo T_("Set your store address"); ?></div><div class="go"></div></a></li>
        <li><a class="f" href="<?php echo \dash\url::this(); ?>/company"><div class="key"><?php echo T_("Store legal information"); ?></div><div class="go"></div></a></li>
        <li><a class="f" href="<?php echo \dash\url::this(); ?>/logo"><div class="key"><?php echo T_("Set logo of your store"); ?></div><div class="go"></div></a></li>
        <li><a class="f" href="<?php echo \dash\url::this(); ?>/payment"><div class="key"><?php echo T_("Payment channels"); ?></div><div class="go"></div></a></li>
        <li><a class="f" href="<?php echo \dash\url::this(); ?>/pos"><div class="key"><?php echo T_("Point of sale hardwares"); ?></div><div class="go"></div></a></li>
        <li><a class="f" href="<?php echo \dash\url::this(); ?>/shipping"><div class="key"><?php echo T_("Setting up shipping rates"); ?></div><div class="go"></div></a></li>
        <li><a class="f" href="<?php echo \dash\url::this(); ?>/units"><div class="key"><?php echo T_("Store Units"); ?></div><div class="go"></div></a></li>
        <li><a class="f" href="<?php echo \dash\url::this(); ?>/vat"><div class="key"><?php echo T_("Tax settings"); ?></div><div class="go"></div></a></li>
        <li><a class="f" href="<?php echo \dash\url::this(); ?>/pcpos"><div class="key"><?php echo T_("PC-POS setting"); ?></div><div class="go"></div></a></li>
      </ul>
    </nav>

    <nav class="items">
      <ul>
        <li><a class="f" href="<?php echo \dash\url::here(); ?>/android"><div class="key"><?php echo T_("Android app"); ?></div><div class="go"></div></a></li>
      </ul>
    </nav>

    <?php if(\dash\url::isLocal()) {?>
      <nav class="items">
      <ul>
        <li><a class="f" href="<?php echo \dash\url::here(); ?>/website"><div class="key"><?php echo T_("Website setting"); ?></div><div class="go"></div></a></li>
      </ul>
    </nav>
  <?php } //endif ?>
  </div>
</div>
