<section class="f" data-option='website-line-avand'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Set box width");?></h3>
      <div class="body">

      </div>
    </div>
  </div>
  <form class="c4 s12" method="post" data-patch>
      <div class="action">
          <select name="avand" class="select22" id="avand">
            <?php echo \lib\app\website\avand::select_html(a($lineSetting, 'avand')); ?>
        </select>
      </div>
  </form>
</section>

