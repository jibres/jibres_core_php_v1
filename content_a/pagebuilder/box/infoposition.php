<?php $lineSetting = \dash\data::lineSetting(); ?>
<section class="f" data-option='website-info-position'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Set info position");?></h3>
      <div class="body">
        <p><?php echo T_("You can change the item position");?></p>
      </div>
    </div>
  </div>
  <form class="c4 s12" method="post" data-patch>
    <input type="hidden" name="set_infoposition" value="1">
      <div class="action">
        <select name="infoposition" class="select22">
            <?php echo \lib\app\pagebuilder\config\infoposition::select_html(a($lineSetting, 'infoposition', 'code')); ?>
        </select>
      </div>
  </form>
</section>