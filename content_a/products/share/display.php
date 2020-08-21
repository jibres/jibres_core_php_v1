<?php
$propertyList = \dash\data::propertyList();
?>


<div class="avand-sm">



  <div class="jPage">



    <section class="jbox">
      <div class="pad jboxProperty">

        <?php if(!\dash\data::telegramSetting_apikey()) { // neet to set telegram setting first?>
          <div class="msg warn2">
            <?php echo T_("You must set Telegram bot setting first") ?>
            <a class="btn link" href="<?php echo \dash\url::here(). '/setting/telegram' ?>"><?php echo T_("Click here to setup telegram setting") ?></a>
          </div>
        <?php }else{ ?>
          <form method="post" autocomplete="off" id='form1'>
            <img class="" src="<?php echo \dash\data::productDataRow_thumb() ?>">
            <div class="msg">
              <p><?php echo \dash\data::productDataRow_title() ?></p>
              <p><?php echo \dash\data::productDataRow_title2() ?></p>

              <p><?php
              echo T_("Price");
              echo ' <code>'. \dash\fit::price(\dash\data::productDataRow_finalprice(), true). '</code> ';
              echo \lib\store::currency();

              ?></p>

              <textarea class="txt" name="sharetext"  rows="6" maxlength="2000" placeholder='<?php echo T_("Share text"); ?>'><?php echo \dash\get::index(\dash\data::productDataRow(),'sharetext'); ?></textarea>

              <p><?php echo \dash\data::telegramSetting_share_text() ?></p>
            </div>

            <?php $social = \lib\store::social(); ?>
            <?php if(\dash\get::index($social, 'telegram')) {?>
              <footer>
                <a class="btn block mB5" target="_blank" href='<?php echo \dash\get::index($social, 'telegram', 'link'); ?>'><?php echo T_("Register a new order"); ?></a>
              </footer>
            <?php } //endif ?>
            <footer class="row">

              <?php $telegrambtn = \dash\get::index(\dash\data::telegramSetting(), 'telegrambtn'); ?>

              <?php if(empty($social) || !$telegrambtn) {?>
                <a class="btn link" href="<?php echo \dash\url::here() ?>/setting/social"><?php echo T_("Manage your social network"); ?></a>
              <?php }else{ ?>
                <?php foreach ($social as $key => $value) {?>
                  <?php if(\dash\get::index($social, $key) && \dash\get::index($telegrambtn, $key)) {?>
                    <div class="c"><a class="btn block mB5" target="_blank" href="<?php echo \dash\get::index($social, 'instagram', 'link'); ?>"><?php echo \dash\get::index($value, 'title'); ?></a></div>
                  <?php } //endif ?>

                <?php } //endfor ?>
              <?php } //endif ?>

              <div class="c"><a class="btn block mB5" target="_blank" href="<?php echo \lib\store::url(); ?>"><?php echo T_("Website"); ?></a></div>
            </footer>
          </form>
        <?php } //endif ?>
      </div>
    </section>

  </div>
</div>
