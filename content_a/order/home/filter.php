<?php function htmlSearchBox() {?>
<form method="get" action="<?php echo \dash\url::that(); ?>">
<?php
$all_get = \dash\request::get();
unset($all_get['page']);
if($all_get)
{
  foreach ($all_get as $key => $value)
  {
    echo '<input type="hidden" name="'. $key. '" value="'. $value .'">';
  }
}
?>

  <div class="searchBox">
    <div class="f">
      <div class="cauto pRa10">
        <a class="btn light3 <?php if(\dash\data::isFiltered()) { echo 'apply'; }?>" data-kerkere-icon="close" data-kerkere='.filterBox'><?php echo T_("Filter"); ?></a>
      </div>
      <div class="c pRa10">
        <div>
          <div class="input search <?php if(\dash\request::get('q')) { echo 'apply'; }?>">
            <input type="search" name="q" placeholder='<?php echo T_("Search"); ?>' id="q" value="<?php echo \dash\validate::search_string(). \dash\request::get('barcode'); ?>" class="barCode" data-default data-pass='submit' autocomplete='off' autofocus>
            <button class="addon btn light3 s0"><i class="sf-search"></i></button>
          </div>
        </div>
      </div>

      <div class="cauto">
        <select class="select22 <?php if(\dash\request::get('sort') || \dash\request::get('order')) { echo 'apply'; }?>" data-link>
<?php
  foreach (\dash\data::sortList() as $key => $value)
  {
?>
          <option value="<?php echo \dash\url::that(). '?'. \dash\get::index($value, 'query_string'); ?>" <?php if(\dash\request::get('sort') == \dash\get::index($value, 'query')['sort'] && \dash\request::get('order') == \dash\get::index($value, 'query')['order']) { echo 'selected'; }?> ><?php echo \dash\get::index($value, 'title'); ?></option>
<?php
  }
?>
        </select>
      </div>
    </div>
  </div>

  <div class="filterBox" data-kerkere-content='hide'>
    <?php BoxProductFilter(); ?>
  </div>

</form>
<?php } //endfunction ?>
<?php

function BoxProductFilter()
{
  if(\dash\data::orderFilterList()) {?>
  <p><?php echo T_("Show all orders where"); ?></p>
    <div class="mB20">

    <?php $first = true; $myClass = null; $lastGroup = null; foreach (\dash\data::orderFilterList() as $key => $value) {?>
    <?php if($lastGroup !== $value['group']) { $lastGroup = $value['group']; if(!$first) { if(\dash\request::is_pwa()) { $myClass = null; echo '<div class="block"></div>'; }else{ $myClass = 'mLa10'; } } } //endif ?>
      <a class='btn <?php echo $myClass; ?>  <?php if(\dash\get::index($value, 'is_active')) { echo 'primary2'; }else{ echo 'light';}?>  mB10 ' href="<?php echo \dash\url::that(). '?'. \dash\get::index($value, 'query_string'); ?>"><?php echo \dash\get::index($value, 'title'); ?></a>
      <?php $myClass = null; $first = false; ?>
    <?php } //endfor ?>
    </div>


      <?php iKerkere(); ?>

      <div class="f font-12">
        <div class="cauto">
          <?php $total_rows = \dash\utility\pagination::get_total_rows(); ?>
          <div class="fc-mute mA10"><span class="txtB"><?php echo \dash\fit::number($total_rows); ?></span> <?php echo T_("Product founded") ?></div>
        </div>
        <div class="c"></div>
        <div class="cauto">
          <?php if(\dash\request::get()) {?>
            <a class="btn outline" href="<?php echo \dash\url::that(); ?>"><?php echo T_("Clear filters"); ?></a>
          <?php }//endif ?>
          <button class="btn primary"><?php echo T_("Apply"); ?></button>
        </div>
      </div>

<?php } // endif ?>
<?php } //endfunction ?>




<?php function iKerkere() {?>


    <h6 data-kerkere=".showFilterByproduct" data-kerkere-icon><?php echo T_("Filter by product"); ?></h6>
    <div class="showFilterByproduct mB10" <?php if(!\dash\request::get('product')) { echo "data-kerkere-content='hide' ";} ?>>
      <?php iFilterproduct(); ?>
    </div>

    <h6 data-kerkere=".showFilterBycustomer" data-kerkere-icon><?php echo T_("Filter by customer"); ?></h6>
    <div class="showFilterBycustomer mB10" <?php if(!\dash\request::get('customer')) { echo "data-kerkere-content='hide' ";} ?>>
      <?php iFiltercustomer(); ?>
    </div>

    <h6 data-kerkere=".showFilterByweekday" data-kerkere-icon><?php echo T_("Filter by weekday"); ?></h6>
    <div class="showFilterByweekday mB10" <?php if(!\dash\request::get('weekday')) { echo "data-kerkere-content='hide' ";} ?>>
      <?php iFilterweekday(); ?>
    </div>

    <h6 data-kerkere=".showFilterBydate" data-kerkere-icon><?php echo T_("Filter by date"); ?></h6>
    <div class="showFilterBydate mB10" <?php if(!\dash\request::get('date')) { echo "data-kerkere-content='hide' ";} ?>>
      <?php iFilterdate(); ?>
    </div>

    <h6 data-kerkere=".showFilterBytime" data-kerkere-icon><?php echo T_("Filter by time"); ?></h6>
    <div class="showFilterBytime mB10" <?php if(!\dash\request::get('time')) { echo "data-kerkere-content='hide' ";} ?>>
      <?php iFiltertime(); ?>
    </div>

    <h6 data-kerkere=".showFilterBystartenddate" data-kerkere-icon><?php echo T_("Filter by start and end date"); ?></h6>
    <div class="showFilterBystartenddate mB10"  <?php if(!\dash\request::get('enddate') && !\dash\request::get('startdate')) { echo "data-kerkere-content='hide' ";} ?>>
      <?php iFilterstartenddate(); ?>
    </div>

    <h6 data-kerkere=".showFilterByprice" data-kerkere-icon><?php echo T_("Filter by price"); ?></h6>
    <div class="showFilterByprice mB10"  <?php if(!\dash\request::get('subpriceequal') && !\dash\request::get('subpriceless') && !\dash\request::get('subpricelarger')) { echo "data-kerkere-content='hide' ";} ?>>
      <?php iFilterprice(); ?>
    </div>


    <h6 data-kerkere=".showFilterByitem" data-kerkere-icon><?php echo T_("Filter by item"); ?></h6>
    <div class="showFilterByitem mB10"  <?php if(!\dash\request::get('itemequal') && !\dash\request::get('itemlarger') && !\dash\request::get('itemless')) { echo "data-kerkere-content='hide' ";} ?>>
      <?php iFilteritem(); ?>
    </div>

    <h6 data-kerkere=".showFilterBydiscount" data-kerkere-icon><?php echo T_("Filter by discount"); ?></h6>
    <div class="showFilterBydiscount mB10"  <?php if(!\dash\request::get('subdiscountequal') && !\dash\request::get('subdiscountless')) { echo "data-kerkere-content='hide' ";} ?>>
      <?php iFilterdiscount(); ?>
    </div>

    <h6 data-kerkere=".showFilterBysum" data-kerkere-icon><?php echo T_("Filter by count"); ?></h6>
    <div class="showFilterBysum mB10"  <?php if(!\dash\request::get('qtyequal') && !\dash\request::get('qtylarger')  && !\dash\request::get('qtyless')) { echo "data-kerkere-content='hide' ";} ?>>
      <?php iFiltersum(); ?>
    </div>

    <h6 data-kerkere=".showFilterBytype" data-kerkere-icon><?php echo T_("Filter by type"); ?></h6>
    <div class="showFilterBytype mB10" <?php if(!\dash\request::get('type')) { echo "data-kerkere-content='hide' ";} ?>>
      <?php iFiltertype(); ?>
    </div>


<?php } // endfunction ?>


<?php function iFilterproduct() {?>
<div>
  <select name="product" class="select22" id="productSearch"  data-model='html'  <?php \dash\layout\autofocus::html() ?> data-default data-ajax--delay="250" data-ajax--url='<?php echo \dash\url::here(). '/sale'; ?>?json=true' data-shortkey-search data-placeholder='<?php echo T_("Choose product"); ?>'>
  </select>
</div>
<?php } // endfunction ?>


<?php function iFiltercustomer() {?>
  <select name="customer" class="select22"  data-model='html'  data-ajax--url='<?php echo \dash\url::kingdom(); ?>/crm/api?type=sale&json=true&list=customer' data-shortkey-search data-placeholder='<?php echo T_("Choose customer"); ?>'>
        </select>
<?php } // endfunction ?>

<?php function iFilterweekday() {?>
<div class="f">
  <div class="c">
    <div class="radio3">
      <input type="radio" name="weekday" value="saturday" id="weekdaysaturday" <?php if(\dash\request::get('weekday') == 'saturday') {echo 'checked';} ?>>
      <label for="weekdaysaturday"><?php echo T_("saturday"); ?></label>
    </div>
  </div>

  <div class="c">
    <div class="radio3">
      <input type="radio" name="weekday" value="sunday" id="weekdaysunday" <?php if(\dash\request::get('weekday') == 'sunday') {echo 'checked';} ?>>
      <label for="weekdaysunday"><?php echo T_("sunday"); ?></label>
    </div>
  </div>


  <div class="c">
    <div class="radio3">
      <input type="radio" name="weekday" value="monday" id="weekdaymonday" <?php if(\dash\request::get('weekday') == 'monday') {echo 'checked';} ?>>
      <label for="weekdaymonday"><?php echo T_("monday"); ?></label>
    </div>
  </div>



  <div class="c">
    <div class="radio3">
      <input type="radio" name="weekday" value="tuesday" id="weekdaytuesday" <?php if(\dash\request::get('weekday') == 'tuesday') {echo 'checked';} ?>>
      <label for="weekdaytuesday"><?php echo T_("tuesday"); ?></label>
    </div>
  </div>


  <div class="c">
    <div class="radio3">
      <input type="radio" name="weekday" value="wednesday" id="weekdaywednesday" <?php if(\dash\request::get('weekday') == 'wednesday') {echo 'checked';} ?>>
      <label for="weekdaywednesday"><?php echo T_("wednesday"); ?></label>
    </div>
  </div>


  <div class="c">
    <div class="radio3">
      <input type="radio" name="weekday" value="thursday" id="weekdaythursday" <?php if(\dash\request::get('weekday') == 'thursday') {echo 'checked';} ?>>
      <label for="weekdaythursday"><?php echo T_("thursday"); ?></label>
    </div>
  </div>


  <div class="c">
    <div class="radio3">
      <input type="radio" name="weekday" value="friday" id="weekdayfriday" <?php if(\dash\request::get('weekday') == 'friday') {echo 'checked';} ?>>
      <label for="weekdayfriday"><?php echo T_("friday"); ?></label>
    </div>
  </div>


</div>
<?php } // endfunction ?>


<?php function iFilterdate() {?>
<div class="input ltr">
  <input type="text" name="date" title='<?php echo T_("Date"); ?>' placeholder='<?php echo T_("Special date"); ?>' id="date"  value="<?php echo \dash\request::get('date'); ?>" maxlength='20' data-format="date">
</div>
<?php } // endfunction ?>

<?php function iFiltertime() {?>
<div class="input clockpicker" data-placement="top" data-align="left">
  <input type="text" name="time" id="time" placeholder='<?php echo T_("Time"); ?>' value="<?php echo \dash\request::get('time') ?>" autocomplete="off" data-format='time'>
</div>

<?php } // endfunction ?>

<?php function iFilterstartenddate() {?>

    <div class="f">

      <div class="c s12 mB5 pRa5">
        <div class="input ltr">
          <input type="text" name="startdate" title='<?php echo T_("Start date"); ?>' placeholder='<?php echo T_("Start date"); ?>' id="startdate"  value="<?php echo \dash\request::get('startdate'); ?>" maxlength='20' data-format="date" >
        </div>
      </div>

      <div class="c s12 mB5 pRa5">
        <div class="input ltr">
          <input type="text" name="enddate" title='<?php echo T_("End date"); ?>' placeholder='<?php echo T_("End date"); ?>' id="enddate"  value="<?php echo \dash\request::get('enddate'); ?>" maxlength='20' data-format="date" >
        </div>
      </div>

    </div>
<?php } // endfunction ?>


<?php function iFilterprice() {?>

    <div class="f">

      <div class="c s12 mB5 pRa5">
        <div class="input ltr">
          <input  type="number" name="subpricelarger" placeholder='<?php echo T_("Sum price is greater than ..."); ?>'  value="<?php echo \dash\request::get('subpricelarger'); ?>" min="0" max="9999999999999999">
        </div>
      </div>

      <div class="c s12 mB5 pRa5">
        <div class="input ltr">
          <input  type="number" name="subpriceless" placeholder='<?php echo T_("Sum price less than ..."); ?>'  value="<?php echo \dash\request::get('subpriceless'); ?>" min="0" max="9999999999999999">
        </div>
      </div>

      <div class="c s12 mB5 pRa5">
        <div class="input ltr">
          <input  type="number" name="subpriceequal" placeholder='<?php echo T_("Price is equal to ..."); ?>'  value="<?php echo \dash\request::get('subpriceequal'); ?>" min="0" max="9999999999999999">
        </div>
      </div>
    </div>
<?php } // endfunction ?>


<?php function iFilteritem() {?>

    <div class="f">

      <div class="c s12 mB5 pRa5">
        <div class="input ltr">
          <input  type="number" name="itemlarger" placeholder='<?php echo T_("Item is greater than ..."); ?>'  value="<?php echo \dash\request::get('itemlarger'); ?>" min="0" max="9999999999999999">
        </div>
      </div>

      <div class="c s12 mB5 pRa5">
        <div class="input ltr">
          <input  type="number" name="itemless" placeholder='<?php echo T_("Item less than ..."); ?>'  value="<?php echo \dash\request::get('itemless'); ?>" min="0" max="9999999999999999">
        </div>
      </div>

      <div class="c s12 mB5 pRa5">
        <div class="input ltr">
          <input  type="number" name="itemequal" placeholder='<?php echo T_("Item is equal to ..."); ?>'  value="<?php echo \dash\request::get('itemequal'); ?>" min="0" max="9999999999999999">
        </div>
      </div>
    </div>
<?php } // endfunction ?>
<?php function iFiltersum() {?>

    <div class="f">

      <div class="c s12 mB5 pRa5">
        <div class="input ltr">
          <input  type="number" name="qtylarger" placeholder='<?php echo T_("Sum is greater than ..."); ?>'  value="<?php echo \dash\request::get('qtylarger'); ?>" min="0" max="9999999999999999">
        </div>
      </div>

      <div class="c s12 mB5 pRa5">
        <div class="input ltr">
          <input  type="number" name="qtyless" placeholder='<?php echo T_("Sum less than ..."); ?>'  value="<?php echo \dash\request::get('qtyless'); ?>" min="0" max="9999999999999999">
        </div>
      </div>

      <div class="c s12 mB5 pRa5">
        <div class="input ltr">
          <input  type="number" name="qtyequal" placeholder='<?php echo T_("Sum is equal to ..."); ?>'  value="<?php echo \dash\request::get('qtyequal'); ?>" min="0" max="9999999999999999">
        </div>
      </div>
    </div>
<?php } // endfunction ?>

<?php function iFilterdiscount() {?>

    <div class="f">

      <div class="c s12 mB5 pRa5">
        <div class="input ltr">
          <input  type="number" name="subdiscountlarger" placeholder='<?php echo T_("Discount is greater than ..."); ?>'  value="<?php echo \dash\request::get('subdiscountlarger'); ?>" min="0" max="9999999999999999">
        </div>
      </div>

      <div class="c s12 mB5 pRa5">
        <div class="input ltr">
          <input  type="number" name="subdiscountless" placeholder='<?php echo T_("Discount less than ..."); ?>'  value="<?php echo \dash\request::get('subdiscountless'); ?>" min="0" max="9999999999999999">
        </div>
      </div>

      <div class="c s12 mB5 pRa5">
        <div class="input ltr">
          <input  type="number" name="subdiscountequal" placeholder='<?php echo T_("Discount is equal to ..."); ?>'  value="<?php echo \dash\request::get('subdiscountequal'); ?>" min="0" max="9999999999999999">
        </div>
      </div>
    </div>
<?php } // endfunction ?>

<?php function iFiltertype() {?>
<div class="f">
  <div class="c">
    <div class="radio3">
      <input type="radio" name="type" value="sale" id="typesale" <?php if(\dash\request::get('type') === 'sale') {echo 'checked';} ?>>
      <label for="typesale"><?php echo T_("sale"); ?></label>
    </div>
  </div>

  <div class="c">
    <div class="radio3">
      <input type="radio" name="type" value="buy" id="typebuy" <?php if(\dash\request::get('type') === 'buy') {echo 'checked';} ?>>
      <label for="typebuy"><?php echo T_("buy"); ?></label>
    </div>
  </div>


</div>
<?php } // endfunction ?>
