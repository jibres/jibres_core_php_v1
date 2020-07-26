
  <?php if(\dash\url::child() == 'edit') {?>
    <nav class="items long mT20">
      <ul>
        <?php if(!\dash\data::productFamily()) {?>
          <?php if(\dash\get::index(\dash\data::productSettingSaved(), 'variant_product')) {?>
            <li>
              <a class="f" href="<?php echo \dash\url::this(); ?>/variants?id=<?php echo \dash\get::index($productDataRow,'id'); ?>">
                <div class="key"><i class="sf-picture"></i><?php echo T_("Make product variants"); ?></div>
                <div class="go"></div>
              </a>
            </li>
          <?php } //endif ?>
        <?php } //endif ?>
      </ul>
    </nav>

    <nav class="items long">
      <ul>
        <?php if(\dash\detect\device::detectPWA()) {?>
          <li>
            <a class="item f" href="<?php echo \dash\url::this().'/desc?id='. \dash\request::get('id'); ?>">
              <div class="key"><i class="sf-list"></i><?php echo T_("Edit Description") ?></div>
              <div class="go"></div>
            </a>
          </li>
        <?php } //endif ?>
        <li>
          <a class="f" href="<?php echo \dash\url::this(); ?>/property?id=<?php echo \dash\get::index($productDataRow,'id'); ?>">
            <div class="key"><i class="sf-database"></i><?php echo T_("Product Properties"); ?></div>
            <div class="go"></div>
          </a>
        </li>
        <li>
          <a class="f" href="<?php echo \dash\url::this(); ?>/shipping?id=<?php echo \dash\get::index($productDataRow,'id'); ?>">
            <div class="key"><i class="sf-flight"></i><?php echo T_("Shipping"); ?></div>
            <div class="value"><?php echo \dash\get::index($productDataRow,'weight'); ?> <?php echo \dash\get::index($storData,'mass_detail','name'); ?></div>
            <div class="go"></div>
          </a>
        </li>
        <?php if(!$have_variant_child) {?>
        <li>
          <a class="f" href="<?php echo \dash\url::this(); ?>/inventory?id=<?php echo \dash\get::index($productDataRow,'id'); ?>">
            <?php if(\dash\data::productDataRow_trackquantity()) {?>
            <div class="key"><i class="sf-exchange fc-green"></i><?php echo T_("Inventory"); ?></div>
            <div class="value"><?php echo \dash\fit::number(floatval(\dash\data::productDataRow_stock())); ?></div>
            <?php }else{ ?>
            <div class="key"><i class="sf-exchange fc-red"></i><?php echo T_("Inventory"); ?></div>
            <div class="value"><?php echo T_("Not tracking"); ?></div>
            <?php } //endif ?>
            <div class="go"></div>
          </a>
        </li>
        <?php } ?>
        <li>
          <a class="f" href="<?php echo \dash\url::this(); ?>/organization?id=<?php echo \dash\get::index($productDataRow,'id'); ?>">
            <div class="key"><i class="sf-package"></i><?php echo T_("Organization"); ?></div>
            <div class="go"><?php echo T_("Type, vendor, tags"); ?></div>
          </a>
        </li>
        <?php if(!$have_variant_child) {?>
        <li>
          <a class="f" href="<?php echo \dash\url::this(); ?>/cartlimit?id=<?php echo \dash\request::get('id'); ?>">
            <div class="key"><i class="sf-hand-stop"></i><?php echo T_("Cart Limit"); ?></div>
            <div class="go"></div>
          </a>
        </li>
        <?php } //endif ?>
        <li>
          <a class="f" href="<?php echo \dash\url::this(); ?>/status?id=<?php echo \dash\request::get('id'); ?>">
            <div class="key"><i class="sf-plug"></i><?php echo T_("Status"); ?></div>
            <div class="value"><?php echo T_(\dash\data::productDataRow_status()); ?></div>
            <div class="go"></div>
          </a>
        </li>
      </ul>
    </nav>

    <nav class="items long">
      <ul>
        <li>
          <a class="f" href="<?php echo \dash\url::this(); ?>/comment?id=<?php echo \dash\request::get('id'); ?>">
            <div class="key"><i class="sf-chat-alt-fill"></i><?php echo T_("Comments"); ?></div>
            <div class="go"></div>
          </a>
        </li>
          <li>
            <a class="f" href="<?php echo \dash\url::here(); ?>/pricehistory?id=<?php echo \dash\request::get('id'); ?>">
              <div class="key"><i class="sf-line-chart"></i><?php echo T_("Price change chart"); ?></div>
              <div class="go"></div>
            </a>
          </li>
      </ul>
    </nav>




    <nav class="items long">
      <ul>
          <li>
            <a class="f fc-fb" href="<?php echo \dash\url::this(); ?>/share?id=<?php echo \dash\request::get('id'); ?>">
              <div class="key"><i class="sf-thumbs-o-up fc-fb"></i><?php echo T_("Smart Share"); ?></div>
              <div class="go fc-fb"></div>
            </a>
          </li>
      </ul>
    </nav>

    <?php if($have_variant_child || \dash\data::productFamily()) {?>
      <nav class="items long">
        <ul>
          <?php if(isset($productDataRow['parentDetail']['id']) && $productDataRow['parentDetail']['id'] != \dash\request::get('id') ) {?>
            <li><a class="f" href="<?php echo \dash\url::that(); ?>?id=<?php echo $productDataRow['parentDetail']['id']; ?>"><div class="key"><i class="sf-atom"></i><?php echo $productDataRow['parentDetail']['title']; ?></div><div class="go"></div></a></li>
          <?php } //endif ?>
          <?php if($have_variant_child) {?>
            <?php foreach (\dash\data::productDataRow_child() as $key => $value) {?>
              <li>
                <a class="f" href="<?php echo \dash\url::that(); ?>?id=<?php echo \dash\get::index($value, 'id'); ?>">
                  <div class="key">
                    <small class="fc-mute"><?php echo \dash\get::index($value, 'optionname1'); ?></small> <b class="fc-red"><?php echo \dash\get::index($value, 'optionvalue1'); ?></b>
                    <small class="fc-mute"><?php echo \dash\get::index($value, 'optionname2'); ?></small> <b class="fc-green"><?php echo \dash\get::index($value, 'optionvalue2'); ?></b>
                    <small class="fc-mute"><?php echo \dash\get::index($value, 'optionname3'); ?></small> <b class="fc-blue"><?php echo \dash\get::index($value, 'optionvalue3'); ?></b>
                  </div>
                  <div class="go"><?php echo \dash\fit::number(\dash\get::index($value, 'stock')); ?></div>
                </a>
              </li>
            <?php } //endfor ?>
          <?php }elseif(\dash\data::productFamily()) {?>
            <?php foreach (\dash\data::productFamily() as $key => $value) {?>
              <li>
                <a class="f" href="<?php echo \dash\url::that(); ?>?id=<?php echo \dash\get::index($value, 'id'); ?>">
                  <div class="key">
                    <?php if(\dash\get::index($value, 'id') === \dash\request::get('id')) {?><i class="sf-edit mRa5"></i><?php } //endif ?>
                    <small class="fc-mute"><?php echo \dash\get::index($value, 'optionname1'); ?></small> <b class="fc-red"><?php echo \dash\get::index($value, 'optionvalue1'); ?></b>
                    <small class="fc-mute"><?php echo \dash\get::index($value, 'optionname2'); ?></small> <b class="fc-green"><?php echo \dash\get::index($value, 'optionvalue2'); ?></b>
                    <small class="fc-mute"><?php echo \dash\get::index($value, 'optionname3'); ?></small> <b class="fc-blue"><?php echo \dash\get::index($value, 'optionvalue3'); ?></b>
                  </div>
                  <div class="go"><?php echo \dash\fit::number(\dash\get::index($value, 'stock')); ?></div>
                </a>
              </li>
              <?php if(\dash\request::get('id') == $value['id']) {?><?php }else{ ?><?php } //endif ?>
            <?php }//endfor ?>
          <?php }//endif ?>
        </ul>
      </nav>
    <?php } //endif ?>
  <?php } //endif ?>

