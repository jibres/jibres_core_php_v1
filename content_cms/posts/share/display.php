<?php require_once(root. 'content_cms/posts/postDetail.php'); ?>
<?php
$propertyList = \dash\data::propertyList();
?>


<div class="avand-sm">
  <div class="box">
    <div class="pad">
    <?php if(!\dash\data::telegramSetting_apikey()) { // neet to set telegram setting first?>
      <div class="alert-warning mB0">
        <?php echo T_("You must set Telegram bot setting first") ?> <a class="link" href="<?php echo \dash\url::here(). '/setting/telegram' ?>"><?php echo T_("Click here to setup telegram setting") ?></a>
      </div>
    <?php }else{ ?>
      <form method="post" autocomplete="off" id='form1'>
        <img class="" src="<?php echo \dash\data::dataRow_thumb() ?>">
        <div class="msg">
          <p><?php echo \dash\data::dataRow_title() ?></p>
          <p><?php echo \dash\data::dataRow_excerpt(); ?></p>
          <textarea class="txt" name="sharetext"  rows="6" maxlength="2000" placeholder='<?php echo T_("Share text"); ?>'></textarea>
          <p><?php echo \dash\data::telegramSetting_share_text() ?></p>
          <?php echo \dash\app\telegram\post::get_tags_html(\dash\data::dataRow_tags()); ?>
        </div>

        <?php $social = \lib\store::social(); ?>
        <?php if(a($social, 'telegram')) {?>
          <footer>
            <a class="btn block mB5" target="_blank" href='<?php echo a($social, 'telegram', 'link'); ?>'><?php echo T_("View"); ?></a>
          </footer>
        <?php } //endif ?>
        <footer class="row">

          <?php $telegrambtn = a(\dash\data::telegramSetting(), 'telegrambtn'); ?>

          <?php if(empty($social) || !$telegrambtn) {?>
            <a class="link" href="<?php echo \dash\url::here() ?>/setting/social"><?php echo T_("Manage your social network"); ?></a>
          <?php }else{ ?>
            <?php foreach ($social as $key => $value) {?>
              <?php if(a($social, $key) && a($telegrambtn, $key)) {?>
                <div class="c"><a class="btn block mB5" target="_blank" href="<?php echo a($social, 'instagram', 'link'); ?>"><?php echo a($value, 'title'); ?></a></div>
              <?php } //endif ?>

            <?php } //endfor ?>
          <?php } //endif ?>

          <div class="c"><a class="btn block mB5" target="_blank" href="<?php echo \lib\store::url(); ?>"><?php echo T_("Website"); ?></a></div>
        </footer>
      </form>
    <?php } //endif ?>
    </div>
  </div>
</div>
