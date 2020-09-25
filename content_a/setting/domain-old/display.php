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


<div class="avand">
  <div class="row">
    <div class="c-xs-12 c-sm-6 c-md-6">
      <form method="post" autocomplete="off">
        <div  class="box">
          <header><h2><?php echo T_("Connect store to your domain");?></h2></header>
          <div class="body">
            <p>
              <?php echo T_("You can connect one or more domains to your business. After connecting the domains, select one of them as the primary domain.") ?>
            </p>
            <?php if(\dash\url::tld() === 'ir' || \dash\url::isLocal()) {?>
              <p>
                <?php echo T_("If you want to register new domain, Come here"); ?>
                <a href="<?php echo \dash\url::sitelang(). '/my/domain'; ?>" data-direct target="_blank"><?php echo T_("Domain Center"); ?></a>
              </p>
            <?php } // endif ?>



            <label for="idomain"><?php echo T_("Connect new domain"); ?> <span class="fc-red">*</span></label>
            <div class="input ltr">
              <input type="text" name="domain" id="idomain" <?php \dash\layout\autofocus::html() ?> required maxlength='70' minlength="1"  >
            </div>

          </div>
          <footer class="txtRa">
            <button  class="btn master" ><?php echo T_("Connect"); ?></button>
            </footer>
          </div>
        </form>
      </div>

      <div class="c-xs-12 c-sm-6 c-md-6">

        <?php if(\dash\data::domainList()) {?>

          <h4><?php echo T_("Connected domain"); ?></h4>
            <?php foreach (\dash\data::domainList() as $key => $value) {?>
              <div class="box">
                <div class="body">
                  <p class="txtB fs14 ltr">
                    <?php if(\dash\get::index($value, 'master')) {?>
                      <i class="sf-check-circle fc-green"></i>
                    <?php } //endif ?>
                    <?php echo \dash\get::index($value, 'domain'); ?>
                  </p>


                <div class="msg">
                  <?php if(!\dash\get::index($value, 'status')) {?>
                    <span> <i class="sf-question fc-mute fs14"></i> <?php echo T_("Waiting to check domain"); ?></span>
                  <?php }elseif(\dash\get::index($value, 'status') === 'ok') {?>
                    <span> <i class="sf-check fc-green fs14"></i> <?php echo T_("Domain successfully connected"); ?></span>
                  <?php }elseif(\dash\get::index($value, 'status') === 'failed') {?>
                    <span> <i class="sf-times fc-red fs14"></i> <?php echo T_("Domain connection failed"); ?></span>
                  <?php }elseif(\dash\get::index($value, 'status') === 'pending') {?>
                    <span> <i class="sf-refresh fc-blue fs14"></i> <?php echo T_("Pending connect domain"); ?></span>
                  <?php } //endif ?>
                  <p class="txtB"><?php echo \dash\get::index($value, 'message'); ?>
                    <?php if(\dash\get::index($value, 'helplink')) {?>
                      <a target="_blank" class="btn link" href="<?php echo $value['helplink']; ?>"><?php echo T_("Read more") ?></a>
                    <?php } //endif ?>
                  </p>
                </div>

                </div>
                <footer class="f">
                  <div class="cauto">
                    <span class="btn linkDel" data-confirm data-data='{"remove": "domain", "id": "<?php echo \dash\get::index($value, 'id'); ?>", "domain" : "<?php echo \dash\get::index($value, 'domain'); ?>"}'><?php echo T_("Remove"); ?></span>
                  </div>
                  <div class="c"></div>
                  <div class="cauto">
                    <?php if(\dash\get::index($value, 'master')) {?>
                      <span class="txtB btn link fc-green"><?php echo T_("Primary domain") ?></span>
                    <?php }else{ ?>
                      <span class="btn link" data-confirm data-data='{"master": "master", "id": "<?php echo \dash\get::index($value, 'id'); ?>", "domain" : "<?php echo \dash\get::index($value, 'domain'); ?>"}'><?php echo T_("Set as primary"); ?></span>

                  </div>
                    <?php } //endif ?>
                </footer>
              </div>
            <?php }// endfor ?>
          </div>
        <?php } // endif ?>
      </div>
    </div>
  </div>
</div>
