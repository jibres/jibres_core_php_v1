<?php
$storeData = \dash\data::store_store_data();
?>

<div class="hide">
  <div id="urlthat"><?php echo \dash\url::that(); ?></div>
  <div id="urlthis"><?php echo \dash\url::this(); ?></div>
  <div id="worktype"><?php echo \dash\data::myWorkDomainType(); ?></div>
  <div id="workondomain"><?php echo \dash\data::myWorkDomain(); ?></div>
  <div id="urlpwd"><?php echo \dash\url::pwd() ?></div>
</div>

<div class="avand"></div>

  <form method="post" autocomplete="off">
    <div  class="box impact mB25-f">
      <header><h2><?php echo T_("Connect store to your domain");?></h2></header>
        <div class="body">
          <p class="mB0-f">
            <?php echo T_("You can connect your store to special domain"); ?>

            <?php if(\dash\url::tld() === 'ir' || \dash\url::isLocal()) {?>
              <div class="msg success2">
                <?php echo T_("Your can buy new domain here"); ?>
                <a href="<?php echo \dash\url::sitelang(). '/my/domain'; ?>" data-direct target="_blank"><?php echo T_("Domain Center"); ?></a>
              </div>
            <?php } // endif ?>

          </p>
          <?php if(\dash\data::domainList()) {?>

            <h4><?php echo T_("Connected domain"); ?></h4>
            <div class="mB50">
            <?php foreach (\dash\data::domainList() as $key => $value) {?>
              <div class="msg primary2 align-center">
                <div class="f">

                  <div class="c txtB"><?php echo \dash\get::index($value, 'domain'); ?></div>
                  <div class="cauto">
                    <span class="btn danger" data-confirm data-data='{"remove": "domain", "id": "<?php echo \dash\get::index($value, 'id'); ?>", "domain" : "<?php echo \dash\get::index($value, 'domain'); ?>"}'><?php echo T_("Remove"); ?></span>

                </div>

                <div class="cauto">
                  <?php if(\dash\get::index($value, 'master')) {?>
                    <span class="btn success"><?php echo T_("Primary domain") ?></span>
                  <?php }else{ ?>
                    <span class="btn primary mLa5" data-confirm data-data='{"master": "master", "id": "<?php echo \dash\get::index($value, 'id'); ?>", "domain" : "<?php echo \dash\get::index($value, 'domain'); ?>"}'><?php echo T_("Set as primary"); ?></span>
                  <?php } //endif ?>

                </div>
                </div>
                <div class="">
                  <?php if(!\dash\get::index($value, 'status')) {?>
                    <span><?php echo T_("Waiting to check domain"); ?></span>
                  <?php }elseif(\dash\get::index($value, 'status') === 'ok') {?>
                    <span><?php echo T_("Domain successfully connected"); ?></span>
                  <?php }elseif(\dash\get::index($value, 'status') === 'failed') {?>
                    <span><?php echo T_("Domain connection failed"); ?></span>
                  <?php }elseif(\dash\get::index($value, 'status') === 'pending') {?>
                    <span><?php echo T_("Pending connect domain"); ?></span>
                  <?php } //endif ?>
                </div>
              </div>
            <?php }// endfor ?>
            </div>
          <?php } // endif ?>
          <?php if(\dash\data::domainList()) {?>
            <h6><?php echo T_("Connect new domain"); ?></h6>
          <?php }//endif ?>
            <label for="idomain"><?php echo T_("Domain"); ?> <span class="fc-red">*</span></label>
            <div class="input ltr">
              <input type="text" name="domain" id="idomain" <?php \dash\layout\autofocus::html() ?> required maxlength='70' minlength="1"  >
            </div>

        </div>
        <footer class="txtRa">
          <button  class="btn success" ><?php echo T_("Save"); ?></div>
        </footer>
    </div>
  </form>
</div>


