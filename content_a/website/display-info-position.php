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
    <input type="hidden" name="set_info_position" value="1">
      <div class="action">
        <select name="info_position" class="select22">
            <?php echo \lib\app\website\info_position::select_html(a($lineSetting, 'info_position')); ?>
        </select>
      </div>
  </form>
</section>