

<form method="post" autocomplete="off" class="f" id='factorAdd' data-disallowEnter data-msgNewError='<?php echo T_("You can add new empty tab if current tab is filled!"); ?>' <?php if(\dash\request::get('extra') == 'true') {?> data-autoClose=2000 <?php } //endif ?>>
  <div class="c9 s12 pRa10">

    <div class="cbox p0" id="searchInProducts">
      <select name="product" class="select22 barCode" id="productSearch" multiple='multiple' data-model='html' data-selection='clean' <?php \dash\layout\autofocus::html() ?> data-default data-ajax--delay="250" data-ajax--url='<?php echo \dash\url::this(); ?>?json=true' data-shortkey-search data-placeholder='<?php echo T_("Search in list to add product"); ?> +'>
      </select>
    </div>


      <table class="tbl1 v4 txtC fs13 productList" data-item='0'>
   <thead>
    <tr class="fs08">
     <th class="headIndex collapsing"><?php echo T_("Row"); ?></th>
     <th class="headProduct"><?php echo T_("Product"); ?></th>
     <th class="headCount collapsing"><?php echo T_("Count"); ?></th>
     <th class="headPrice min100"><?php echo T_("Price"); ?></th>
     <th class="headDiscount collapsing"><?php echo T_("Discount"); ?></th>
     <th class="headTotal min100"><?php echo T_("Total"); ?></th>
    </tr>
   </thead>
   <tbody>

   </tbody>
  </table>


  </div>
  <div class="c3 s12">

    <div class="cbox p0">
    <div class="f">
      <div class="c">

        <select name="customer" class="select22"  data-model='html'  data-ajax--url='<?php echo \dash\url::kingdom(); ?>/crm/api?type=sale&json=true&list=customer' data-shortkey-search data-placeholder='<?php echo T_("Choose customer"); ?>'>
        </select>
      </div>
      <div class="cauto"><div data-kerkere='.addNewCustomer' class="btn-light"><?php echo \dash\utility\icon::svg('CirclePlus') ?></div></div>
    </div>
    <div class="addNewCustomer" data-kerkere-content='hide'>
      <div class="msg info2 mT10 mB0 pTB5"><?php echo T_("Quickly add customer"); ?></div>
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

    <div class="priceBox hide">
      <h3><?php echo T_("Factor Price Detail"); ?></h3>
      <div class="final" title='<?php echo T_("Total payable"); ?>'><span>0</span><abbr><?php echo \lib\currency::unit(); ?></abbr></div>
      <div class="desc">-</div>
      <div class="detail item"><abbr><?php echo T_("Count of items"); ?></abbr> <span>-</span></div>
      <div class="detail count"><abbr><?php echo T_("Sum of counts"); ?></abbr> <span>-</span></div>
      <div class="detail sum"><abbr><?php echo T_("Invoice amount"); ?></abbr> <span>-</span></div>
      <div class="detail discountPercent"><abbr><?php echo T_("Discount percent"); ?></abbr> <span>-</span></div>
      <div class="detail discount" title='<?php echo T_("Press f7 or click to toggle discount"); ?>'><abbr><?php echo T_("Total discount"); ?> <kbd>f7</kbd></abbr> <span>-</span></div>
    </div>

    <div class="cbox NextBox p0 hide">
      <?php if(\dash\data::pcPosLink()) {?>

        <div class="f mB10">
          <div class="btn pcPos" data-link='<?php echo \dash\data::pcPosLink_link(); ?>' data-shortkey='121'><?php echo \dash\data::pcPosLink_title(); ?> <kbd>f10</kbd></div>
        </div>
      <?php } //endif ?>


      <button class="cauto btn success block factor_save_btn" type="submit" name="save_btn" value="save_next" id='save_nextContinue' data-shortkey='115'><?php echo T_("Save Factor & Continue"); ?> <kbd class="floatRa mT5">f4</kbd></button>

      <button class="cauto btn secondary block factor_save_btn mT10" type="submit" name="save_btn" value="save_print" id='save_nextPrint' data-shortkey='119'><?php echo T_("Save & Print"); ?> <kbd class="floatRa mT5">f8</kbd></button>
    </div>

  </div>
</form>




