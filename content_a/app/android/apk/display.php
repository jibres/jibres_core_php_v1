<?php require_once(root. 'content_a/app/android/pageSteps.php'); ?>
<div class="f justify-center">
  <div class="c8 m12 s12">
    <div class="cbox">
      <h4><?php echo T_("Download your application now"); ?></h4>

      <form method="post" autocomplete="off">
          <?php if(\dash\data::downoadAPK()) {?>
            <a target="_blank" href="<?php echo \dash\data::downoadAPK(); ?>" class="btn block success xl"><?php echo T_("Download Now"); ?></a>
          <?php }//endif ?>
        <div class="txtRa mT10">
          <button class="btn secondary"><?php echo T_("Rebuild"); ?></button>
        </div>
      </form>
    </div>
  </div>
</div>


