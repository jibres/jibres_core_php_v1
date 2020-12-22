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
          <option value="sm" <?php if(a($lineSetting, 'avand') == 'sm') { echo 'selected'; } ?> ><?php echo T_("Small") ?></option>
          <option value="md" <?php if(a($lineSetting, 'avand') == 'md' || !a($lineSetting, 'avand')) { echo 'selected'; } ?> ><?php echo T_("Medium") ?></option>
          <option value="lg" <?php if(a($lineSetting, 'avand') == 'lg') { echo 'selected'; } ?> ><?php echo T_("Large") ?></option>
          <option value="xl" <?php if(a($lineSetting, 'avand') == 'xl') { echo 'selected'; } ?> ><?php echo T_("X Large") ?></option>
          <option value="xxl" <?php if(a($lineSetting, 'avand') == 'xxl') { echo 'selected'; } ?> ><?php echo T_("XX Large") ?></option>
          <option value="none" <?php if(a($lineSetting, 'avand') == 'none') { echo 'selected'; } ?> ><?php echo T_("None") ?></option>
        </select>

      </div>
  </form>
</section>

