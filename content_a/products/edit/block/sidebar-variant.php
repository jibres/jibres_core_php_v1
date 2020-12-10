
    <?php if($have_variant_child || \dash\data::productFamily()) {?>
      <nav class="items long">
        <ul>
          <?php if(isset($productDataRow['parentDetail']['id']) && $productDataRow['parentDetail']['id'] != \dash\request::get('id') ) {?>
            <li>
              <a class="item f" href="<?php echo \dash\url::that(); ?>?id=<?php echo $productDataRow['parentDetail']['id']; ?>">
                <i class="sf-atom"></i>
                <div class="key"><?php echo $productDataRow['parentDetail']['title']; ?></div>
                <div class="go"></div>
              </a>
            </li>
          <?php } //endif ?>
          <?php if($have_variant_child) {?>
            <?php foreach (\dash\data::productDataRow_child() as $key => $value) {?>
              <li>
                <a class="item f" href="<?php echo \dash\url::that(); ?>?id=<?php echo a($value, 'id'); ?>">
                  <div class="key">
                    <small class="fc-mute"><?php echo a($value, 'optionname1'); ?></small> <b class="fc-blank"><?php echo a($value, 'optionvalue1'); ?></b>
                    <small class="fc-mute"><?php echo a($value, 'optionname2'); ?></small> <b class="fc-blank"><?php echo a($value, 'optionvalue2'); ?></b>
                    <small class="fc-mute"><?php echo a($value, 'optionname3'); ?></small> <b class="fc-blank"><?php echo a($value, 'optionvalue3'); ?></b>
                  </div>
                  <div class="go"><?php echo \dash\fit::number(a($value, 'stock')); ?></div>
                </a>
              </li>
            <?php } //endfor ?>
          <?php }elseif(\dash\data::productFamily()) {?>
            <?php foreach (\dash\data::productFamily() as $key => $value) {?>
              <li>
                <a class="item f" href="<?php echo \dash\url::that(); ?>?id=<?php echo a($value, 'id'); ?>">
                    <?php if(a($value, 'id') === \dash\request::get('id')) {?><i class="sf-edit mRa5"></i><?php } //endif ?>
                  <div class="key">
                    <small class="fc-mute"><?php echo a($value, 'optionname1'); ?></small> <b class="fc-blank"><?php echo a($value, 'optionvalue1'); ?></b>
                    <small class="fc-mute"><?php echo a($value, 'optionname2'); ?></small> <b class="fc-blank"><?php echo a($value, 'optionvalue2'); ?></b>
                    <small class="fc-mute"><?php echo a($value, 'optionname3'); ?></small> <b class="fc-blank"><?php echo a($value, 'optionvalue3'); ?></b>
                  </div>
                  <div class="go"><?php echo \dash\fit::number(a($value, 'stock')); ?></div>
                </a>
              </li>
              <?php if(\dash\request::get('id') == $value['id']) {?><?php }else{ ?><?php } //endif ?>
            <?php }//endfor ?>
          <?php }//endif ?>
        </ul>
      </nav>
    <?php } //endif ?>

    <?php require_once('sidebar-menu.php'); ?>