<?php
$propertyList = \dash\data::propertyList();

require_once(root. 'content_a/products/productName.php');
?>


<div class="avand-sm">



  <div class="jPage">



    <section class="jbox">
      <div class="pad jboxProperty">

        <?php if(!\dash\data::telegramSetting_apikey()) { // neet to set telegram setting first?>
          <div class="alert-warning">
            <?php echo T_("You must set Telegram bot setting first") ?>
            <a class="btn-link" href="<?php echo \dash\url::here(). '/setting/telegram' ?>"><?php echo T_("Click here to setup telegram setting") ?></a>
          </div>
        <?php }else{ ?>
          <form method="post" autocomplete="off" id='form1'>
            <img class="" src="<?php echo \dash\data::productDataRow_thumb() ?>">
            <div class="alert2">
              <p><?php echo \dash\data::productDataRow_title() ?></p>
              <p><?php echo \dash\data::productDataRow_title2() ?></p>

              <p><?php
              echo T_("Price");
              echo ' <code>'. \dash\fit::price_old(\dash\data::productDataRow_finalprice(), true). '</code> ';
              echo \lib\store::currency();
              ?></p>
<?php
if(\dash\data::propStr())
{
  echo '<p>'. nl2br(\dash\data::propStr()). '</p>';
}
?>

              <textarea class="txt mb-2" name="sharetext"  rows="6" maxlength="2000" placeholder='<?php echo T_("Share text"); ?>'><?php echo a(\dash\data::productDataRow(),'sharetext'); ?></textarea>

              <p><?php echo nl2br(strval(\dash\data::telegramSetting_share_text())); ?></p>

<?php
if(\dash\data::catStr())
{
  echo '<p class="fc-blue">'. \dash\data::catStr(). '</p>';
}
?>
            </div>
            <?php $social = \lib\store::social(); ?>
            <?php if(a($social, 'telegram')) {?>
              <footer>
                <a class="btn block mB5" target="_blank" href='<?php echo a($social, 'telegram', 'link'); ?>'><?php echo T_("Register a new order"); ?></a>
              </footer>
            <?php } //endif ?>

          </form>
        <?php } //endif ?>
      </div>
    </section>

  </div>
</div>
