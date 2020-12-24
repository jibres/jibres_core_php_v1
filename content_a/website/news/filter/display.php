<form method="post" autocomplete="off" id="form1">
  <input type="hidden" name="set_filter" value="1">
  <div class="box">
    <div class="body">


      <div class="mB10">
        <label for='tag'><?php echo T_("Special tag"); ?></label>
        <select name="tag_id" id="tag" class="select22"  data-placeholder='<?php echo T_("Select tag"); ?>' >
          <?php if(a(\dash\data::lineSetting(),  'tag_id')) {?><option value="0"><?php echo T_("None") ?></option><?php }else{ ?><option value=""><?php echo T_("Select tag") ?></option><?php } //endif ?>
          <?php foreach (\dash\data::listTag() as $key => $value) {?>
            <option value="<?php echo a($value, 'id'); ?>" <?php if(a(\dash\data::lineSetting(),  'tag_id') == $value['id']) { echo 'selected'; } ?> ><?php echo a($value, 'title'); ?></option>
          <?php } //endfor ?>
        </select>
      </div>

      <div class="mB10">
        <label for='subtype'><?php echo T_("Post template"); ?></label>
        <select class="select22" name="subtype" id="subtype">
          <option value="standard" <?php if(a(\dash\data::lineSetting(),  'subtype') == 'standard') { echo 'selected'; } ?> ><?php echo T_("Standard"); ?></option>
          <option value="gallery" <?php if(a(\dash\data::lineSetting(),  'subtype') == 'gallery') { echo 'selected'; } ?> ><?php echo T_("Gallery"); ?></option>
          <option value="video" <?php if(a(\dash\data::lineSetting(),  'subtype') == 'video') { echo 'selected'; } ?> ><?php echo T_("Video"); ?></option>
          <option value="audio" <?php if(a(\dash\data::lineSetting(),  'subtype') == 'audio') { echo 'selected'; } ?> > <?php echo T_("Audio"); ?></option>
        </select>
      </div>

      <div data-response='subtype' data-response-where='video' <?php if(in_array(a(\dash\data::lineSetting(),  'subtype'), ['video'])){}else{ echo 'data-response-hide';} ?>>
        <div class="mB10">
          <label for='play_item'><?php echo T_("Show item in player"); ?></label>
          <select class="select22" name="play_item" id="play_item">
            <option value="none" <?php if(a(\dash\data::lineSetting(), 'play_item') == 'none') { echo 'selected'; } ?> ><?php echo T_("None"); ?></option>
            <option value="first" <?php if(a(\dash\data::lineSetting(), 'play_item') == 'first') { echo 'selected'; } ?> ><?php echo T_("First"); ?></option>
            <option value="all" <?php if(a(\dash\data::lineSetting(), 'play_item') == 'all') { echo 'selected'; } ?> ><?php echo T_("All"); ?></option>
          </select>
        </div>
      </div>
    </div>
  </div>
</form>
