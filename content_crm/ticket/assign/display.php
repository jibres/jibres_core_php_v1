<form method="post" autocomplete="off">
  <div class="avand-md">
    <div class="box">
      <header><h2><?php echo T_("Assign ticket to customer") ?></h2></header>
      <div class="pad">
        <p><?php echo T_("To assign this ticket to a specific customer, select a customer or register a new customer") ?></p>
        <div class="f">
          <div class="c">
            <select name="customer" class="select22"  data-model='html'  data-ajax--url='<?php echo \dash\url::kingdom(); ?>/crm/api?type=sale&json=true&list=customer' data-shortkey-search data-placeholder='<?php echo T_("Choose customer"); ?>'>
            </select>
          </div>
          <div class="cauto"><i data-kerkere='.addNewCustomer' class="sf-plus btn outline mLa5 pLR10"></i></div>
        </div>
        <div class="addNewCustomer" data-kerkere-content='hide'>
          <div class="msg info2 mT10 mB0 pTB5"><?php echo T_("Quickly add customer"); ?></div>
          <div class="input mTB5">
            <input type="tel" name="memberTl" id="memberTl" placeholder='<?php echo T_("Mobile"); ?> <?php echo T_("Like"); ?> <?php echo \dash\fit::mobile('09120123456'); ?>'  maxlength='30' data-response-realtime>
          </div>
          <select name="memberGender" id="memberGender" class="select22 mT5">
            <option value="" disabled><?php echo T_("Gender"); ?></option>
            <option value="0">-</option>
            <option value="male"><?php echo T_("Mr"); ?></option>
            <option value="female"><?php echo T_("Mrs"); ?></option>
          </select>
          <div class="input mT5">
            <input type="text" name="memberN" id="memberN" placeholder='<?php echo T_("Customer Name"); ?>'  maxlength='70' minlength="1">
          </div>
        </div>
      </div>
      <footer class="txtRa">
        <button class="btn primary"><?php echo T_("Assign ticket to user"); ?></button>
      </footer>
    </div>
  </div>
</form>