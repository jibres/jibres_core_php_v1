<?php $lineSetting = \dash\data::lineSetting(); ?>
<?php if(isset($have_title) && $have_title) {?>
  <label for="title"><?php echo T_("Line title"); ?></label>
  <div class="input">
    <input type="text" name="title" id="title" value="<?php if(!a($lineSetting, 'title') && a($lineSetting, 'title') !== '0'){ echo \dash\data::nameSuggestion(); }else{ echo a($lineSetting, 'title'); } ?>"  maxlength="200">
  </div>


<?php if(\dash\url::child() === 'news') {?>
  <div class="mB10">
    <div class="row">
      <div class="c-xs-6 c-sm-6">
        <div class="radio3">
          <input type="radio" name="more_link" value="show" id="showmorelink" <?php if(a($lineSetting, 'more_link') === 'show' || !a($lineSetting, 'more_link')) { echo 'checked';} ?>>
          <label for="showmorelink"><?php echo T_("Show read more link") ?></label>
        </div>
      </div>
      <div class="c-xs-6 c-sm-6">
        <div class="radio3">
          <input type="radio" name="more_link" value="hide" id="hidemorelink" <?php if(a($lineSetting, 'more_link') === 'hide') { echo 'checked';} ?>>
          <label for="hidemorelink"><?php echo T_("Hide read more link") ?></label>
        </div>
      </div>
    </div>
  </div>
  <label for="more_link_caption"><?php echo T_("Caption of more link"); ?></label>
  <div class="input">
    <input type="text" name="more_link_caption" id="more_link_caption" value="<?php echo a($lineSetting, 'more_link_caption');  ?>"  maxlength="200">
  </div>
<?php } // endif ?>
<?php } //endif




if(isset($have_limit) && $have_limit) {?>
  <label for="limit"><?php echo T_("Count show post"); ?></label>
  <div class="input">
    <input type="tel" name="limit" id="limit" placeholder="<?php echo \dash\fit::number(5); ?>" value="<?php echo a($lineSetting, 'limit'); ?>" data-format='int' >
  </div>
<?php } //endif



if(isset($have_fc_position) && $have_fc_position) {?>
<div class="mB10">
  <label for='first_line_count'><?php echo T_("Set the number of item views in the first row"); ?></label>
  <select class="select22" name="first_line_count" id="first_line_count">
    <option value="0" <?php if(!a($lineSetting, 'first_line_count')) { echo 'selected'; } ?> > <?php echo T_("None"); ?></option>
    <option value="1" <?php if(a($lineSetting, 'first_line_count') == '1') { echo 'selected'; } ?> > <?php echo T_("One item"); ?></option>
    <option value="2" <?php if(a($lineSetting, 'first_line_count') == '2') { echo 'selected'; } ?> > <?php echo T_("Two item"); ?></option>
    <option value="3" <?php if(a($lineSetting, 'first_line_count') == '3') { echo 'selected'; } ?> > <?php echo T_("Three item"); ?></option>
  </select>
</div>

<div class="mB10">
  <label for='second_line_count'><?php echo T_("Set the number of item views in the second row"); ?></label>
  <select class="select22" name="second_line_count" id="second_line_count">
    <option value="1" <?php if(a($lineSetting, 'second_line_count') == '1') { echo 'selected'; } ?> > <?php echo T_("One item"); ?></option>
    <option value="2" <?php if(a($lineSetting, 'second_line_count') == '2') { echo 'selected'; } ?> > <?php echo T_("Two item"); ?></option>
    <option value="3" <?php if(a($lineSetting, 'second_line_count') == '3') { echo 'selected'; } ?> > <?php echo T_("Three item"); ?></option>
    <option value="4" <?php if(a($lineSetting, 'second_line_count') == '4') { echo 'selected'; } ?> > <?php echo T_("Four item"); ?></option>
  </select>
</div>
<?php } // endif ?>

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


