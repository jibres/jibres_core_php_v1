<?php

$have_title       = true;
$have_limit       = true;
$have_fc_position = true;

?>

<div class="avand-lg">
  <form method="post" autocomplete="off" id="forSaveNews">
    <div class="box">
      <div class="body">
        <?php require_once(__DIR__.'/../display-items.php'); ?>
      </div>

    </div>

    <div class="box">

      <div class="body">




        <div class="mB10">
          <label for='cat'><?php echo T_("Special category"); ?></label>
          <select name="cat_id" id="cat" class="select22"  data-placeholder='<?php echo T_("Select category"); ?>' >
            <?php if(a(\dash\data::lineSetting(), 'news', 'cat_id')) {?><option value="0"><?php echo T_("None") ?></option><?php }else{ ?><option value=""><?php echo T_("Select category") ?></option><?php } //endif ?>
            <?php foreach (\dash\data::listCategory() as $key => $value) {?>
              <option value="<?php echo a($value, 'id'); ?>" <?php if(a(\dash\data::lineSetting(), 'news', 'cat_id') == $value['id']) { echo 'selected'; } ?> ><?php echo a($value, 'title'); ?></option>
            <?php } //endfor ?>
          </select>
        </div>

        <div class="mB10">
          <label for='tag'><?php echo T_("Special tag"); ?></label>
          <select name="tag_id" id="tag" class="select22"  data-placeholder='<?php echo T_("Select tag"); ?>' >
            <?php if(a(\dash\data::lineSetting(), 'news', 'tag_id')) {?><option value="0"><?php echo T_("None") ?></option><?php }else{ ?><option value=""><?php echo T_("Select tag") ?></option><?php } //endif ?>
            <?php foreach (\dash\data::listTag() as $key => $value) {?>
              <option value="<?php echo a($value, 'id'); ?>" <?php if(a(\dash\data::lineSetting(), 'news', 'tag_id') == $value['id']) { echo 'selected'; } ?> ><?php echo a($value, 'title'); ?></option>
            <?php } //endfor ?>
          </select>
        </div>

        <div class="mB10">
          <label for='subtype'><?php echo T_("Post template"); ?></label>
          <select class="select22" name="subtype" id="subtype">
            <option value="standard" <?php if(a(\dash\data::lineSetting(), 'news', 'subtype') == 'standard') { echo 'selected'; } ?> ><?php echo T_("Standard"); ?></option>
            <option value="gallery" <?php if(a(\dash\data::lineSetting(), 'news', 'subtype') == 'gallery') { echo 'selected'; } ?> ><?php echo T_("Gallery"); ?></option>
            <option value="video" <?php if(a(\dash\data::lineSetting(), 'news', 'subtype') == 'video') { echo 'selected'; } ?> ><?php echo T_("Video"); ?></option>
            <option value="audio" <?php if(a(\dash\data::lineSetting(), 'news', 'subtype') == 'audio') { echo 'selected'; } ?> > <?php echo T_("Audio"); ?></option>
          </select>
        </div>

        <div data-response='subtype' data-response-where='video|audio' <?php if(in_array(a(\dash\data::lineSetting(), 'news', 'subtype'), ['audio', 'video'])){}else{ echo 'data-response-hide';} ?>>
          <div class="mB10">
            <label for='play_item'><?php echo T_("Show item in player"); ?></label>
            <select class="select22" name="play_item" id="play_item">
              <option value="none" <?php if(a(\dash\data::lineSetting(), 'news', 'play_item') == 'none') { echo 'selected'; } ?> ><?php echo T_("None"); ?></option>
              <option value="first" <?php if(a(\dash\data::lineSetting(), 'news', 'play_item') == 'first') { echo 'selected'; } ?> ><?php echo T_("First"); ?></option>
              <option value="all" <?php if(a(\dash\data::lineSetting(), 'news', 'play_item') == 'all') { echo 'selected'; } ?> ><?php echo T_("All"); ?></option>
            </select>
          </div>
        </div>

        <div class="mB10">
          <label for='template'><?php echo T_("Template view"); ?></label>
          <select name="template" class="select22" id="template">
            <option value="0"><?php echo T_("Default") ?></option>
            <option value="simple" <?php if(a(\dash\data::lineSetting(), 'news', 'template') == 'simple') { echo 'selected'; } ?> ><?php echo T_("Simple") ?></option>
            <option value="special" <?php if(a(\dash\data::lineSetting(), 'news', 'template') == 'special') { echo 'selected'; } ?> ><?php echo T_("Special") ?></option>
          </select>
        </div>



      </div>

      <footer class="txtRa">
        <?php if (\dash\data::newsID()) { ?>
          <div class="f">
            <div class="cauto">
              <div data-confirm data-data='{"remove": "line", "edit_line" : "setting", "id": "<?php echo \dash\request::get('id'); ?>"}' class="btn linkDel danger"><?php echo T_("Remove"); ?></div>
            </div>
            <div class="c"></div>
            <div class="cauto">

            </div>
          </div>
        <?php }else{ ?>

        <?php } //endif ?>
      </footer>
    </div>
  </form>

</div>