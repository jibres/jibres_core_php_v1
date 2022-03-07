<nav class="items">
  <ul>
    <li>
      <a class="f item" href="<?php echo \dash\url::this(). '/detail?id='. \dash\request::get('id'); ?>">
        <?php echo \dash\utility\icon::bootstrap('box'); ?>
        <i class="sf-thumbnails"></i>
        <div class="key"><?php echo T_("Glance"); ?></div>
        <div class="go"></div>
      </a>
    </li>
  </ul>
</nav>

<nav class="items">
  <ul>
    <li>
      <a class="f item" href="<?php echo \dash\url::here(). '/chap/a4?id='. \dash\request::get('id'); ?>&model=portrait">
        <?php echo \dash\utility\icon::bootstrap('printer'); ?>
        <div class="key"><?php echo T_("Print"). ' '. ('A4');?></div>
        <div class="go"></div>
      </a>
    </li>
    <li>
      <a class="f item" href="<?php echo \dash\url::here(). '/chap/a4?id='. \dash\request::get('id'); ?>&model=landscape">
        <i class="sf-print"></i>
        <?php echo \dash\utility\icon::bootstrap('printer'); ?>
        <div class="key"><?php echo T_("Print"). ' '. ('A4'). ' - '. T_('Landscape');?></div>
        <div class="go"></div>
      </a>
    </li>
    <li>
      <a class="f item" href="<?php echo \dash\url::here(). '/chap/a5?id='. \dash\request::get('id'); ?>&model=portrait">
        <?php echo \dash\utility\icon::bootstrap('printer'); ?>
        <div class="key"><?php echo T_("Print"). ' '. ('A5');?></div>
        <div class="go"></div>
      </a>
    </li>
    <li>
      <a class="f item" href="<?php echo \dash\url::here(). '/chap/receipt?id='. \dash\request::get('id'); ?>">
        <?php echo \dash\utility\icon::bootstrap('Receipt cutoff'); ?>
        <div class="key"><?php echo T_("Print"). ' '. T_('Receipt');?></div>
        <div class="go"></div>
      </a>
    </li>
    <?php if(a(\dash\data::orderDetail(), 'factor', 'customer')) {?>
    <li>
      <a class="f item" href="<?php echo \dash\url::this(). '/shippinglabel?id='. \dash\request::get('id'); ?>">
        <?php echo \dash\utility\icon::svg('label printer'); ?>
        <div class="key"><?php echo T_("Print"). ' '. T_('Shipping Label');?></div>
        <div class="go"></div>
      </a>
    </li>
  <?php } //endif ?>
  </ul>
</nav>

<nav class="items">
  <ul>
    <li>
      <a class="f item" href="<?php echo \dash\url::this(). '/products?id='. \dash\request::get('id'); ?>">
        <?php echo \dash\utility\icon::bootstrap('pen'); ?>
        <div class="key"><?php echo T_("Edit products"); ?></div>
        <div class="go"></div>
      </a>
      </li>
    <li>
      <a class="f item" href="<?php echo \dash\url::this(). '/comment?id='. \dash\request::get('id'); ?>">
        <?php echo \dash\utility\icon::bootstrap('chat'); ?>
        <div class="key"><?php echo T_("Activity & comment"); ?></div>
        <div class="go"></div>
      </a>
      </li>
    <li>
      <a class="f item" href="<?php echo \dash\url::this(). '/address?id='. \dash\request::get('id'); ?>">
        <?php echo \dash\utility\icon::bootstrap('person-bounding-box'); ?>
        <div class="key"><?php echo T_("Customer & Address"); ?></div>
        <div class="go"></div>
      </a>
      </li>
    <li>
      <a class="f item" href="<?php echo \dash\url::this(). '/status?id='. \dash\request::get('id'); ?>">
        <?php echo \dash\utility\icon::bootstrap('truck'); ?>
        <div class="key"><?php echo T_("Order status"); ?></div>
        <div class="go"></div>
      </a>
      </li>
  </ul>
</nav>


<nav class="items">
  <ul>
    <?php if(a(\dash\data::orderDetail(), 'factor', 'total')) {?>
    <li>
      <a class="f item" href="<?php echo \dash\url::this(). '/discount?id='. \dash\request::get('id'); ?>">
        <i class="sf-money-banknote"></i>
        <div class="key"><?php echo T_("Total"); ?></div>
        <div class="value">
          <span class="fc-blue font-bold"><?php echo \dash\fit::number(a(\dash\data::orderDetail(), 'factor', 'total')); ?></span>
          <small class="fc-mute"><?php echo \lib\store::currency() ?></small>
        </div>
      </a>
    </li>
  <?php } //endif ?>


  </ul>
</nav>