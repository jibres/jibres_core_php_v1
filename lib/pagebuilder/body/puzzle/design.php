<?php $lineSetting = \dash\data::lineSetting(); ?>

<section class="f" data-option='website-line-puzzle-type'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Set show model");?></h3>
      <div class="body">
        <p><?php echo T_("Puzzle mode, Slider mode or Rail mode");?></p>
      </div>
    </div>
  </div>
  <form class="c4 s12" method="post" data-patch>
      <div class="action">
        <select class="select22" name="puzzle_type" id="puzzle_type">
          <option value="puzzle" <?php if(a($lineSetting, 'puzzle',  'puzzle_type') == 'puzzle') { echo 'selected'; } ?> ><?php echo T_("Puzzle mode"); ?></option>
          <option value="slider" <?php if(a($lineSetting, 'puzzle',  'puzzle_type') == 'slider') { echo 'selected'; } ?> ><?php echo T_("Slider mode"); ?></option>
          <option value="rail" <?php if(a($lineSetting, 'puzzle',  'puzzle_type') == 'rail') { echo 'selected'; } ?> ><?php echo T_("Rail mode"); ?></option>
        </select>
      </div>
  </form>
</section>


<div data-response='puzzle_type' data-response-where='slider' <?php if(a($lineSetting,'puzzle', 'puzzle_type') === 'slider'){/*nothing*/}else{echo 'data-response-hide';} ?>>

<section class="f" data-option='website-line-slider-type'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Set slider mode");?></h3>
      <div class="body">
        <?php if(a($lineSetting, 'puzzle',  'puzzle_type') == 'slider' && a($lineSetting, 'puzzle',  'slider_type') == 'special' && is_array(a($lineSetting, 'detail', 'list')) &&  count(a($lineSetting, 'detail', 'list')) < 5) { ?>
          <div class="msg minimal warn2"><?php echo T_("There must be at least 5 items in your list to display this model") ?></div>
        <?php } //endif ?>
      </div>
    </div>
  </div>
  <form class="c4 s12" method="post" data-patch>
      <div class="action">
        <select class="select22" name="slider_type" id="slider_type">
          <option value="simple" <?php if(a($lineSetting, 'puzzle',  'slider_type') == 'simple') { echo 'selected'; } ?> ><?php echo T_("Simple slider"); ?></option>
          <option value="special" <?php if(a($lineSetting, 'puzzle',  'slider_type') == 'special') { echo 'selected'; } ?> ><?php echo T_("Special slider"); ?></option>
        </select>
      </div>
  </form>
</section>
</div>

<div data-response='puzzle_type' data-response-where='puzzle' <?php if(a($lineSetting,'puzzle', 'puzzle_type') === 'puzzle'){/*nothing*/}else{echo 'data-response-hide';} ?>>

<section class="f" data-option='website-line-count-show'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Set count show");?></h3>
      <div class="body">
        <p><?php echo T_("How many items would you like to display?");?></p>
      </div>
    </div>
  </div>
  <form class="c4 s12" method="post" data-patch>
    <input type="hidden" name="set_limit" value="1">
      <div class="action">
        <select class="select22" name="limit">
          <?php for ($i=1; $i <= 10 ; $i++) { $selected = null; if(a($lineSetting, 'puzzle', 'limit') == $i || (!a($lineSetting, 'puzzle', 'limit') && $i == 8)) { $selected = 'selected'; } echo '<option value="'. $i .'" '. $selected .'>'. \dash\fit::number($i) . '</option>'; } ?>
        </select>
      </div>
  </form>
</section>
<?php

if(!a($lineSetting,'puzzle', 'limit'))
{
  $puzzle = \lib\pagebuilder\body\puzzle\puzzle::default_list();
}
else
{
  $puzzle = \lib\pagebuilder\body\puzzle\puzzle::list(a($lineSetting,'puzzle', 'limit'));
}

if($puzzle && count($puzzle) > 1)
{
?>
<section class="f" data-option='website-line-puzzle'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Adjust how items are placed");?></h3>
      <div class="body">
        <p><?php echo T_("You can adjust the number of items displayed in different rows and columns according to the total number of items");?></p>
      </div>
    </div>
  </div>
  <form class="c4 s12" method="post" data-patch>
    <input type="hidden" name="set_puzzle" value="1 ">
      <div class="action">
        <select class="select22" name="puzzle">
          <?php foreach ($puzzle as $key => $value) {?>
            <option value="<?php echo $key ?>" <?php if(a($lineSetting, 'puzzle', 'code') == $key) { echo 'selected'; } ?>><?php echo $value; ?></option>
          <?php } //endif ?>
        </select>
      </div>
  </form>
</section>
<?php } //endif ?>

</div>