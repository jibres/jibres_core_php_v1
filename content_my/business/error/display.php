
    <div id="get_started_card">
      <div class="body">
        <div class="pad">
          <h1><?php echo T_("Oops!"); ?></h1>
          <p> <?php echo T_("We can not build your business!"); ?> <?php echo T_("Please contact us to solve this problem."); ?></p>

          <?php if(\dash\data::StoreCreateErrorCode()) {?>

            <div class="msg ltr">
              <code>Error <?php echo \dash\data::StoreCreateErrorCode(); ?></code>
            </div>
          <?php } //endif ?>
          <a href='<?php echo \dash\url::this(); ?>' class="btn mTB20 block success2 outline"><?php echo T_("Try again"); ?></a>

          <a href='<?php echo \dash\url::support(); ?>/business/setup/error' class="btn block secondary"><?php echo T_("Read about this problem"); ?></a>

        </div>

        <img class="internalError" src="<?php echo \dash\url::cdn(); ?>/img/business/error500.jpg" alt='<?php echo T_("Loading Jibres"); ?>'>
      </div>
    </div>
