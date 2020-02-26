

    <div id="get_started_card">
      <div class="body">
        <div class="pad">
          <?php if(\dash\data::canAddStore_can()) {?>

          <h1><?php echo \dash\data::page_title(); ?></h1>
          <p><?php echo T_("To make a online store from scratch, please enter name of your business."); ?></p>

          <form method="post" autocomplete="off">
            <div class="input">
              <input type="text" name="bt" placeholder='<?php echo T_("Your business title"); ?>' autofocus required maxlength='50'>
            </div>

            <button class="btn success block"><?php echo T_("Let's go"); ?></button>
          </form>
          <img src="<?php echo \dash\url::cdn(); ?>/img/store/your-brand.svg" alt='<?php echo T_("Create a store on Jibres"); ?>'>

        <?php }else{ ?>

            <h1><?php echo T_("Can not add new store"); ?></h1>
            <p><?php echo \dash\data::canAddStore_msg(); ?></p>

            <?php if(\dash\data::canAddStore_type() === 'price') {?>

              <a href="<?php echo \dash\url::kingdom(); ?>/account/billing" class="btn block outline mT10 primary"><?php echo T_("Charge your account"); ?></a>

            <?php }elseif(\dash\data::canAddStore_type() === 'store3') {?>

              <a href='<?php echo \dash\url::support(); ?>/ticket/add?title=<?php echo T_("Create more store"); ?>' class="btn block outline mT10 primary"><?php echo T_("Contact Us"); ?></a>

            <?php } //endif ?>


            <a href="<?php echo \dash\url::this(); ?>" class="btn block outline mT10 success"><?php echo T_("Back"); ?></a>

            <img src="<?php echo \dash\url::cdn(); ?>/img/store/limit1.gif" alt='<?php echo T_("Limit of create store"); ?>'>


        <?php } //endif ?>

        </div>
      </div>
      <?php if(\dash\data::canAddStore_can()) {?>


        <div class="f align-center msg">
          <div class="c pRa10"><?php echo \dash\data::termOfService(); ?></div>
          <div class="cauto os"><a href="<?php echo \dash\url::this(); ?>" class="btn"><?php echo T_("Cancel"); ?></a></div>
        </div>
      <?php }//endif ?>
    </div>


