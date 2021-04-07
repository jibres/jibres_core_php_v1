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
    <input type="hidden" name="set_limit" value="1 ">
      <div class="action">
        <select class="select22" name="limit">
          <?php for ($i=1; $i <= 10 ; $i++) { $selected = null; if(a($lineSetting, 'limit') == $i || (!a($lineSetting, 'limit') && $i == 8)) { $selected = 'selected'; } echo '<option value="'. $i .'" '. $selected .'>'. \dash\fit::number($i) . '</option>'; } ?>
        </select>
      </div>
  </form>
</section>
<?php

if(!$lineSetting)
{
  $puzzle = \lib\app\website\puzzle::default_list();
}
else
{
  $puzzle = \lib\app\website\puzzle::list(a($lineSetting, 'limit'));
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
            <option value="<?php echo $key ?>" <?php if(a($lineSetting, 'puzzle') == $key) { echo 'selected'; } ?>><?php echo $value; ?></option>
          <?php } //endif ?>
        </select>
      </div>
  </form>
</section>
<?php } //endif ?>