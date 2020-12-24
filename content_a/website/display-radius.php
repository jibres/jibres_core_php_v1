<section class="f" data-option='website-line-radius'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Set item radius");?></h3>
      <div class="body">

      </div>
    </div>
  </div>
  <form class="c4 s12" method="post" data-patch>
    <input type="hidden" name="set_radius" value="1">
      <div class="action">
          <select name="radius" class="select22" id="radius">
          <option value="normal" <?php if(a($lineSetting, 'radius') == 'normal') { echo 'selected'; } ?> ><?php echo T_("Normal") ?></option>
          <option value="sharp" <?php if(a($lineSetting, 'radius') == 'sharp') { echo 'selected'; } ?> ><?php echo T_("Sharp") ?></option>
          <option value="circular" <?php if(a($lineSetting, 'radius') == 'circular') { echo 'selected'; } ?> ><?php echo T_("Circular") ?></option>
          <option value="none" <?php if(a($lineSetting, 'radius') == 'none') { echo 'selected'; } ?> ><?php echo T_("Without radius") ?></option>
        </select>
      </div>
  </form>
</section>

