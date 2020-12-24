<section class="f" data-option='website-line-padding'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Set item padding");?></h3>
      <div class="body">

      </div>
    </div>
  </div>
  <form class="c4 s12" method="post" data-patch>
    <input type="hidden" name="set_padding" value="1">
      <div class="action">
          <select name="padding" class="select22" id="padding">
          <option value="normal" <?php if(a($lineSetting, 'padding') == 'normal') { echo 'selected'; } ?> ><?php echo T_("Normal") ?></option>
          <option value="low" <?php if(a($lineSetting, 'padding') == 'low') { echo 'selected'; } ?> ><?php echo T_("Low") ?></option>
          <option value="high" <?php if(a($lineSetting, 'padding') == 'high') { echo 'selected'; } ?> ><?php echo T_("High") ?></option>
          <option value="none" <?php if(a($lineSetting, 'padding') == 'none') { echo 'selected'; } ?> ><?php echo T_("Without padding") ?></option>
        </select>
      </div>
  </form>
</section>