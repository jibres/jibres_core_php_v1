<section class="f" data-option='website-info-position'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Set info position");?></h3>
      <div class="body">
        <p><?php echo T_("You can change the item info_position");?></p>
      </div>
    </div>
  </div>
  <form class="c4 s12" method="post" data-patch>
    <input type="hidden" name="set_info_position" value="1">
      <div class="action">
          <select name="info_position" class="select22">
          <option value="none" <?php if(a($lineSetting, 'info_position') == 'none') { echo 'selected'; } ?> ><?php echo T_("No show") ?></option>
          <option value="top" <?php if(a($lineSetting, 'info_position') == 'top') { echo 'selected'; } ?> ><?php echo T_("top") ?></option>
          <option value="bottom" <?php if(a($lineSetting, 'info_position') == 'bottom') { echo 'selected'; } ?> ><?php echo T_("bottom") ?></option>
          <option value="beside" <?php if(a($lineSetting, 'info_position') == 'beside') { echo 'selected'; } ?> ><?php echo T_("Beside") ?></option>
          <option value="inside" <?php if(a($lineSetting, 'info_position') == 'inside') { echo 'selected'; } ?> ><?php echo T_("Over") ?></option>
        </select>
      </div>
  </form>
</section>