<div class="avand-md">
  <form method="post" autocomplete="off">
    <div class="box">
      <div class="pad">
        <p>
          <?php echo T_("You can set fixed text for when load a product on your website");?>
          <br>
          <?php echo T_("You can also place a button under each product and redirect it to a page") ?>
        </p>
        <label for="view_text"><?php echo T_("Text"); ?></label>
        <textarea name="view_text" id="view_text" class="txt mB10" rows="5"><?php echo \dash\data::productSettingSaved_view_text(); ?></textarea>

        <label for="button_title"><?php echo T_("Button title"); ?></label>
        <div class="input">
          <input type="text" name="button_title" id="button_title" value="<?php echo \dash\data::productSettingSaved_button_title() ?>">
        </div>

        <label for="button_link"><?php echo T_("Button link"); ?></label>
        <div class="input">
          <input type="url" name="button_link" id="button_link" value="<?php echo \dash\data::productSettingSaved_button_link() ?>">
        </div>
      </div>

      <footer class="txtRa">
        <button  class="btn success" ><?php echo T_("Save"); ?></button>
      </footer>
    </div>
  </form>
</div>