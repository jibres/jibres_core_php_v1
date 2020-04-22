
<section class="f" data-option='renew-period'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("IR Domain Auto Renew Period");?></h3>
      <div class="body">
        <p><?php echo T_("Based on your decision, we are renew your dot ir domains and you can set period for this automatic action");?></p>
        <p><span class="txtB"><?php echo T_("Note"); ?></span> <?php echo T_("You can enable or disable auto renew option on your domains.");?></p>
      </div>
    </div>
  </div>
  <form class="c4 s12" method="post" data-patch>
    <div class="action">
      <div>
        <div class="radio1">
          <input type="radio" name="autorenewperiod" value="1year" id="period1year" <?php if(\dash\data::dataRow_autorenewperiod() === '1year' || !\dash\data::dataRow_autorenewperiod()) {echo 'checked';} ?>>
          <label for="period1year"><?php echo T_("1 Year"); ?></label>
        </div>

        <div class="radio1">
          <input type="radio" name="autorenewperiod" value="5year" id="period5year" <?php if(\dash\data::dataRow_autorenewperiod() === '5year') {echo 'checked';} ?>>
          <label for="period5year"><?php echo T_("5 Year"); ?></label>
        </div>
      </div>
    </div>
  </form>
</section>


<section class="f" data-option='renew-remain'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("IR Domain Auto Renew Remain Time");?></h3>
      <div class="body">
        <p><?php echo T_("Minimum date until we try to auto renew your domain. We are suggest one month.");?></p>
      </div>
    </div>
  </div>
  <form class="c4 s12" method="post" data-patch>
    <div class="action">
        <select name="domainlifetime" class="select22">
          <option value="3day" <?php if(\dash\data::dataRow_domainlifetime() === '3day') {echo 'selected';} ?>><?php echo T_("3 Day"); ?></option>
          <option value="1week" <?php if(\dash\data::dataRow_domainlifetime() === '1week') {echo 'selected';} ?>><?php echo T_("1 Week"); ?></option>
          <option value="1month" <?php if(\dash\data::dataRow_domainlifetime() === '1month' || !\dash\data::dataRow_domainlifetime()) {echo 'selected';} ?>><?php echo T_("1 Month"); ?> (<?php echo T_("default"); ?>)</option>
          <option value="6month" <?php if(\dash\data::dataRow_domainlifetime() === '6month') {echo 'selected';} ?>><?php echo T_("6 Month"); ?></option>
          <option value="1year" <?php if(\dash\data::dataRow_domainlifetime() === '1year') {echo 'selected';} ?>><?php echo T_("1 Year"); ?></option>
        </select>
    </div>
  </form>
</section>


<section class="f" data-option='default-dns'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Domain Default DNS");?></h3>
      <div class="body">
        <p><?php echo T_("The Domain Name System (DNS) is the phonebook of the Internet. Humans access information online through domain names, like jibres.com or google.com. Web browsers interact through Internet Protocol (IP) addresses. DNS translates domain names to IP addresses so browsers can load Internet resources.");?></p>
        <p><?php echo T_("Set default will help you to buy new domains faster.");?></p>
      </div>
    </div>
  </div>
  <form class="c4 s12" method="post" autocomplete="off">
    <div class="action f">

      <div class="c12 mB5">
        <div class="input ltr">
          <label class="addon" for="ns1"><?php echo T_("DNS #1"); ?></label>
          <input type="text" name="ns1" id="ns1" maxlength="50" value="<?php echo \dash\data::dataRow_ns1(); ?>">
        </div>
      </div>
      <div class="c12 mB5">
        <div class="input ltr">
          <label class="addon" for="ns2"><?php echo T_("DNS #2"); ?></label>
          <input type="text" name="ns2" id="ns2" maxlength="50" value="<?php echo \dash\data::dataRow_ns2(); ?>">
        </div>
      </div>
      <div class="c12 mB5">
        <div class="input ltr">
          <label class="addon" for="ns3"><?php echo T_("DNS #3"); ?></label>
          <input type="text" name="ns3" id="ns3" maxlength="50" value="<?php echo \dash\data::dataRow_ns3(); ?>">
        </div>
      </div>
      <div class="c12 mB5">
        <div class="input ltr">
          <label class="addon" for="ns4"><?php echo T_("DNS #4"); ?></label>
          <input type="text" name="ns4" id="ns4" maxlength="50" value="<?php echo \dash\data::dataRow_ns4(); ?>">
        </div>
      </div>

      <div class="c12 mT10 txtC">
        <button class="btn block primary"><?php echo T_("Save"); ?></button>
      </div>

    </div>
  </form>
</section>


<section class="f" data-option='default-handle'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Domain Default IRNIC Handle");?></h3>
      <div class="body">
        <p><?php echo T_("You can manage your IRNIC handle and choose one of them as default. Buy set default you can buy new domains faster.");?></p>
      </div>
    </div>
  </div>
  <form class="c4 s12" method="post" data-patch>
    <div class="action">
        <?php if(\dash\data::contactList()) {?>
          <select name="defaultcontact" class="select22">
            <?php foreach (\dash\data::contactList() as $key => $value) {?>
                <option value="<?php echo \dash\get::index($value, 'nic_id'); ?>" <?php if(\dash\get::index($value, 'isdefault')) { echo "selected";} ?>><?php echo \dash\get::index($value, 'nic_id') ?></option>
            <?php } ?>
          </select>
        <?php }else{ ?>
          <a href="<?php echo \dash\url::this(). '/irnic' ?>" class="btn primary w200"><?php echo T_("Manage IRNIC Handle"); ?></a>
        <?php } ?>
    </div>
  </form>
</section>

