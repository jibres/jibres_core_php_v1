
<div class="f justify-center">
  <div class="c6 m8 x5 s12">
    <div class="cbox">
      <div class="msg f">
       <div class="cauto">
        <span class="<?php if(\dash\user::detail('sidebar')) { echo 'sf-monitor'; }else{ echo 'sf-display'; } ?> fs40 pA10 pRa25 vlbottom"></span>
       </div>
        <div class="c">
         <h3><?php echo T_("Toggle side bar"); ?></h3>
         <p><?php echo T_("You can save side bar status"); ?></p>
       </div>
      </div>
      <form method="post" autocomplete="off">
          <?php \dash\csrf::html(); ?>
          <div class="switch1 mT20">
           <input type="checkbox" name="sidebar" id="isidebar" <?php if(\dash\user::detail('sidebar')) { echo "checked"; }?>>
           <label for="isidebar"></label>
           <label for="isidebar"><?php echo T_("Are your need side bar?"); ?></label>
          </div>

        <div class="txtRa">
          <button class="btn success"><?php echo T_("Save"); ?></button>
        </div>

      </form>
    </div>
  </div>
</div>
