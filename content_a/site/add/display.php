<div class="avand-sm">
  <form method="post" autocomplete="off" id="formAddPost">
    <div class="box">
      <div class="body">

        <div class="mB10">
          <div class="input">
            <label><?php echo T_("Page Title") ?></label>
            <input type="text" name="title" id="title" placeholder='<?php echo T_("Enter Page Title"); ?> *'  <?php \dash\layout\autofocus::html() ?> required maxlength='200' minlength="1" pattern=".{1,200}">
          </div>
        </div>

        <p class="fc-mute mB0-f s0"><?php echo T_("First type main title and save as draft, then complete and publish it."); ?></p>
      </div>
<?php if(!\dash\detect\device::detectPWA()) {?>
      <footer class="txtRa">
        <button class="btn master"><?php echo T_("Add"); ?></button>
      </footer>
<?php } ?>
    </div>
  </form>
</div>
