<section class="f" data-option='cms-thumb-ratio'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Featured image");?></h3>
      <div class="body">
        <p><?php echo T_("Specify the aspect ratio of the featured image");?></p>
      </div>
    </div>
  </div>
  <form class="c4 s12" method="post" data-patch>
    <input type="hidden" name="set_thumb_ratio" value="1">
      <div class="action">
        <select class="select22" name="ratio">
        	<?php echo \lib\ratio::select_html(); ?>
        </select>
      </div>
  </form>
</section>