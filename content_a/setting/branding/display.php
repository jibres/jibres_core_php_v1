<div class="avand-md">
  <form method="post" autocomplete="off">
    <div  class="box">

      <div class="body">

        <div class="switch1 mB20">
          <input type="checkbox" name="removebranding" checked disabled id="removebranding">
          <label for="removebranding"></label>
          <label for="removebranding"><?php echo T_("Remove jibres branding from website and application") ?></label>
        </div>


        <div class="row">

          <div class="c-xs-12 c-sm-12 c-md-6">
            <a href="<?php echo \dash\url::that(); ?>/price?type=percent" class="stat">
              <h3><?php echo \dash\fit::number(100000). ' '. \lib\currency::unit(); ?></h3>
              <div class="val"><?php echo T_("1 Month"); ?></div>
            </a>
          </div>


          <div class="c-xs-12 c-sm-12 c-md-6">
            <a href="<?php echo \dash\url::that(); ?>/price?type=amount" class="stat">
              <h3><?php echo \dash\fit::number(1000000). ' '. \lib\currency::unit(); ?></h3>
              <div class="val"><?php echo T_("1 Year"); ?></div>
            </a>
          </div>

        </div>


      </div>
      </div>
   </form>
</div>
