<section class="f" data-option='website-line-radius'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Set item radius");?></h3>
      <div class="body">

      </div>
    </div>
  </div>
  <form class="c4 s12" method="post" data-patch>
    <input type="hidden" name="set_radius" value="1">
      <div class="action">
          <select name="radius" class="select22" id="radius">
            <?php echo \lib\app\website\radius::select_html(a($lineSetting, 'radius')); ?>

        </select>
      </div>
  </form>
</section>