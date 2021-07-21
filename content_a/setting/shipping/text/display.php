<div class="avand-md">
  <form method="post" autocomplete="off">
    <div class="box">
      <div class="pad">
        <p><?php echo T_("If you want to show a message to all customers on the shopping shipping page, write it here. You can also adjust the color of this text. <br> After setting this text, you will see a sample of it at the bottom of this page");?></p>
        <label for="color"><?php echo T_("Message Type"); ?></label>
        <div>
          <select class="select22" name="color">
            <option value="0"><?php echo T_("Default"); ?></option>
            <option value="red" <?php if(\dash\data::shippingSettingSaved_color() === 'red') {echo 'selected';} ?>><?php echo T_("Red (For important warning message)") ?></option>
            <option value="green" <?php if(\dash\data::shippingSettingSaved_color() === 'green') {echo 'selected';} ?>><?php echo T_("Green (For thank you message)") ?></option>
            <option value="blue" <?php if(\dash\data::shippingSettingSaved_color() === 'blue') {echo 'selected';} ?>><?php echo T_("Blue (For information message)") ?></option>
            <option value="yellow" <?php if(\dash\data::shippingSettingSaved_color() === 'yellow') {echo 'selected';} ?>><?php echo T_("Yellow (For warning message)") ?></option>
          </select>
        </div>
        <label for="page_text"><?php echo T_("Text"); ?></label>
        <textarea name="page_text" id="page_text" class="txt" rows="5"><?php echo \dash\data::shippingSettingSaved_page_text(); ?></textarea>
      </div>
      <footer class="txtRa">
        <button  class="btn success" ><?php echo T_("Save"); ?></button>
      </footer>
    </div>
  </form>
</div>