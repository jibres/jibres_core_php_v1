<div class="avand-sm">
  <form method="post" autocomplete="off">
    <div  class="box">

      <div class="body">
        <img src="<?php echo \dash\url::cdn(); ?>/img/logo/social/youtube-banner.png" alt='Toutube'>
        <div class="msg">
          <p><?php echo T_("Enter your account username in youtube.") ?></p>
        </div>
          <div class="input ltr">
            <input type="text" name="youtube" id="youtube" maxlength="50" value="<?php echo \lib\store::social('youtube', true); ?>">
          </div>
      </div>
        <footer class="txtRa">
          <button  class="btn success" ><?php echo T_("Save"); ?></div>
        </footer>
      </div>
   </form>
</div>
