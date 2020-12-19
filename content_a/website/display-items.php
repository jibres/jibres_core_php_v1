<?php if(isset($have_title) && $have_title) {?>
      <label for="title"><?php echo T_("Line title"); ?></label>
      <div class="input">
        <input type="text" name="title" id="title" value="<?php if(!a(\dash\data::lineSetting(), 'title') && a(\dash\data::lineSetting(), 'title') !== '0'){ echo \dash\data::NameSuggestion(); }else{ echo a(\dash\data::lineSetting(), 'title'); } ?>"  maxlength="200"  >
      </div>
<?php } //endif



if(isset($have_limit) && $have_limit) {?>
      <label for="limit"><?php echo T_("Count show post"); ?></label>
      <div class="input">
        <input type="tel" name="limit" id="limit" placeholder="<?php echo \dash\fit::number(5); ?>" value="<?php echo a(\dash\data::lineSetting(), 'limit'); ?>" data-format='int' >
      </div>
<?php } //endif



if(isset($have_fc_position) && $have_fc_position) {?>

      <div class="mB10">
        <label for='first_line_count'><?php echo T_("Set the number of item views in the first row"); ?></label>
        <select class="select22" name="first_line_count" id="first_line_count">
          <option value="0" <?php if(!a(\dash\data::lineSetting(), 'first_line_count')) { echo 'selected'; } ?> > <?php echo T_("None"); ?></option>
          <option value="1" <?php if(a(\dash\data::lineSetting(), 'first_line_count') == '1') { echo 'selected'; } ?> > <?php echo T_("One item"); ?></option>
          <option value="2" <?php if(a(\dash\data::lineSetting(), 'first_line_count') == '2') { echo 'selected'; } ?> > <?php echo T_("Two item"); ?></option>
          <option value="3" <?php if(a(\dash\data::lineSetting(), 'first_line_count') == '3') { echo 'selected'; } ?> > <?php echo T_("Three item"); ?></option>
        </select>
      </div>


      <div class="mB10">
        <label for='second_line_count'><?php echo T_("Set the number of item views in the second row"); ?></label>
        <select class="select22" name="second_line_count" id="second_line_count">
          <option value="1" <?php if(a(\dash\data::lineSetting(), 'second_line_count') == '1') { echo 'selected'; } ?> > <?php echo T_("One item"); ?></option>
          <option value="2" <?php if(a(\dash\data::lineSetting(), 'second_line_count') == '2') { echo 'selected'; } ?> > <?php echo T_("Two item"); ?></option>
          <option value="3" <?php if(a(\dash\data::lineSetting(), 'second_line_count') == '3') { echo 'selected'; } ?> > <?php echo T_("Three item"); ?></option>
          <option value="4" <?php if(a(\dash\data::lineSetting(), 'second_line_count') == '4') { echo 'selected'; } ?> > <?php echo T_("Four item"); ?></option>
        </select>
      </div>

<?php } // endif ?>

