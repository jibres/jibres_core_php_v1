<div class="avand-sm">
  <form method="post" autocomplete="off" id='aThirdParty'>
    <div  class="box">
      <div class="f algin-center txtC">
        <div class="c3"></div>
          <img class="c6" src="<?php echo \dash\url::cdn(); ?>/img/logo/social/twitter.svg" alt='Twitter'>
        <div class="c3"></div>
      </div>
      <div class="body">
        <div class="msg">
          <p><?php echo T_("Enter your account username in twitter.") ?></p>
        </div>
          <div class="input ltr">
            <input type="text" name="twitter" id="twitter" maxlength="50" value="<?php echo \lib\store::social('twitter', true); ?>">
          </div>
      </div>
        <footer class="txtRa">
          <button  class="btn success" ><?php echo T_("Save"); ?></div>
        </footer>
      </div>
   </form>
</div>
