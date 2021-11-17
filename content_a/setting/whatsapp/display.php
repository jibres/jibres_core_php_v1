<div class="avand-sm">
  <form method="post" autocomplete="off">
    <div  class="box">

      <img src="<?php echo \dash\url::cdn(); ?>/img/logo/social/whatsapp-banner.jpg" alt='WhatsApp'>
      <div class="body">
        <div class="msg">
          <p><?php echo T_("Enter your account mobile in whatsapp.") ?></p>
        </div>
          <div class="input ltr">
            <input type="text" name="whatsapp" id="whatsapp" maxlength="50" value="<?php echo \lib\store::social('whatsapp', true); ?>">
          </div>
      </div>
        <footer class="txtRa">
          <button  class="btn-success" ><?php echo T_("Save"); ?></div>
        </footer>
      </div>
   </form>
</div>
