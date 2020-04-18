<?php $discount = 0; ?>
<div class="f justify-center">
  <div class="c6 m8 s12">

    <div class="box impact">
      <header><h2><?php echo T_("Domain register detail"); ?></h2></header>

      <div class="body">
        <table class="tbl1 v4">
          <tbody>
            <tr>
              <td><?php echo T_("Domain") ?></td>
              <td class="ltr floatL txtB"><code><?php echo \dash\data::dataRow_name(); ?></code></td>
            </tr>
            <tr>
              <td><?php echo T_("IRNIC Admin") ?></td>
              <td class="ltr floatL"><code><?php echo \dash\data::dataRow_admin(); ?></code></td>
            </tr>
            <tr>
              <td><?php echo T_("IRNIC Billing") ?></td>
              <td class="ltr floatL"><code><?php echo \dash\data::dataRow_bill(); ?></code></td>
            </tr>
            <tr>
              <td><?php echo T_("IRNIC Technical") ?></td>
              <td class="ltr floatL"><code><?php echo \dash\data::dataRow_tech(); ?></code></td>
            </tr>
            <tr>
              <td><?php echo T_("IRNIC Holder") ?></td>
              <td class="ltr floatL"><code><?php echo \dash\data::dataRow_holder(); ?></code></td>
            </tr>

            <?php if(\dash\data::dataRow_ns1()) {?>
              <tr>
                <td><?php echo T_("DNS #1") ?></td>
                <td class="ltr floatL"><code><?php echo \dash\data::dataRow_ns1(); ?></code></td>
              </tr>
            <?php } //endif ?>

            <?php if(\dash\data::dataRow_ns2()) {?>
              <tr>
                <td><?php echo T_("DNS #2") ?></td>
                <td class="ltr floatL"><code><?php echo \dash\data::dataRow_ns2(); ?></code></td>
              </tr>
            <?php } //endif ?>

            <?php if(\dash\data::dataRow_ns3()) {?>
              <tr>
                <td><?php echo T_("DNS #3") ?></td>
                <td class="ltr floatL"><code><?php echo \dash\data::dataRow_ns3(); ?></code></td>
              </tr>
            <?php } //endif ?>

            <?php if(\dash\data::dataRow_ns4()) {?>
              <tr>
                <td><?php echo T_("DNS #4") ?></td>
                <td class="ltr floatL"><code><?php echo \dash\data::dataRow_ns4(); ?></code></td>
              </tr>
            <?php } //endif ?>

            <tr>
              <td><?php echo T_("Period") ?></td>
              <td class="ltr floatL"><?php if(\dash\data::myPeriod() == '1year') { echo T_("1 Year"); }elseif(\dash\data::myPeriod() == '5year'){echo T_("5 Year");}else{echo T_("Unknown");} ?></td>
            </tr>



          </tbody>
        </table>
      </div>


    </div>

    <div class="box impact">
      <header><h2><?php echo T_("Gift card"); ?></h2></header>
      <div class="body">
        <p>
          <?php echo T_("If you have gift cart enter here") ?> 🎁
        </p>
        <form method="get" autocomplete="off" action="<?php echo \dash\url::that(); ?>">
          <input type="hidden" name="id" value="<?php echo \dash\request::get('id'); ?>">
          <label for="gift"><?php echo T_("Gift code") ?></label>
          <div class="input ltr">
            <button class="btn primary addon"><?php echo T_("Check"); ?></button>
            <input type="text" name="gift"  value="<?php echo \dash\request::get('gift'); ?>" id="gift" maxlength="100">
          </div>
        </form>

        <?php if(\dash\request::get('gift')) {?>
          <?php if(\dash\data::giftDetail_msgsuccess()) {?>
            <div class="msg success"><?php echo \dash\data::giftDetail_msgsuccess(); ?></div>
          <?php }// endif ?>
          <div class="msg success2 f align-center">
            <div class="c">

              <?php $discount = \dash\data::giftDetail_discount(); ?>

              <?php if(\dash\data::giftDetail_type() === 'percent') {?>
                <?php echo T_("Discount percent") ?>: <?php echo \dash\fit::number(\dash\data::giftDetail_giftpercent()); ?> <?php echo T_("%"); ?>
              <?php }elseif(\dash\data::giftDetail_type() === 'amount') { ?>
                <?php echo T_("Discount amount") ?>: <?php echo \dash\fit::number(\dash\data::giftDetail_giftamount()); ?>
              <?php }else{ ?>
                <?php echo T_("Invalid gift code") ?> 😔
              <?php } //endif ?>

            </div>
            <div class="cauto">
              <a href="<?php echo \dash\url::that(). '?id='. \dash\request::get('id'); ?>" class="btn xs danger"><?php echo T_("Remove"); ?></a>
            </div>
          </div>
        <?php } // endif ?>
      </div>
    </div>


    <form method="post" autocomplete="off">
      <div class="box impact">
        <header><h2><?php echo T_("Register domain"); ?></h2></header>
        <div class="body">
          <?php if(\dash\data::userBudget() && false) {?>
            <div class="check1">
              <input type="checkbox" name="usebudget"  id="budget" checked>
              <label for="budget"><?php echo T_("Use from your budget"); ?> <small><?php echo \dash\fit::number(\dash\data::userBudget()); ?> <?php echo T_("Toman") ?></small></label>
            </div>
          <?php } //endif ?>

          <table class="tbl1 v4">
            <tbody>
              <?php if(\dash\data::myPeriod()) {?>
                <tr>
                  <td><?php echo T_("Price") ?></td>
                  <td class="ltr floatL"><?php echo \lib\app\nic_domain\price::register_string(\dash\data::myPeriod()); ?> </td>
                </tr>
              <?php } // endif ?>
              <?php if($discount) {?>
                <tr>
                  <td><?php echo T_("Discount") ?></td>
                  <td class="ltr floatL"><?php echo \dash\fit::number($discount); ?> <?php echo T_("Toman"); ?> </td>
                </tr>
              <?php } // endif ?>
            <?php if(\dash\data::userBudget()) {?>
                <tr class="active">
                  <td>
                    <div class="check1">
                      <input type="checkbox" name="usebudget"  id="budget" checked>
                      <label for="budget"><?php echo T_("Use from your budget"); ?></label>
                    </div>
                  </td>
                  <td class="ltr floatL align-centers"><?php echo \dash\fit::number(\dash\data::userBudget()); ?> <?php echo T_("Toman") ?></td>
                </tr>
            <?php } //endif ?>
              <tr class="positive">
                  <td><?php echo T_("Amount payable") ?></td>
                  <td class="ltr floatL"><?php echo \dash\fit::number(\dash\data::myPrice() - $discount) ?> <?php echo T_("Toman"); ?></td>
              </tr>
            </tbody>
          </table>
        </div>
        <footer class="txtRa">
          <button class="btn success"><?php echo T_("Register domain"); ?></button>
        </footer>
      </div>
    </form>
  </div>
</div>