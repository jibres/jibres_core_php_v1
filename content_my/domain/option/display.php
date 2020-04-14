<div class="f justify-center">
  <div class="c6 m8 s12">

    <form method="post" autocomplete="off" class="box impact">
      <header><h2><?php echo T_("Your domain setting"); ?></h2></header>

      <div class="body">
        <p class="">
          <?php echo T_("Set your default DNS record"); ?>
        </p>
        <div class="f">
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

        <p class="">
          <?php echo T_("Default renew time for auto renew"); ?>
        </p>

        <div class="f mB10">
          <div class="c pB10 pRa5">
            <div class="radio3">
              <input type="radio" name="period" value="1year" id="period1year" <?php if(\dash\data::dataRow_autorenewperiod() === '1year') {echo 'checked';} ?>>
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

        <p class="">
          <?php echo T_("Set life time domain"); ?>
        </p>

        <div class="f mB10">
          <div class="c6 pB10 pRa5">
            <div class="radio3">
              <input type="radio" name="domainlifetime" value="3day" id="domainlifetime3day" <?php if(\dash\data::dataRow_domainlifetime() === '3day') { echo 'checked';} ?>>
              <label for="domainlifetime3day"><?php echo T_("3 Day"); ?></label>
            </div>
          </div>
          <div class="c6 pB10 pRa5">
            <div class="radio3">
              <input type="radio" name="domainlifetime" value="1week" id="domainlifetime1week" <?php if(\dash\data::dataRow_domainlifetime() === '1week') { echo 'checked';} ?>>
              <label for="domainlifetime1week"><?php echo T_("1 Week"); ?></label>
            </div>
          </div>
          <div class="c6 pB10 pRa5">
            <div class="radio3">
              <input type="radio" name="domainlifetime" value="1month" id="domainlifetime1month" <?php if(\dash\data::dataRow_domainlifetime() === '1month') { echo 'checked';} ?>>
              <label for="domainlifetime1month"><?php echo T_("1 Month"); ?></label>
            </div>
          </div>
          <div class="c6 pB10 pRa5">
            <div class="radio3">
              <input type="radio" name="domainlifetime" value="6month" id="domainlifetime6month" <?php if(\dash\data::dataRow_domainlifetime() === '6month') { echo 'checked';} ?>>
              <label for="domainlifetime6month"><?php echo T_("6 Month"); ?></label>
            </div>
          </div>
          <div class="c6 pB10 pRa5">
            <div class="radio3">
              <input type="radio" name="domainlifetime" value="1year" id="domainlifetime1year" <?php if(\dash\data::dataRow_domainlifetime() === '1year') { echo 'checked';} ?>>
              <label for="domainlifetime1year"><?php echo T_("1 Year"); ?></label>
            </div>
          </div>
          <div class="c6 pB10 pRa5">
            <div class="radio3">
              <input type="radio" name="domainlifetime" value="3year" id="domainlifetime3year" <?php if(\dash\data::dataRow_domainlifetime() === '3year') { echo 'checked';} ?>>
              <label for="domainlifetime3year"><?php echo T_("3 Year"); ?></label>
            </div>
          </div>

        </div>
      </div>

      <footer class="txtRa">
        <button class="btn success"><?php echo T_("Save"); ?></button>
      </footer>
    </form>
  </div>
</div>