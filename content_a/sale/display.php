

<form method="post" autocomplete="off" class="f" id='factorAdd' data-disallowEnter data-msgNewError='<?php echo T_("You can add new empty tab if current tab is filled!"); ?>' <?php if(\dash\request::get('extra') == 'true') {?> data-autoClose=2000 <?php } //endif ?>>
  <div class="c9 s12 pRa10">

    <div class="cbox p0" id="searchInProducts">
      <div class="flex align-center">
        <div class="flex-grow">
          <select name="product" class="select22 barCode" id="productSearch" multiple='multiple' data-model='html' data-selection='clean' <?php \dash\layout\autofocus::html() ?> data-default data-ajax--delay="250" data-ajax--url='<?php echo \dash\url::this(); ?>?json=true' data-shortkey-search data-placeholder='<?php echo T_("Search in list to add product"); ?> +'></select>

        </div>
        <div class="flex-none pLa5">
          <a data-fancybox data-type="iframe" data-preload="false" class="btn-light h-9 w-12 flex" target="_blank" href="<?php echo \dash\url::kingdom(); ?>/a/products/quick?iframe=sale"><?php echo \dash\utility\icon::svg('CirclePlus') ?></a>
        </div>
      </div>
    </div>


  <table class="tbl1 v4 text-center productList" data-item='0'>
   <thead>
    <tr class="text-sm">
     <th class="headIndex collapsing"><?php echo T_("Row"); ?></th>
     <th class="headProduct"><?php echo T_("Product"); ?></th>
     <th class="headCount collapsing"><?php echo T_("Count"); ?></th>
     <th class="headPrice min100"><?php echo T_("Price"); ?></th>
     <th class="headDiscount collapsing"><?php echo T_("Discount"); ?></th>
     <?php if(\dash\data::showVatColum()) {?>
     <th class="headVat collapsing" data-vat-percent='<?php echo \dash\data::vatDecimal(); ?>'><?php echo T_("Vat"); ?></th>
     <?php } //endif ?>
     <th class="headTotal min100"><?php echo T_("Total"); ?></th>
    </tr>
   </thead>
   <tbody class="text-sm">

   </tbody>
  </table>


  </div>
  <div class="c3 s12">

    <div class="cbox p0">
    <div class="flex align-center">
      <div class="flex-grow">
        <select name="customer" class="select22"  data-model='html'  data-ajax--url='<?php echo \dash\url::kingdom(); ?>/crm/api?type=sale&json=true&list=customer' data-shortkey-search data-placeholder='<?php echo T_("Choose customer"); ?>'>
        </select>
      </div>
      <div class="flex-none"><div class="btn-light w-12 h-9 flex" data-kerkere='.addNewCustomer'><?php echo \dash\utility\icon::svg('CirclePlus') ?></div></div>
    </div>
    <div class="addNewCustomer" data-kerkere-content='hide'>
      <div class="bg-blue-100 my-1 text-sm p-2 rounded-sm"><?php echo T_("Quickly add customer"); ?></div>
        <div class="input mb-1">
          <input type="tel" name="memberTl" id="memberTl" placeholder='<?php echo T_("Mobile"); ?> <?php echo T_("Like"); ?> <?php echo \dash\fit::mobile('09120123456'); ?>' <?php \dash\layout\autofocus::html() ?>  maxlength='30' data-response-realtime>
        </div>

        <select name="memberGender" id="memberGender" class="select22">
          <option value="" disabled><?php echo T_("Gender"); ?></option>
          <option value="0">-</option>
          <option value="male"><?php echo T_("Mr"); ?></option>
          <option value="female"><?php echo T_("Mrs"); ?></option>
        </select>

        <div class="input mt-1">
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


      <button class="btn-secondary cauto block w-full factor_save_btn mt-1" type="submit" name="save_btn" value="save_print" id='save_nextPrint' data-shortkey='120'><?php echo T_("Save & Print"); ?> <kbd class="floatRa mT5">f9</kbd></button>
    </div>

  </div>
</form>




