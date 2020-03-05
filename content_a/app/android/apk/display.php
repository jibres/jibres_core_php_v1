<?php require_once(root. 'content_a/app/android/pageSteps.php'); ?>
<div class="f justify-center">
  <div class="c8 m12 s12">
    <div class="cbox">
      <h4><?php echo T_("Download your application now"); ?></h4>

      <form method="post" autocomplete="off">
        <pre>
          <?php print_r(\dash\data::apiList()); ?>
        </pre>
        <div class="txtRa">
          <button class="btn success"><?php echo T_("Download"); ?></button>
        </div>
      </form>
    </div>
  </div>
</div>


