<div class="f justify-center">
  <div class="c6 m8 s12">

    <div class="box impact">
      <header><h2><?php echo T_("Your domain ready to register"); ?></h2></header>

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

            <?php $period = null; ?>
            <tr>
              <td><?php echo T_("Period") ?></td>
              <td class="ltr floatL"><?php if(\dash\data::dataRowAction_period() == '12') { echo T_("1 Year"); $period = '1year'; }elseif(\dash\data::dataRowAction_period() == '60'){echo T_("5 Year"); $period = '5year'; }else{echo T_("Unknown");} ?></td>
            </tr>

            <?php if($period) {?>
              <tr>
                <td><?php echo T_("Price") ?></td>
                <td class="ltr floatL"><?php echo \lib\app\nic_domain\price::register_string($period); ?> </td>
              </tr>
            <?php } // endif ?>

          </tbody>
        </table>

        <?php if($period && \dash\data::userBudget() && intval(\dash\data::userBudget()) > intval(\lib\app\nic_domain\price::register($period))) {?>
        <?php } // endif ?>
        <?php if (true) {?>
        <div class="f mB10">
          <div class="c pB10 pRa5">
            <div class="radio3">
              <input type="radio" name="paytype" value="budget" id="budget" checked>
              <label for="budget"><?php echo T_("Pay from your budget"); ?> <small><?php echo \dash\fit::number(\dash\data::userBudget()); ?> <?php echo T_("Toman") ?></small></label>
            </div>
          </div>
          <div class="c pB10">
            <div class="radio3">
              <input type="radio" name="paytype" value="bypayment" id="bypayment">
              <label for="bypayment"><?php echo T_("Pay by IGP"); ?></label>
            </div>
          </div>
        </div>
      <?php } //endif ?>


        <label for="gift"><?php echo T_("Gift code") ?></label>
        <div class="input ltr">
          <button class="btn primary addon"><?php echo T_("Check"); ?></button>
          <input type="text" name="gift"  id="gift" >
        </div>


      </div>

      <footer class="txtRa">
        <form method="post" autocomplete="off">
          <input type="hidden" name="register" value="1">
        <button class="btn success"><?php echo T_("Register domain"); ?></button>
        </form>
      </footer>
    </div>
  </div>
</div>