


<div class="f">

    <div class="c8 s12 pA10">

      <div class="cbox">
        <h2><?php echo T_("Charge your account"); ?></h2>
        <p><?php echo T_("Enter an amount to charge your account"); ?></p>

        <form method="post" autocomplete="off">


         <div class="input pA5">
          <label class="addon" for="amount-number"><?php echo T_("Toman"); ?></label>
          <input id="amount-number" type="number" name="amount" value="<?php echo \dash\data::amount(); ?>" placeholder='<?php echo T_("Amount"); ?>' required min=0 max="9999999999">
          <button class="addon btn primary"><?php echo T_("Checkout"); ?></button>
         </div>
        </form>
      </div>



       <div class="cbox">
        <h2><?php echo T_("Promo code"); ?></h2>
        <p><?php echo T_("If you have a promo code, please enter it below to receive your credit."); ?></p>

        <form method="post" autocomplete="off">
         <input type="hidden" name="type" value="promo">
         <div class="input pA5">
          <input id="promo-number" type="text" name="promo" placeholder='<?php echo T_("Promo Code"); ?>' required spellcheck="false">
          <button class="addon btn primary"><?php echo T_("Apply Code"); ?></button>
         </div>
        </form>

       </div>


    </div>

    <div class="c s12 pA10">
      <div class="cbox">
       <div class="statistic blue">
        <div class="value">
          <i class="sf-credit-card"></i>
          <span><?php echo \dash\fit::number(\dash\data::userCash()); ?></span>
        </div>
        <div class="label"><?php echo T_("Your credit"); ?> <small><?php echo T_("Toman"); ?></small></div>
       </div>
      </div>

    </div>

  </div>


<?php if(\dash\data::history() && is_array(\dash\data::history())) {?>


    <h3 id="billing-history" class="pA10"><?php echo T_("Billing History"); ?></h3>
    <table class="tbl1 v6 fs14">
      <thead class="primary">
        <tr>
          <th class="s0"><?php echo T_("Title"); ?></th>
          <th><?php echo T_("Date"); ?></th>
          <th><?php echo T_("Value"); ?></th>
          <th><?php echo T_("Budget After"); ?></th>


          <?php if(\dash\permission::supervisor()) {?>

            <th><?php echo T_("Date"); ?></th>
            <th><?php echo T_("Verify"); ?></th>
            <th><?php echo T_("Detail"); ?></th>

          <?php } //endif ?>

        </tr>
      </thead>
      <tbody>

<?php foreach (\dash\data::history() as $key => $value) {?>





         <tr>
          <td class="s0"><?php echo @$value['title']; ?></td>

  <td title='<?php echo \dash\fit::date(@$value['date']); ?>'><?php echo \dash\fit::date_human(@$value['date']); ?></td>


          <td>
            <?php
            if(isset($value['plus']) && $value['plus'])
            {
              echo '+'. \dash\fit::number($value['plus']);
            }
            elseif(isset($value['minus']) && $value['minus'])
            {
              echo '-'. \dash\fit::number($value['minus']);
            }
            ?>

          </td>
          <td><?php echo \dash\fit::number(@$value['budget']); ?> <?php if(isset($value['budget']) && $value['budget']){ echo T_("Toman");  }?></td>

          <?php if(\dash\permission::supervisor()) {?>
            <td title="<?php echo \dash\fit::date(@$value['datecreated']); ?>"><?php echo \dash\fit::date_human(@$value['datecreated']); ?></td>
            <td><?php if(isset($value['verify']) && $value['verify']) {?><i class="sf-check fc-green"></i><?php }else{ ?><i class="sf-times fc-red"></i><?php } //endif ?></td>
            <td><a title="<?php echo @$value['token']; ?>" class="btn xs warn" href="<?php echo \dash\url::kingdom(); ?>/pay/<?php echo @$value['token']; ?>"><?php echo T_("Detail"); ?></a></td>
          <?php }//endif ?>
         </tr>
<?php }//endfor ?>

      </tbody>
    </table>
    <?php \dash\utility\pagination::html(); ?>

<?php }else{ ?>

<p class="msg info2 txtC fs14"><?php echo T_("You are not have payment history yet!"); ?></p>

<?php } //endif ?>


