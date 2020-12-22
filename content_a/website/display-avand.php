<section class="f" data-option='website-line-avand'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Set box width");?></h3>
      <div class="body">

      </div>
    </div>
  </div>
  <form class="c4 s12" method="post" data-patch>
    <input type="hidden" name="set_avand" value="1">
      <div class="action">
          <select name="avand" class="select22" id="avand">
          <option value="avand" <?php if(a($lineSetting, 'avand') == 'avand') { echo 'selected'; } ?> ><?php echo T_("Container") ?></option>
          <option value="avand-sm" <?php if(a($lineSetting, 'avand') == 'avand-sm') { echo 'selected'; } ?> ><?php echo T_("Small") ?></option>
          <option value="avand-md" <?php if(a($lineSetting, 'avand') == 'avand-md') { echo 'selected'; } ?> ><?php echo T_("Medium") ?></option>
          <option value="avand-lg" <?php if(a($lineSetting, 'avand') == 'avand-lg') { echo 'selected'; } ?> ><?php echo T_("Large") ?></option>
          <option value="avand-xl" <?php if(a($lineSetting, 'avand') == 'avand-xl') { echo 'selected'; } ?> ><?php echo T_("X Large") ?></option>
          <option value="avand-xxl" <?php if(a($lineSetting, 'avand') == 'avand-xxl') { echo 'selected'; } ?> ><?php echo T_("XX Large") ?></option>
          <option value="" <?php if(a($lineSetting, 'avand') == '') { echo 'selected'; } ?> ><?php echo T_("Without container") ?></option>
        </select>
      </div>
  </form>
</section>

