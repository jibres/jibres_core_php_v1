<div class="avand-sm zero">
  <h2><?php echo T_("Analytics"); ?></h2>
  <nav class="items mB25-f">
    <ul>
      <li>
        <a class="f" href="<?php echo \dash\url::that(); ?>/gtag">
          <img src="<?php echo \dash\url::cdn(); ?>/img/thirdparty/google_analytics.svg" alt='Google Analytics'>
          <div class="key"><?php echo T_("Google Analytics"); ?></div>
          <div class="go"></div>
        </a>
      </li>
    </ul>
  </nav>

    <h2><?php echo T_("Cloud Storage S3"); ?></h2>
  <nav class="items mB25-f">
    <ul>
      <li>
        <a class="f" href="<?php echo \dash\url::that(); ?>/awss3">
          <img src="<?php echo \dash\url::cdn(); ?>/img/thirdparty/aws.svg" alt='AWS'>
          <div class="key"><?php echo T_("Amazon"); ?></div>
          <div class="go"></div>
        </a>
      </li>
      <li>
        <a class="f" href="<?php echo \dash\url::that(); ?>/digitaloceans3">
          <img src="<?php echo \dash\url::cdn(); ?>/img/thirdparty/digitalocean.svg" alt='digitalocean'>
          <div class="key"><?php echo T_("DigitalOcean"); ?></div>
          <div class="go"></div>
        </a>
      </li>
       <li>
        <a class="f" href="<?php echo \dash\url::that(); ?>/arvanclouds3">
          <img src="<?php echo \dash\url::cdn(); ?>/img/thirdparty/arvancloud.svg" alt='ArvanCloud'>
          <div class="key"><?php echo T_("ArvanCloud"); ?></div>
          <div class="go"></div>
        </a>
      </li>
    </ul>
  </nav>


  <h2><?php echo T_("Live Chat"); ?></h2>
  <nav class="items mB25-f">
    <ul>
      <li>
        <a class="f" href="<?php echo \dash\url::that(); ?>/tawk">
          <img src="<?php echo \dash\url::cdn(); ?>/img/thirdparty/tawk.png" alt='tawk.to'>
          <div class="key"><?php echo T_("tawk.to - 100% FREE live chat!"); ?></div>
          <div class="go"></div>
        </a>
      </li>
<?php if (\dash\language::current() === 'fa') { ?>
      <li>
        <a class="f" href="<?php echo \dash\url::that(); ?>/raychat">
          <img src="<?php echo \dash\url::cdn(); ?>/img/thirdparty/raychat.jpg" alt='RayChat'>
          <div class="key"><?php echo T_("RayChat - Online Chat Platform"); ?></div>
          <div class="go"></div>
        </a>
      </li>
<?php } ?>
      <li>
        <a class="f" href="<?php echo \dash\url::that(); ?>/imber">
          <img src="<?php echo \dash\url::cdn(); ?>/img/thirdparty/imber.png" alt='Imber'>
          <div class="key"><?php echo T_("Imber - All in One Marketing Automation Platform"); ?></div>
          <div class="go"></div>
        </a>
      </li>
    </ul>
  </nav>


<?php if (\dash\language::current() === 'fa') { ?>
  <h2><?php echo T_("Certificates"); ?></h2>
  <nav class="items mB25-f">
    <ul>
      <li>
        <a class="f" href="<?php echo \dash\url::that(); ?>/enamad">
          <img src="<?php echo \dash\url::cdn(); ?>/img/thirdparty/enamad.jpg" alt='Enamad'>
          <div class="key"><?php echo T_("Enamad"); ?></div>
          <div class="go"></div>
        </a>
      </li>
      <li>
        <a class="f" href="<?php echo \dash\url::that(); ?>/samandehi">
          <img src="<?php echo \dash\url::cdn(); ?>/img/thirdparty/samandehi.jpg" alt='Samandehi'>
          <div class="key"><?php echo T_("Samandehi"); ?></div>
          <div class="go"></div>
        </a>
      </li>
    </ul>
  </nav>
<?php } ?>
<?php if (\dash\language::current() === 'fa') { ?>
  <h2><?php echo T_("Search engine"); ?></h2>
  <nav class="items mB25-f">
    <ul>
      <li>
        <a class="f" href="<?php echo \dash\url::that(); ?>/torob">
          <img src="<?php echo \dash\url::cdn(); ?>/img/thirdparty/torob-logo.svg" alt='Torob'>
          <div class="key"><?php echo T_("Torob"); ?></div>
          <div class="go"></div>
        </a>
      </li>
    </ul>
  </nav>
<?php } ?>
<?php if (\dash\language::current() === 'fa') { ?>
  <h2><?php echo T_("Advertise"); ?></h2>
  <nav class="items mB25-f">
    <ul>
      <li>
        <a class="f" href="<?php echo \dash\url::that(); ?>/mediaad">
          <img src="<?php echo \dash\url::cdn(); ?>/img/thirdparty/mediaad-icon.svg" alt='Samandehi'>
          <div class="key"><?php echo T_("Media.ad"); ?></div>
          <div class="go"></div>
        </a>
      </li>
    </ul>
  </nav>
<?php } ?>
  <h2><?php echo T_("Bank payment"); ?></h2>
  <nav class="items mB25-f">
    <ul>
      <li>
        <a class="f" href="<?php echo \dash\url::that(); ?>/irmellat">
          <img src="<?php echo \dash\url::cdn(); ?>/img/thirdparty/bank/mellat-logo.svg" alt='Mellat'>
          <div class="key"><?php echo T_("Mellat"); ?></div>
          <div class="go"></div>
        </a>
      </li>
      <li>
        <a class="f" href="<?php echo \dash\url::that(); ?>/irirkish">
          <img src="<?php echo \dash\url::cdn(); ?>/img/thirdparty/bank/irkish.jpg" alt='Irkish'>
          <div class="key"><?php echo T_("IranKish"); ?></div>
          <div class="go"></div>
        </a>
      </li>
      <li>
        <a class="f" href="<?php echo \dash\url::that(); ?>/irparsian">
          <img src="<?php echo \dash\url::cdn(); ?>/img/thirdparty/bank/parsian.png" alt='Parsian'>
          <div class="key"><?php echo T_("Parsian"); ?></div>
          <div class="go"></div>
        </a>
      </li>
    </ul>
  </nav>

  <h2><?php echo T_("Assistant payment"); ?></h2>
  <nav class="items mB25-f">
    <ul>
      <li>
        <a class="f" href="<?php echo \dash\url::that(); ?>/irzarinpal">
          <img src="<?php echo \dash\url::cdn(); ?>/img/thirdparty/bank/zarinpal-icon.svg" alt='ZarinPal'>
          <div class="key"><?php echo T_("Zarinpal"); ?></div>
          <div class="go"></div>
        </a>
      </li>
       <li>
        <a class="f" href="<?php echo \dash\url::that(); ?>/irasanpardakht">
          <img src="<?php echo \dash\url::cdn(); ?>/img/thirdparty/bank/asanpardasht-logo.svg" alt='Asanpardasht'>
          <div class="key"><?php echo T_("Asanpardakht"); ?></div>
          <div class="go"></div>
        </a>
      </li>
        <li>
        <a class="f" href="<?php echo \dash\url::that(); ?>/iridpay">
          <img src="<?php echo \dash\url::cdn(); ?>/img/thirdparty/bank/idpay-icon.png" alt='IDpay'>
          <div class="key"><?php echo T_("IDPay"); ?></div>
          <div class="go"></div>
        </a>
      </li>
      <li>
        <a class="f" href="<?php echo \dash\url::that(); ?>/irpayir">
          <i class="spay-32-payir"></i>
          <div class="key"><?php echo T_("Payir"); ?></div>
          <div class="go"></div>
        </a>
      </li>
    </ul>
  </nav>
</div>