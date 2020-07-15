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

                <p><?php echo \dash\data::productDataRow_sharetext() ?></p>
                <p><?php echo \dash\data::telegramSetting_share_text() ?></p>
              </div>

              <footer>
                <a class="btn block mB5" href='https://t.me/BittyAdmin'><?php echo T_("Register a new order"); ?></a>
               </footer>
              <footer class="row padLess">
                <div class="c"><a class="btn block mB5" href="https://instagram.com/BittyStyle"><?php echo T_("Instagram"); ?></a></div>
                <div class="c"><a class="btn block mB5" href="https://twitter.com/BittyStyle"><?php echo T_("Twitter"); ?></a></div>
                <div class="c"><a class="btn block mB5" href="https://bitty.ir/p/"><?php echo T_("Website"); ?></a></div>
              </footer>
            </form>
          <?php } //endif ?>
          </div>
      </section>

  </div>
</div>














