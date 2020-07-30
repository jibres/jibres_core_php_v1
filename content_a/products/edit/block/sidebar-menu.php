
  <?php if(\dash\url::child() == 'edit') {?>
     <nav class="items long mT20">
      <ul>
        <?php if(\dash\detect\device::detectPWA()) {?>
          <li>
            <a class="item f" href="<?php echo \dash\url::this().'/desc?id='. \dash\request::get('id'); ?>">
              <i class="sf-list"></i>
              <div class="key"><?php echo T_("Edit Description") ?></div>
              <div class="go"></div>
            </a>
          </li>
        <?php } //endif ?>
        <li>
          <a class="item f" href="<?php echo \dash\url::this(); ?>/property?id=<?php echo \dash\get::index($productDataRow,'id'); ?>">
            <i class="sf-database"></i>
            <div class="key"><?php echo T_("Product Properties"); ?></div>
            <div class="go"></div>
          </a>
        </li>
        <li>
          <a class="item f" href="<?php echo \dash\url::this(); ?>/shipping?id=<?php echo \dash\get::index($productDataRow,'id'); ?>">
            <i class="sf-flight"></i>
            <div class="key"><?php echo T_("Shipping"); ?></div>
            <div class="value"><?php echo \dash\get::index($productDataRow,'weight'); ?> <?php echo \dash\get::index($storData,'mass_detail','name'); ?></div>
            <div class="go"></div>
          </a>
        </li>
        <?php if(!$have_variant_child) {?>
        <li>
          <a class="item f" href="<?php echo \dash\url::this(); ?>/inventory?id=<?php echo \dash\get::index($productDataRow,'id'); ?>">
            <?php if(\dash\data::productDataRow_trackquantity()) {?>
            <i class="sf-exchange fc-green"></i>
            <div class="key"><?php echo T_("Inventory"); ?></div>
            <div class="value"><?php echo \dash\fit::number(floatval(\dash\data::productDataRow_stock())); ?></div>
            <?php }else{ ?>
            <i class="sf-exchange fc-red"></i>
            <div class="key"><?php echo T_("Inventory"); ?></div>
            <div class="value"><?php echo T_("Not tracking"); ?></div>
            <?php } //endif ?>
            <div class="go"></div>
          </a>
        </li>
        <?php }else{ ?>
          <li>
          <a class="item f">
            <i class="sf-exchange fc-mute"></i>
            <div class="key"><?php echo T_("Inventory"); ?></div>
            <div class="value"><?php echo \dash\fit::number(floatval(\dash\data::productDataRow_stockallchild())); ?></div>
            <div class="go"></div>
          </a>
        </li>
        <?php } //endif ?>
        <li>
          <a class="item f" href="<?php echo \dash\url::this(); ?>/organization?id=<?php echo \dash\get::index($productDataRow,'id'); ?>">
            <i class="sf-package"></i>
            <div class="key"><?php echo T_("Organization"); ?></div>
            <div class="value"><?php echo T_("Type, vendor, tags"); ?></div>
            <div class="go"></div>
          </a>
        </li>
        <?php if(!$have_variant_child) {?>
        <li>
          <a class="item f" href="<?php echo \dash\url::this(); ?>/cartlimit?id=<?php echo \dash\request::get('id'); ?>">
            <i class="sf-hand-stop"></i>
            <div class="key"><?php echo T_("Cart Limit"); ?></div>
            <div class="go"></div>
          </a>
        </li>
        <?php } //endif ?>
        <li>
          <a class="item f" href="<?php echo \dash\url::this(); ?>/status?id=<?php echo \dash\request::get('id'); ?>">
            <i class="sf-plug"></i>
            <div class="key"><?php echo T_("Status"); ?></div>
            <div class="value"><?php echo T_(\dash\data::productDataRow_status()); ?></div>
            <div class="go"></div>
          </a>
        </li>
      </ul>
    </nav>

    <nav class="items long">
      <ul>
        <li>
          <a class="item f" href="<?php echo \dash\url::this(); ?>/comment?id=<?php echo \dash\request::get('id'); ?>">
            <i class="sf-chat-alt-fill"></i>
            <div class="key"><?php echo T_("Comments"); ?></div>
            <div class="go"></div>
          </a>
        </li>
          <li>
            <a class="item f" href="<?php echo \dash\url::here(); ?>/pricehistory?id=<?php echo \dash\request::get('id'); ?>">
              <i class="sf-line-chart"></i>
              <div class="key"><?php echo T_("Price change chart"); ?></div>
              <div class="go"></div>
            </a>
          </li>
      </ul>
    </nav>




    <nav class="items long">
      <ul>
          <li>
            <a class="item f" href="<?php echo \dash\url::this(); ?>/share?id=<?php echo \dash\request::get('id'); ?>">
              <i class="sf-thumbs-o-up fc-fb"></i>
              <div class="key"><?php echo T_("Smart Share"); ?></div>
              <div class="go fc-fb"></div>
            </a>
          </li>
      </ul>
    </nav>

    <?php require_once('sidebar-variant.php'); ?>


  <?php } //endif ?>

