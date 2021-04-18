<?php $lineSetting = \dash\data::lineSetting(); ?>
<section class="f" data-option='website-line-effect'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Set item effect");?></h3>
      <div class="body">

      </div>
    </div>
  </div>
  <form class="c4 s12" method="post" data-patch>
    <input type="hidden" name="set_effect" value="1">
      <div class="action">
          <select name="effect" class="select22" id="effect">
            <?php echo \lib\pagebuilder\config\effect::select_html(a($lineSetting, 'effect', 'code')); ?>
        </select>
      </div>
  </form>
</section>