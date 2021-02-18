<div class="avand-sm">
  <form method="post" autocomplete="off">
    <div  class="box">

      <div class="body">
        <img src="<?php echo \dash\url::cdn(); ?>/img/logo/social/aparat-banner.svg" alt='Aparat'>
        <div class="msg">
          <p><?php echo T_("Enter your account username in aparat.") ?></p>
        </div>
          <div class="input ltr">
            <input type="text" name="aparat" id="aparat" maxlength="50" value="<?php echo \lib\store::social('aparat', true); ?>">
          </div>
      </div>
        <footer class="txtRa">
          <button  class="btn success" ><?php echo T_("Save"); ?></div>
        </footer>
      </div>
   </form>
</div>
