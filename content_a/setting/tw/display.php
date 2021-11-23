<div class="avand-sm">
  <form method="post" autocomplete="off" id='aThirdParty'>
    <div  class="box">
      <div class="f algin-center text-center">
        <div class="c3"></div>
          <img class="c6" src="<?php echo \dash\url::cdn(); ?>/img/logo/social/twitter.svg" alt='Twitter'>
        <div class="c3"></div>
      </div>
      <div class="body">
        <div class="alert2">
          <p><?php echo T_("Enter your account username in twitter.") ?></p>
        </div>
          <div class="input ltr">
            <input type="text" name="twitter" id="twitter" maxlength="50" value="<?php echo \lib\store::social('twitter', true); ?>">
          </div>
      </div>
        <footer class="txtRa">
          <button  class="btn-success" ><?php echo T_("Save"); ?></button>
        </footer>
      </div>
   </form>




   <?php if(\dash\permission::supervisor() && \lib\store::social('twitter', true)) {?>
  <div  class="box">
    <div class="body">
      <div class="alert2"><?php echo T_("Connect to your twitter account.") ?></div>
        <?php if(\dash\data::twitterLastFetch()) {?>


        <div class="btn-secondary outline" data-ajaxify data-data='{"tw_action": "fetch"}' data-method='post'><?php echo T_("Fetch public posts now") ?></div>
        <?php if(\dash\data::twitterLastFetch()) {?>
          <p><?php echo T_("Last fetch"). ': '. \dash\fit::date_human(\dash\data::twitterLastFetch()) ?></p>
        <?php } //endif ?>
        <?php if(\dash\data::myTwitterPosts()) {?>
          <?php foreach (\dash\data::myTwitterPosts() as $key => $value) { ?>
            <div class="alert2"><?php echo a($value, 'title') ?></div>
          <?php } //endif ?>

        <?php }//endif ?>
        <?php } //endif ?>

    </div>
  </div>

<?php } //endif ?>
</div>
