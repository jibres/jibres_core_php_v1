

<div class="avand-sm">

    <form method="post" class="box" autocomplete="off" >
      <?php if(\dash\data::dataRow()) {?>
        <header><h2><?php echo T_("Edit slider page") ?></h2></header>
      <?php }else{ ?>
        <header><h2><?php echo T_("Add slider page") ?></h2></header>
      <?php } //endif ?>


      <img src="<?php echo \dash\data::dataRow_image() ?>" alt='<?php echo \dash\data::dataRow_alt() ?>'>

      <div class="body">
        <div class="input ">
          <input type="file" name='image' accept="image/gif, image/jpeg, image/png" id="image1" >
          <label for="image1"></label>
        </div>

        <label for="alt"><?php echo T_("Image Alt"); ?></label>
        <div class="input">
          <input type="text" name="alt" id="alt" value="<?php echo \dash\data::dataRow_alt() ?>"  >
        </div>


        <label for="url"><?php echo T_("Url"); ?></label>
        <div class="input ltr">
          <input type="text" name="url" id="url" value="<?php echo \dash\data::dataRow_url() ?>"  >
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
              <div data-confirm data-data='{"remove": "slider"}' class="btn outline danger"><?php echo T_("Remove"); ?></div>
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

    </form>


</div>