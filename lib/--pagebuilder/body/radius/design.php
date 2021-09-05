<?php

$lineSetting = \dash\data::lineSetting();

if(in_array(a($lineSetting, 'puzzle', 'puzzle_type'), ['slider', 'rail']))
{
  return;
}
?>
<section class="f" data-option='website-line-radius'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Set item radius");?></h3>
      <div class="body">

      </div>
    </div>
  </div>
  <form class="c4 s12" method="post" data-patch>
      <div class="action">
          <select name="radius" class="select22" id="radius">
            <?php echo \lib\pagebuilder\body\radius\radius::select_html(a($lineSetting, 'radius', 'code')); ?>
        </select>
      </div>
  </form>
</section>