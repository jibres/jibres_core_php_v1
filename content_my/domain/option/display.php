


<section class="f" data-option='domain-park'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Domain parking");?></h3>
      <div class="body">
        <p><?php echo T_("With domain parking you can connect all your free domains to one business");?></p>
        <p><?php echo T_("All domains that you own and their DNS are set to Jibres values and are not currently in use in any business will be connected to this business");?></p>
      </div>
    </div>
  </div>
  <form class="c4 s12" method="post" data-patch>
    <input type="hidden" name="set_domain_parking" value="1">
    <div class="action">
        <?php if(\dash\data::listStore()) {?>
          <select name="domain_parking" class="select22" data-placeholder='<?php echo T_("Choose one business") ?>'>
            <option value=""></option>
            <?php foreach (\dash\data::listStore() as $key => $value) {?>
                <option value="<?php echo a($value, 'subdomain'); ?>" <?php if(floatval(a($value, 'store_id')) === floatval(a(\dash\data::dataRow(), 'domain_parking')) ) { echo "selected";} ?>><?php echo a($value, 'title') ?></option>
            <?php } ?>
          </select>
        <?php }else{ ?>
          <a href="<?php echo \dash\url::here(). '/business/start' ?>" class="btn-secondary w200"><?php echo T_("Create new business"); ?></a>
        <?php } ?>
    </div>
  </form>
  <?php if(\dash\language::current() === 'fa') {?>
    <footer class="txtRa">
     <a target="_blank" href="https://help.jibres.ir/n/K" class="link-primary block p-1"><?php echo T_("Read more"); ?></a>
    </footer>

  <?php } //endif ?>
</section>



<section class="f" data-option='renew-remain'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Default setting of autorenew");?></h3>
      <div class="body">
        <p><?php echo T_("Default setting of autorenew");?></p>
      </div>
    </div>
  </div>
  <form class="c4 s12" method="post" data-patch>
    <div class="action">
      <input type="hidden" name="set_defaultautorenew" value="1">
      <div class="switch1">
        <input type="checkbox" name="defaultautorenew" id="defaultautorenew" <?php if(\dash\data::dataRow_defaultautorenew()) { echo 'checked';} ?>>
        <label for="defaultautorenew"></label>
      </div>
    </div>
  </form>
</section>

<section class="f" data-option='renew-period'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("IR Domain Auto Renew Period");?></h3>
      <div class="body">
        <p><?php echo T_("Based on your decision, we are renew your dot ir domains and you can set period for this automatic action");?></p>
        <p><span class="font-bold"><?php echo T_("Note"); ?></span> <?php echo T_("You can enable or disable auto renew option on your domains.");?></p>
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
          <label class="addon" for="ns1">DNS 1</label>
          <input type="text" name="ns1" id="ns1" maxlength="50" value="<?php echo \dash\data::dataRow_ns1(); ?>">
        </div>
      </div>
      <div class="c12 mB5">
        <div class="input ltr">
          <label class="addon" for="ns2">DNS 2</label>
          <input type="text" name="ns2" id="ns2" maxlength="50" value="<?php echo \dash\data::dataRow_ns2(); ?>">
        </div>
      </div>

      <div class="c12 mt-2 text-center">
        <button class="btn  secondary"><?php echo T_("Save"); ?></button>
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
          <select name="defaultcontact" class="select22" data-placeholder='<?php echo T_("Choose one item") ?>'>
            <option value=""></option>
            <?php foreach (\dash\data::contactList() as $key => $value) {?>
                <option value="<?php echo a($value, 'nic_id'); ?>" <?php if(a($value, 'isdefault')) { echo "selected";} ?>><?php echo a($value, 'nic_id') ?></option>
            <?php } ?>
          </select>
        <?php }else{ ?>
          <a href="<?php echo \dash\url::this(). '/irnic' ?>" class="btn-secondary w200"><?php echo T_("Manage IRNIC Handle"); ?></a>
        <?php } ?>
    </div>
  </form>
  <?php if(\dash\data::contactList()) {?>
    <footer class="txtRa">
     <a href="<?php echo \dash\url::this(). '/irnic' ?>" class="btn-link"><?php echo T_("Manage IRNIC Handle"); ?></a>
    </footer>
  <?php } //endif ?>
</section>




<section class="f" data-option='default-com-handle'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Whois Default Detail");?></h3>
      <div class="body">
        <p><?php echo T_("You can set your information Whois. Buy set default you can buy new domains faster.");?></p>
      </div>
    </div>
  </div>
  <form class="c4 s12" method="post" data-patch>
    <div class="action">
          <a href="<?php echo \dash\url::this(). '/whoisdetail' ?>" class="btn-secondary w200"><?php echo T_("Manage Whois Detail"); ?></a>
    </div>
  </form>
</section>

