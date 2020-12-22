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


