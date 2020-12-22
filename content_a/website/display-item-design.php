<section class="f" data-option='website-line-count-show'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Set item design");?></h3>
      <div class="body">
        <p><?php echo T_("You can change the item design");?></p>
      </div>
    </div>
  </div>
  <form class="c4 s12" method="post" data-patch>
    <input type="hidden" name="set_design" value="1 ">
      <div class="action">
          <select name="design" class="select22" id="design">
          <option value="untitled_only_image" <?php if(a($lineSetting, 'design') == 'untitled_only_image') { echo 'selected'; } ?> ><?php echo T_("Untitled, Only the image displayed") ?></option>
          <option value="title_on_image" <?php if(a($lineSetting, 'design') == 'title_on_image') { echo 'selected'; } ?> ><?php echo T_("Image with title on image") ?></option>
          <option value="title_below_image" <?php if(a($lineSetting, 'design') == 'title_below_image') { echo 'selected'; } ?> ><?php echo T_("Show title below image") ?></option>
          <option value="titel_beside_image" <?php if(a($lineSetting, 'design') == 'titel_beside_image') { echo 'selected'; } ?> ><?php echo T_("Show title beside image") ?></option>
          <option value="title_beside_image_description" <?php if(a($lineSetting, 'design') == 'title_beside_image_description') { echo 'selected'; } ?> ><?php echo T_("Show title beside image with description") ?></option>
          <option value="blog" <?php if(a($lineSetting, 'design') == 'blog') { echo 'selected'; } ?> ><?php echo T_("Blog mode") ?></option>
        </select>

      </div>
  </form>
</section>

