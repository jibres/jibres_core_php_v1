<?php
$propertyList = \dash\data::propertyList();
?>

<div class="avand-xl">

  <div class="jPage" >



        <section class="jbox">
          <header><h2><?php echo T_("Share with telegram"); ?></h2></header>
          <div class="pad jboxProperty">

            <?php if(!\dash\data::telegramSetting_apikey()) { // neet to set telegram setting first?>
              <div class="msg warn2">
                <?php echo T_("You must set Telegram bot setting first") ?>
                <a class="btn link" href="<?php echo \dash\url::here(). '/setting/telegram' ?>"><?php echo T_("Click here to setup telegram setting") ?></a>
              </div>
            <?php }else{ ?>
            <form method="post" autocomplete="off">
              <img class="avatar fs40" src="<?php echo \dash\data::productDataRow_thumb() ?>">
              <h2><?php echo \dash\data::productDataRow_title() ?></h2>
              <h3><?php echo \dash\data::productDataRow_sharetext() ?></h3>
              <h4><?php echo \dash\data::telegramSetting_share_text() ?></h4>

              <div class="txtRa">

                <button class="btn master mT10" ><?php echo T_("Send"); ?></button>
              </div>
            </form>
          <?php } //endif ?>
          </div>
      </section>

  </div>
</div>














