<nav class="items">
  <ul>
    <li><a class="f item" href="<?php echo \dash\url::this(). '/detail?id='. \dash\request::get('id'); ?>"><i class="sf-thumbnails"></i><div class="key"><?php echo T_("Glance"); ?></div><div class="go"></div></a></li>
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
    <li><a class="f item" href="<?php echo \dash\url::this(). '/products?id='. \dash\request::get('id'); ?>"><i class="sf-tags"></i><div class="key"><?php echo T_("Edit products"); ?></div><div class="go"></div></a></li>
    <li><a class="f item" href="<?php echo \dash\url::this(). '/comment?id='. \dash\request::get('id'); ?>"><i class="sf-comments-o"></i><div class="key"><?php echo T_("Activity & comment"); ?></div><div class="go"></div></a></li>
    <li><a class="f item" href="<?php echo \dash\url::this(). '/address?id='. \dash\request::get('id'); ?>"><i class="sf-user"></i><div class="key"><?php echo T_("Customer & Address"); ?></div><div class="go"></div></a></li>
    <li><a class="f item" href="<?php echo \dash\url::this(). '/status?id='. \dash\request::get('id'); ?>"><i class="sf-arrows-out"></i><div class="key"><?php echo T_("Order status"); ?></div><div class="go"></div></a></li>
  </ul>
</nav>


<nav class="items">
  <ul>
    <?php if(\dash\get::index(\dash\data::orderDetail(), 'factor', 'total')) {?>
    <li>
      <a class="f item" href="<?php echo \dash\url::this(). '/discount?id='. \dash\request::get('id'); ?>">
        <i class="sf-money-banknote"></i>
        <div class="key"><?php echo T_("Total"); ?></div>
        <div class="value">
          <span class="fc-blue txtB"><?php echo \dash\fit::number(\dash\get::index(\dash\data::orderDetail(), 'factor', 'total')); ?></span>
          <small class="fc-mute"><?php echo \lib\store::currency() ?></small>
        </div>
      </a>
    </li>
  <?php } //endif ?>
  <?php if(\dash\get::index(\dash\data::orderDetail(), 'factor', 'shipping')) {?>
    <li>
      <a class="f item" href="<?php echo \dash\url::this(). '/discount?id='. \dash\request::get('id'); ?>">
        <i class="sf-exchange"></i>
        <div class="key"><?php echo T_("Shipping"); ?></div>
        <div class="value">
          <span class="fc-blue txtB"><?php echo \dash\fit::number(\dash\get::index(\dash\data::orderDetail(), 'factor', 'shipping')); ?></span>
          <small class="fc-mute"><?php echo \lib\store::currency() ?></small>
        </div>
      </a>
    </li>
  <?php } //endif ?>

  </ul>
</nav>