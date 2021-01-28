<div class="avand-md">
  <form method="post" autocomplete="off">
    <div class="box">
      <div class="pad">
        <label for="mobile"><?php echo T_("Mobile") ?> <small class="fc-red">* <?php echo T_("Required") ?></small></label>
        <div class="input">
          <input type="tel" name="mobile" data-format='mobile-enter' maxlength="15">
        </div>
        <textarea name="message" class="txt mB10" rows="3" placeholder="<?php echo T_("Message text ...") ?>"></textarea>
        <div class="fc-mute ">
          <?php echo T_("After registering the SMS, your request will be placed in the sending queue and you will send it in a few minutes") ?>
        </div>
      </div>
      <footer class="txtRa">
        <button class="btn master"><?php echo T_("Send") ?></button>
      </footer>
    </div>

  </form>
</div>