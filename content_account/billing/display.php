


<div class="f">

    <div class="c8 s12 pA10">

      <div class="cbox">
        <h2><?php echo T_("Charge your account"); ?></h2>
        <p><?php echo T_("Enter an amount to charge your account"); ?></p>

        <form method="post" autocomplete="off">

          <?php \dash\utility\hive::html(); ?>

         <div class="input pA5">
          <label class="addon" for="amount-number"><?php echo \lib\currency::unit(); ?></label>
          <input id="amount-number" type="number" name="amount" value="<?php echo \dash\data::amount(); ?>" placeholder='<?php echo T_("Amount"); ?>' required min=0 max="9999999999">
          <button class="addon btn primary"><?php echo T_("Checkout"); ?></button>
         </div>

         <div style="background: #eee;line-height:20px;margin:5px">Test 20px</div>
         <div style="background: #eee;line-height:22px;margin:5px">Test 22px</div>
         <div style="background: #eee;line-height:25px;margin:5px">Test 25px</div>
         <div style="background: #eee;line-height:27px;margin:5px">Test 27px</div>
         <div style="background: #eee;line-height:30px;margin:5px">Test 30px</div>
         <div style="background: #eee;line-height:32px;margin:5px">Test 32px</div>
         <div style="background: #eee;line-height:34px;margin:5px">Test 34px</div>
         <div style="background: #eee;line-height:35px;margin:5px">Test 35px</div>
         <div style="background: #eee;line-height:36px;margin:5px">Test 36px</div>
         <div style="background: #eee;line-height:37px;margin:5px">Test 37px</div>
         <div style="background: #eee;line-height:40px;margin:5px">Test 40px</div>

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
        <div class="label"><?php echo T_("Your credit"); ?> <small><?php echo \lib\currency::unit(); ?></small></div>
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
          <td class="s0"><?php echo \dash\get::index($value, 'title'); ?></td>

  <td title='<?php echo \dash\fit::date(\dash\get::index($value, 'date')); ?>'><?php echo \dash\fit::date_human(\dash\get::index($value, 'date')); ?></td>


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
          <td><?php echo \dash\fit::number(\dash\get::index($value, 'budget')); ?> <?php if(isset($value['budget']) && $value['budget']){ echo \lib\currency::unit();  }?></td>

          <?php if(\dash\permission::supervisor()) {?>
            <td title="<?php echo \dash\fit::date(\dash\get::index($value, 'datecreated')); ?>"><?php echo \dash\fit::date_human(\dash\get::index($value, 'datecreated')); ?></td>
            <td><?php if(isset($value['verify']) && $value['verify']) {?><i class="sf-check fc-green"></i><?php }else{ ?><i class="sf-times fc-red"></i><?php } //endif ?></td>
            <td><a title="<?php echo \dash\get::index($value, 'token'); ?>" class="btn xs warn" href="<?php echo \dash\url::kingdom(); ?>/pay/<?php echo \dash\get::index($value, 'token'); ?>"><?php echo T_("Detail"); ?></a></td>
          <?php }//endif ?>
         </tr>
<?php }//endfor ?>

      </tbody>
    </table>
    <?php \dash\utility\pagination::html(); ?>

<?php }else{ ?>

<p class="msg info2 txtC fs14"><?php echo T_("You are not have payment history yet!"); ?></p>

<?php } //endif ?>


