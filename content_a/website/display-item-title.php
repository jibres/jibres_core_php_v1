<section class="f" data-option='website-line-count-show'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Set count show");?></h3>
      <div class="body">
        <p><?php echo T_("How many posts would you like to display?");?></p>
      </div>
    </div>
  </div>
  <form class="c4 s12" method="post" data-patch>
    <input type="hidden" name="set_item_title" value="1 ">
      <div class="action">
          <select name="item_title" class="select22" id="item_title">
          <option value="none" <?php if(a($lineSetting, 'item_title') == 'none') { echo 'selected'; } ?> ><?php echo T_("Untitled, Only the image displayed") ?></option>
          <option value="on_image" <?php if(a($lineSetting, 'item_title') == 'on_image') { echo 'selected'; } ?> ><?php echo T_("Show title on image") ?></option>
          <option value="below_image" <?php if(a($lineSetting, 'item_title') == 'below_image') { echo 'selected'; } ?> ><?php echo T_("Show title below image") ?></option>
          <option value="beside_image" <?php if(a($lineSetting, 'item_title') == 'beside_image') { echo 'selected'; } ?> ><?php echo T_("Show title beside image") ?></option>
          <option value="beside_image_description" <?php if(a($lineSetting, 'item_title') == 'beside_image_description') { echo 'selected'; } ?> ><?php echo T_("Show title beside image with description") ?></option>
        </select>

      </div>
  </form>
</section>

