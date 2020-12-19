<?php if(isset($have_title) && $have_title) {?>
      <label for="title"><?php echo T_("Line title"); ?></label>
      <div class="input">
        <input type="text" name="title" id="title" value="<?php if(!a(\dash\data::lineSetting(), 'title') && a(\dash\data::lineSetting(), 'title') !== '0'){ echo \dash\data::newsNameSuggestion(); }else{ echo a(\dash\data::lineSetting(), 'title'); } ?>"  maxlength="200"  >
      </div>
<?php } //endif



if(isset($have_limit) && $have_limit) {?>
      <label for="limit"><?php echo T_("Count show post"); ?></label>
      <div class="input">
        <input type="tel" name="limit" id="limit" placeholder="<?php echo \dash\fit::number(5); ?>" value="<?php echo a(\dash\data::lineSetting(), 'news', 'limit'); ?>" data-format='int' >
      </div>
<?php } //endif



if(isset($have_fc_position) && $have_fc_position) {?>

      <div class="mB10">
        <label for='subtype'><?php echo T_("Set position count"); ?></label>
        <select class="select22" name="subtype">
          <option value="standard" <?php if(a(\dash\data::lineSetting(), 'news', 'subtype') == 'standard') { echo 'selected'; } ?> ><?php echo T_("Standard"); ?></option>
          <option value="gallery" <?php if(a(\dash\data::lineSetting(), 'news', 'subtype') == 'gallery') { echo 'selected'; } ?> ><?php echo T_("Gallery"); ?></option>
          <option value="video" <?php if(a(\dash\data::lineSetting(), 'news', 'subtype') == 'video') { echo 'selected'; } ?> ><?php echo T_("Video"); ?></option>
          <option value="audio" <?php if(a(\dash\data::lineSetting(), 'news', 'subtype') == 'audio') { echo 'selected'; } ?> > <?php echo T_("Audio"); ?></option>
        </select>
      </div>
<?php } // endif ?>

