

<div class="avand-sm">

  <form method="post" autocomplete="off" >

    <div class="box" data-uploader data-name='image' data-final='#finalImage' data-file-max-size='<?php echo \dash\data::maxFileSize() ?>' <?php echo \dash\data::ratioHtml(); ?>>
      <input type="file" accept="image/gif, image/jpeg, image/png" id="image1">
      <label for="image1"><?php echo T_('Drag &amp; Drop your files or <span class="txtB">Browse</span>'); ?></label>
      <img id='finalImage' src="<?php echo \dash\data::dataRow_image() ?>" alt='<?php echo \dash\data::dataRow_alt() ?>'>
    </div>

    <div class="box">


      <div class="body">

        <label for="alt"><?php echo T_("Title"); ?></label>
        <div class="input">
          <input type="text" name="alt" id="alt" value="<?php echo \dash\data::dataRow_alt() ?>" maxlength="200"  >
        </div>


        <label for="url"><?php echo T_("Url"); ?></label>
        <div class="input ltr">
          <input type="text" name="url" id="url" value="<?php echo \dash\data::dataRow_url() ?>" maxlength="200" >
        </div>


        <div class="switch1 mB5">
          <input type="checkbox" name="target" id="target" <?php if(\dash\data::dataRow_target()) {echo 'checked';} ?>>
          <label for="target"></label>
          <label for="target"><?php echo T_("Open in New tab"); ?><small></small></label>
        </div>


      </div>

      <footer class="txtRa">
        <?php if(\dash\data::dataRow()) {?>
          <div class="f">
            <div class="cauto">
              <div data-confirm data-data='{"remove": "specialslider"}' class="btn linkDel"><?php echo T_("Remove"); ?></div>
            </div>
            <div class="c"></div>
            <div class="cauto">
              <button class="btn primary"><?php echo T_("Edit"); ?></button>
            </div>
          </div>
        <?php }else{ ?>
          <button class="btn success"><?php echo T_("Add"); ?></button>
        <?php } //endif ?>
      </footer>

    </div>
  </form>

</div>