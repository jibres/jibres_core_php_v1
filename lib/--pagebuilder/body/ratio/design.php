<?php $lineSetting = \dash\data::lineSetting(); ?>
<section class="f" data-option='website-line-ratio'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Set item ratio");?></h3>
      <div class="body">

      </div>
    </div>
  </div>
  <form class="c4 s12" method="post" data-patch>
    <input type="hidden" name="set_ratio" value="1">
      <div class="action">
          <select name="ratio" class="select22" id="ratio">
            <?php echo \lib\pagebuilder\body\ratio\ratio::select_html(a($lineSetting, 'ratio', 'code')); ?>
        </select>
      </div>
  </form>
</section>