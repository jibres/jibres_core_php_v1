<div class="avand-md">
  <form method="post" autocomplete="off">
    <div class="box">
      <div class="body">
         <p>
        <?php echo T_("Choose exists customer or click on '+' button and Add new customer Quickly") ?>
      </p>
    <div class="f">
      <div class="c">

        <select name="customer" class="select22"  data-model='html'  data-ajax--url='<?php echo \dash\url::kingdom(); ?>/crm/api?type=sale&json=true&list=customer' data-shortkey-search data-placeholder='<?php echo T_("Choose customer"); ?>'>
        </select>
      </div>
      <div class="cauto"><div data-kerkere='.addNewCustomer' class="btn-light"><?php echo \dash\utility\icon::svg('plus-square-dotted', 'bootstrap') ?></div></div>
    </div>
    <div class="addNewCustomer" data-kerkere-content='hide'>
      <div class="alert-info mt-2 mb-0 pTB5"><?php echo T_("Quickly add customer"); ?></div>
        <div class="input mTB5">
          <input type="tel" name="memberTl" id="memberTl" placeholder='<?php echo T_("Mobile"); ?> <?php echo T_("Like"); ?> <?php echo \dash\fit::mobile('09120123456'); ?>' <?php \dash\layout\autofocus::html() ?>  maxlength='30' data-response-realtime>
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

      <button class="btn-primary"><?php echo T_("Go"); ?></button>
      </footer>
    </div>
  </form>
</div>
