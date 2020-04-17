<?php require_once(core. 'layout/tools/stepGuide.php'); ?>

<div class="f justify-center">
  <div class="c6 m8 s12">



    <form method="post" autocomplete="off" class="box impact">
      <header><h2><?php echo T_("Create new gift card"); ?></h2></header>

      <div class="body">

        <div class="mB10 msg">
          <?php echo T_("Choose type of your gift card"); ?>
        </div>


        <div class="f mB10">

          <div class="c s6">
            <a href="<?php echo \dash\url::that(); ?>/price?type=percent" class="stat">
              <h3>&nbsp;</h3>
              <div class="val"><?php echo T_("Gift by percent"); ?></div>
            </a>
          </div>


          <div class="c s6 mLa10">
            <a href="<?php echo \dash\url::that(); ?>/price?type=amount" class="stat">
              <h3>&nbsp;</h3>
              <div class="val"><?php echo T_("Gift by amount"); ?></div>
            </a>
          </div>

        </div>


      </div>

    </div>

  </form>
</div>
</div>