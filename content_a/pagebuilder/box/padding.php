<section class="f" data-option='website-line-padding'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Set item padding");?></h3>
      <div class="body">

      </div>
    </div>
  </div>
  <form class="c4 s12" method="post" data-patch>
    <input type="hidden" name="set_padding" value="1">
      <div class="action">
          <select name="padding" class="select22" id="padding">
            <?php echo \lib\app\website\padding::select_html(a($lineSetting, 'padding', 'code')); ?>
        </select>
      </div>
  </form>
</section>