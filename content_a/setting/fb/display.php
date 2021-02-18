<div class="avand-sm">
  <form method="post" autocomplete="off" id='aThirdParty'>
    <div  class="box">
      <img class="block" src="<?php echo \dash\url::cdn(); ?>/img/logo/social/facebook-banner.png" alt='Facebook'>
      <div class="body">
        <div class="msg">
          <p><?php echo T_("Enter your account username in facebook.") ?></p>
        </div>
          <div class="input ltr">
            <input type="text" name="facebook" id="facebook" maxlength="50" value="<?php echo \lib\store::social('facebook', true); ?>">
          </div>
      </div>
        <footer class="txtRa">
          <button  class="btn success" ><?php echo T_("Save"); ?></div>
        </footer>
      </div>
   </form>
</div>
