<section class="f" data-option='menu-edit-title'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Change menu title");?></h3>
      <div class="body">
          <div class="txtB"><?php echo \dash\data::menuDetail_title() ?></div>
      </div>
    </div>
  </div>
  <div class="c4 s12">
      <div class="action">
        <a class="btn master" href="<?php echo \dash\url::that(). '/edit'. \dash\request::full_get() ?>"><?php echo T_("Edit menu title") ?></a>
      </div>
  </div>
</section>




<section class="f" data-option='menu-remove'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Remove menu");?></h3>
      <div class="body">
            <?php if(\dash\data::usageList()) {?>
            <p><?php echo T_("Usage menu list") ?></p>
            <?php foreach (\dash\data::usageList() as $key => $value) {?>
              <a href="<?php echo \dash\url::this(). a($value, 'link'); ?>" class="badge pA20 fs11"><?php echo a($value, 'title') ?></a>
            <?php } //endforeach ?>
          <?php }else{ ?>
            <p class="mT20">
              <?php echo T_("This menu not use anywhere. You can remove it") ?>
            </p>
          <?php }//endif ?>

      </div>
    </div>
  </div>
  <div class="c4 s12">
      <div class="action">
        <div data-confirm data-data='{"remove": "remove"}' class="btn danger"><?php echo T_("Remove") ?></div>
      </div>
  </div>
</section>

