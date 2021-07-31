<div class="avand-md">
  <form method="post" autocomplete="off">
    <div class="box">
      <div class="pad">
        <p>
          <?php echo T_("If you set the price of the product to 0, the free phrase will be displayed. It is also possible to add to the shopping cart and order for products with a price of 0. <br>But if you leave the price of the product blank, the possibility of registering an order for that product will be disabled and the call button will appear instead of the purchase button. <br>You can set the title and address of the call button");?>
        </p>

        <label for="free_button_title"><?php echo T_("Button title"); ?></label>
        <div class="input">
          <input type="text" name="free_button_title" id="free_button_title" value="<?php echo \dash\data::productSettingSaved_free_button_title() ?>">
        </div>

        <label for="free_button_link"><?php echo T_("Button link"); ?></label>
        <div class="input">
          <input type="url" name="free_button_link" id="free_button_link" value="<?php echo \dash\data::productSettingSaved_free_button_link() ?>">
        </div>
      </div>

      <footer class="txtRa">
        <button  class="btn success" ><?php echo T_("Save"); ?></button>
      </footer>
    </div>
  </form>
</div>