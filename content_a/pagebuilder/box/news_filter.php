<?php
$lineSetting = \dash\data::lineSetting();
\dash\data::listTag(\dash\app\terms\get::get_all_tag());

?>
<div class="avand-md">

<form method="post" autocomplete="off" id="form1">
  <div class="box">
    <div class="body">


       <div class="mB10">
        <label for='tag'><?php echo T_("Special tag"); ?></label>
        <select name="tag_id" id="tag" class="select22"  data-placeholder='<?php echo T_("Select tag"); ?>' >
          <?php if(a($lineSetting, 'detail',  'tag_id')) {?><option value="0"><?php echo T_("None") ?></option><?php }else{ ?><option value=""><?php echo T_("Select tag") ?></option><?php } //endif ?>
          <?php foreach (\dash\data::listTag() as $key => $value) {?>
            <option value="<?php echo a($value, 'id'); ?>"<?php if(a($lineSetting, 'detail',  'tag_id') == $value['id']) { echo ' selected'; } ?>><?php echo a($value, 'title'); ?></option>
          <?php } //endfor ?>
        </select>
      </div>


      <div class="mB10">
        <label for='subtype'><?php echo T_("Post template"); ?></label>
        <select class="select22" name="subtype" id="subtype">
          <option value="any" <?php if(a($lineSetting, 'detail',  'subtype') == 'any') { echo 'selected'; } ?> ><?php echo T_("Any post"); ?></option>
          <option value="standard" <?php if(a($lineSetting, 'detail',  'subtype') == 'standard') { echo 'selected'; } ?> ><?php echo T_("Standard"); ?></option>
          <option value="gallery" <?php if(a($lineSetting, 'detail',  'subtype') == 'gallery') { echo 'selected'; } ?> ><?php echo T_("Gallery"); ?></option>
          <option value="video" <?php if(a($lineSetting, 'detail',  'subtype') == 'video') { echo 'selected'; } ?> ><?php echo T_("Video"); ?></option>
          <option value="audio" <?php if(a($lineSetting, 'detail',  'subtype') == 'audio') { echo 'selected'; } ?> > <?php echo T_("Audio"); ?></option>
        </select>
      </div>

      <div data-response='subtype' data-response-where='video' <?php if(in_array(a($lineSetting, 'detail',  'subtype'), ['video'])){}else{ echo 'data-response-hide';} ?>>
        <div class="mB10">
          <label for='play_item'><?php echo T_("Show item in player"); ?></label>
          <select class="select22" name="play_item" id="play_item">
            <option value="none" <?php if(a($lineSetting, 'detail', 'play_item') == 'none') { echo 'selected'; } ?> ><?php echo T_("None"); ?></option>
            <option value="first" <?php if(a($lineSetting, 'detail', 'play_item') == 'first') { echo 'selected'; } ?> ><?php echo T_("First"); ?></option>
            <option value="all" <?php if(a($lineSetting, 'detail', 'play_item') == 'all') { echo 'selected'; } ?> ><?php echo T_("All"); ?></option>
          </select>
        </div>
      </div>
    </div>
  </div>
</form>
</div>
