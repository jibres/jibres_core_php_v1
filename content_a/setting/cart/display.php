<form method="post" autocomplete="off">

<div class="avand-md">

  <div  class="box impact mB25-f">
    <header><h2><?php echo T_("Set Cart Text");?></h2></header>
      <div class="body">
        <p><?php echo T_("Cart.me");?></p>
        <div class="c4 s12" method="post" autocomplete="off">
          <div class="action f">

            <div class="c12 mB5">
              <label for="color"><?php echo T_("Color"); ?></label>

              <div>
                <select class="select22" name="color">
                  <option value="0"><?php echo T_("Default"); ?></option>
                  <option value="red" <?php if(\dash\data::cartSettingSaved_color() === 'red') {echo 'selected';} ?>><?php echo T_("Red") ?></option>
                  <option value="green" <?php if(\dash\data::cartSettingSaved_color() === 'green') {echo 'selected';} ?>><?php echo T_("Green") ?></option>
                  <option value="blue" <?php if(\dash\data::cartSettingSaved_color() === 'blue') {echo 'selected';} ?>><?php echo T_("Blue") ?></option>
                  <option value="yellow" <?php if(\dash\data::cartSettingSaved_color() === 'yellow') {echo 'selected';} ?>><?php echo T_("Yellow") ?></option>
                </select>
              </div>

            </div>

            <div class="c12 mB5">
              <label for="share_text"><?php echo T_("Text"); ?></label>
              <textarea name="share_text" id="share_text" class="txt" rows="5"><?php echo \dash\data::cartSettingSaved_share_text(); ?></textarea>
            </div>


          </div>
        </div>
      </div>
      <footer class="txtRa">
        <button  class="btn success" ><?php echo T_("Save"); ?></button>
      </footer>
  </div>
    <?php if(\dash\data::cartSettingSaved_share_text()) {?>
      <div class="fs12">
        <div class="msg <?php echo \dash\data::cartSettingSaved_color_class() ?>"><?php echo nl2br(\dash\data::cartSettingSaved_share_text()) ?></div>
      </div>
    <?php } //endif ?>
</div>

</form>