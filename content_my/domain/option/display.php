<div class="f justify-center">
  <div class="c6 m8 s12">

    <form method="post" autocomplete="off" class="box impact">
      <header><h2><?php echo T_("Your domain setting"); ?></h2></header>

      <div class="body">
        <div class="mB10 msg">
          <?php echo T_("Set default DNS record"); ?>
          <br>
          <?php echo T_("This will help you to fill in their default DNS when you register new domain"); ?>

        </div>
        <div class="f mB20">
          <div class="c6 s12">
            <label for="ns1"><?php echo T_("DNS #1"); ?></label>
            <div class="input ltr">
              <input type="text" name="ns1" id="ns1" maxlength="50" value="<?php echo \dash\data::dataRow_ns1(); ?>">
            </div>
          </div>

          <div class="c6 s12">
            <div class="mLa5">
              <label for="ns2"><?php echo T_("DNS #2"); ?></label>
              <div class="input ltr">
                <input type="text" name="ns2" id="ns2" maxlength="50" value="<?php echo \dash\data::dataRow_ns2(); ?>">
              </div>
            </div>
          </div>

          <div class="c6 s12">
            <label for="ns3"><?php echo T_("DNS #3"); ?></label>
            <div class="input ltr">
              <input type="text" name="ns3" id="ns3" maxlength="50" value="<?php echo \dash\data::dataRow_ns3(); ?>">
            </div>
          </div>

          <div class="c6 s12">
            <div class="mLa5">
              <label for="ns4"><?php echo T_("DNS #4"); ?></label>
              <div class="input ltr">
                <input type="text" name="ns4" id="ns4" maxlength="50" value="<?php echo \dash\data::dataRow_ns4(); ?>">
              </div>
            </div>
          </div>
        </div>

        <div class="mB10 msg">
          <?php echo T_("Default renew time for auto renew"); ?>
        </div>

        <div class="f mB10">
          <div class="c pB10 pRa5">
            <div class="radio3">
              <input type="radio" name="period" value="1year" id="period1year" <?php if(\dash\data::dataRow_autorenewperiod() === '1year' || !\dash\data::dataRow_autorenewperiod()) {echo 'checked';} ?>>
              <label for="period1year"><?php echo T_("1 Year"); ?></label>
            </div>
          </div>
          <div class="c pB10">
            <div class="radio3">
              <input type="radio" name="period" value="5year" id="period5year" <?php if(\dash\data::dataRow_autorenewperiod() === '5year') {echo 'checked';} ?>>
              <label for="period5year"><?php echo T_("5 Year"); ?></label>
            </div>
          </div>
        </div>

        <div class="mB20 msg">
          <?php echo T_("Save my domain life time"); ?>
          <br>
          <?php echo T_("How many days to expire the remaining domain to automatically renew it?"); ?>
        </div>

        <div>
          <select name="domainlifetime"  class="select22">
            <option></option>
            <option value="3day" <?php if(\dash\data::dataRow_domainlifetime() === '3day') {echo 'selected';} ?>><?php echo T_("3 Day"); ?></option>
            <option value="1week" <?php if(\dash\data::dataRow_domainlifetime() === '1week') {echo 'selected';} ?>><?php echo T_("1 Week"); ?></option>
            <option value="1month" <?php if(\dash\data::dataRow_domainlifetime() === '1month' || !\dash\data::dataRow_domainlifetime()) {echo 'selected';} ?>><?php echo T_("1 Month"); ?></option>
            <option value="6month" <?php if(\dash\data::dataRow_domainlifetime() === '6month') {echo 'selected';} ?>><?php echo T_("6 Month"); ?></option>
            <option value="1year" <?php if(\dash\data::dataRow_domainlifetime() === '1year') {echo 'selected';} ?>><?php echo T_("1 Year"); ?></option>
          </select>
        </div>

      </div>

      <footer class="txtRa">
        <button class="btn success"><?php echo T_("Save"); ?></button>
      </footer>
    </form>
  </div>
</div>