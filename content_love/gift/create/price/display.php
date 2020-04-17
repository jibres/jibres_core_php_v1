<?php require_once(core. 'layout/tools/stepGuide.php'); ?>

<div class="f justify-center">
  <div class="c6 m8 s12">



    <form method="post" autocomplete="off" class="box impact">
      <header><h2><?php echo T_("Create new gift card"); ?></h2></header>

      <div class="body">


        <?php if(\dash\data::myType() === 'percent') {?>

          <div class="mB10 msg">
            <?php echo T_("Set percent of discount for this gift card"); ?>
          </div>
          <label for="giftpercent"><?php echo T_("Gift percent"); ?></label>
          <div class="input ltr">
            <input type="number" name="giftpercent" value="<?php echo \dash\data::dataRow_giftpercent(); ?>" id="giftpercent" min="1" max="100" step="1">
          </div>


          <label for="giftmax"><?php echo T_("Gift max"); ?></label>
          <div class="input ltr">
            <input type="text" name="giftmax" value="<?php echo \dash\data::dataRow_giftmax(); ?>" id="giftmax" max="9999999" data-format='price'>
          </div>

        <?php }elseif(\dash\data::myType() === 'amount'){ ?>

          <div class="mB10 msg">
            <?php echo T_("Set amount of discount for this gift card"); ?>
          </div>

          <label for="giftamount"><?php echo T_("Gift amount"); ?></label>
          <div class="input ltr">
            <input type="text" name="giftamount" value="<?php echo \dash\data::dataRow_giftamount(); ?>" id="giftamount" max="9999999" data-format='price'>
          </div>


        <?php } //endif ?>



        <label for="pricefloor"><?php echo T_("Price floor"); ?></label>
        <div class="input ltr">
          <input type="text" name="pricefloor" value="<?php echo \dash\data::dataRow_pricefloor(); ?>" id="pricefloor" max="9999999" data-format='price'>
        </div>

      </div>

      <footer class="txtRa">
        <button class="btn success"><?php echo T_("Create gift card"); ?></button>
      </footer>
    </form>
  </div>
</div>