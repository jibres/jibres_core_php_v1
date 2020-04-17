<?php require_once(core. 'layout/tools/stepGuide.php'); ?>

<div class="f justify-center">
  <div class="c6 m8 s12">



    <form method="post" autocomplete="off" class="box impact">
      <header><h2><?php echo T_("Create new gift card"); ?></h2></header>

      <div class="body">


      <a class="checklist fc-black" <?php if(\dash\data::dataRow_giftpercent()) { echo 'data-okay';}else{echo 'data-fail';} ?>><?php echo T_("giftpercent"); ?></a>
      <a class="checklist fc-black" <?php if(\dash\data::dataRow_giftamount()) { echo 'data-okay';}else{echo 'data-fail';} ?>><?php echo T_("giftamount"); ?></a>
      <a class="checklist fc-black" <?php if(\dash\data::dataRow_code()) { echo 'data-okay';}else{echo 'data-fail';} ?>><?php echo T_("code"); ?> <code><?php echo \dash\data::dataRow_code(); ?></code></a>


      </div>

      <footer class="txtRa">
        <button class="btn success" name="status" value="enable"><?php echo T_("Publish"); ?></button>
      </footer>
    </form>
  </div>
</div>