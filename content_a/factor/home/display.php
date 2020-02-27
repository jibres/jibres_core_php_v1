

<div class="f">
  <?php if(\dash\permission::check('factorAccess')) {?>
  <div class="c s12">
    <a class="dcard <?php if(!\dash\request::get('type')) {echo 'active';}  ?>" href='<?php echo \dash\url::this(); ?>' data-shortkey="49shift">
     <div class="statistic gray">
      <div class="value"><?php echo \dash\fit::number(\dash\data::dashboardDetail_all()); ?></div>
      <div class="label"><i class="fs16 mRa5 sf-shop"></i> <?php echo T_("All"); ?></div>
     </div>
    </a>
  </div>
  <?php } //endif ?>

  <?php if(\dash\permission::check('factorSaleList')) {?>
  <div class="c s6">
    <a class="dcard <?php if(\dash\request::get('type') == 'sale') {echo 'active';}  ?>" href='<?php echo \dash\url::this(); ?>?type=sale' data-shortkey="49shift">
     <div class="statistic gray">
      <div class="value"><?php echo \dash\fit::number(\dash\data::dashboardDetail_sale()); ?></div>
      <div class="label"><i class="fs16 mRa5 sf-cloud-upload"></i> <?php echo T_("Sale"); ?></div>
     </div>
    </a>
  </div>
  <?php } //endif ?>

  <?php if(\dash\permission::check('factorBuyList')) {?>
  <div class="c s6">
    <a class="dcard <?php if(\dash\request::get('type') == 'buy') {echo 'active';}  ?>" href='<?php echo \dash\url::this(); ?>?type=buy' data-shortkey="49shift">
     <div class="statistic gray">
      <div class="value"><?php echo \dash\fit::number(\dash\data::dashboardDetail_buy()); ?></div>
      <div class="label"><i class="fs16 mRa5 sf-cloud-download"></i> <?php echo T_("Buy"); ?></div>
     </div>
    </a>
  </div>
  <?php } //endif ?>



</div>



<?php


if(\dash\data::dataTable())
{
  if(\dash\data::dataFilter())
  {

    htmlSearchBox();
    htmlTable();
    htmlFilter();

  }
  else
  {
    htmlSearchBox();
    htmlTable();
  }
}
else
{
  if(\dash\data::dataFilter())
  {

    htmlSearchBox();
    htmlFilterNoResult();


  }
  else
  {
    htmlStartAddNew();

  }

}
?>





<?php function htmlSearchBox() {?>
<div class="cbox fs12">
  <form method="get" action='<?php echo \dash\url::this(); ?>' data-action>
    <div class="input">
    <label for="q" data-kerkere=".ShowFilterResult" data-kerkere-icon class="addon"><?php echo T_("Advance result"); ?></label>
      <input type="search" name="q" placeholder='<?php echo T_("Search"); ?>' id="q" value="<?php echo \dash\request::get('q'); ?>" autofocus autocomplete='off'>

      <?php if(\dash\request::get('type')) {?>

      <input type="hidden" name="type" value="<?php echo \dash\request::get('type'); ?>">

      <?php } // endif ?>

      <button class="addon btn "><?php echo T_("Search"); ?></button>
    </div>
    <?php iKerkere(); ?>
  </form>
</div>
<?php } //endfunction ?>




<?php function htmlTable() {?>

<?php
$dataTable = \dash\data::dataTable();
if(!is_array($dataTable))
{
  $dataTable = [];
}
$andType = \dash\request::get('type') ? '&type='. \dash\request::get('type') : null;
$sortLink = \dash\data::sortLink();
?>

  <table class="tbl1 v6 fs12 txtC">
    <thead>
      <tr class="fs08">
        <th data-sort="<?php echo \dash\get::index($sortLink, 'customer', 'order'); ?>"><a href="<?php echo \dash\get::index($sortLink, 'customer', 'link'); ?>"><?php echo T_("Customer"); ?></a></th>
        <th class="s0" data-sort="<?php echo \dash\get::index($sortLink, 'item', 'order'); ?>"><a href="<?php echo \dash\get::index($sortLink, 'item', 'link'); ?>"><?php echo T_("Items"); ?></a></th>
        <th class="s0" data-sort="<?php echo \dash\get::index($sortLink, 'qty', 'order'); ?>"><a href="<?php echo \dash\get::index($sortLink, 'qty', 'link'); ?>"><?php echo T_("Qty"); ?></a></th>
        <th class="s0" data-sort="<?php echo \dash\get::index($sortLink, 'subprice', 'order'); ?>"><a href="<?php echo \dash\get::index($sortLink, 'subprice', 'link'); ?>"><?php echo T_("Price"); ?></a></th>
        <th class="s0" data-sort="<?php echo \dash\get::index($sortLink, 'subdiscount', 'order'); ?>"><a href="<?php echo \dash\get::index($sortLink, 'subdiscount', 'link'); ?>"><?php echo T_("Discount"); ?></a></th>
        <th class="s0" data-sort="<?php echo \dash\get::index($sortLink, 'subvat', 'order'); ?>"><a href="<?php echo \dash\get::index($sortLink, 'subvat', 'link'); ?>"><?php echo T_("VAT"); ?></a></th>
        <th data-sort="<?php echo \dash\get::index($sortLink, 'subtotal', 'order'); ?>"><a href="<?php echo \dash\get::index($sortLink, 'subtotal', 'link'); ?>"><?php echo T_("Total"); ?></a></th>
        <th data-sort="<?php echo \dash\get::index($sortLink, 'date', 'order'); ?>"><a href="<?php echo \dash\get::index($sortLink, 'date', 'link'); ?>"><?php echo T_("Invoice Date"); ?></a></th>

        <?php if(!\dash\request::get('type')) {?>
          <th class="s0" data-sort="<?php echo \dash\get::index($sortLink, 'type', 'order'); ?>"><a href="<?php echo \dash\get::index($sortLink, 'type', 'link'); ?>"><?php echo T_("Type"); ?></a></th>
        <?php } //endif ?>

        <th><?php echo T_("Operation"); ?></th>
      </tr>

    </thead>
    <tbody>
      <?php foreach ($dataTable as $key => $value) {?>

        <tr>
          <td>
            <?php if(isset($value['customer'])) {?>

            <a href="<?php echo \dash\url::this(); ?>?customer=<?php echo \dash\get::index($value, 'customer'); ?>">
              <?php if(isset($value['customer_firstname']) || isset($value['customer_lastname'])) {?>

              <?php echo \dash\get::index($value, 'customer_firstname'); ?> <b><?php echo \dash\get::index($value, 'customer_lastname'); ?></b>

            <?php } //endif ?>

            <?php if(isset($value['customer_displayname'])) {?>

               <b><?php echo \dash\get::index($value, 'customer_displayname'); ?></b>

            <?php }else{ ?>

              <small><?php echo T_("Whithout name"); ?></small>

            <?php } // endif ?>

            </a>


          <?php }else{ ?>

            <a href="<?php echo \dash\url::this(); ?>?customer=-quick">
              <small class="disabled"><?php echo T_("Quick"); ?></small>
            </a>

          <?php } //endif ?>

          </td>
          <td class="s0"><a href="<?php echo \dash\url::this(); ?>?itemequal=<?php echo \dash\get::index($value, 'item'); ?><?php echo $andType; ?>"><?php echo \dash\fit::number(\dash\get::index($value, 'item')); ?></a></td>
          <td class="s0"><a href="<?php echo \dash\url::this(); ?>?qtyequal=<?php echo \dash\get::index($value, 'qty'); ?><?php echo $andType; ?>"><?php echo \dash\fit::number(\dash\get::index($value, 'qty')); ?></a></td>
          <td class="s0"><a href="<?php echo \dash\url::this(); ?>?subpriceequal=<?php echo \dash\get::index($value, 'subprice'); ?><?php echo $andType; ?>"><?php echo \dash\fit::number(\dash\get::index($value, 'subprice')); ?></a></td>
          <td class="s0"><a href="<?php echo \dash\url::this(); ?>?subdiscountequal=<?php echo \dash\get::index($value, 'subdiscount'); ?><?php echo $andType; ?>"><?php echo \dash\fit::number(\dash\get::index($value, 'subdiscount')); ?></a></td>
          <td class="s0"><a href="<?php echo \dash\url::this(); ?>?subpriceequal=<?php echo \dash\get::index($value, 'subvat'); ?><?php echo $andType; ?>"><?php echo \dash\fit::number(\dash\get::index($value, 'subvat')); ?></a></td>
          <td ><a href="<?php echo \dash\url::this(); ?>?subtotal=<?php echo \dash\get::index($value, 'subtotal'); ?><?php echo $andType; ?>"><?php echo \dash\fit::number(\dash\get::index($value, 'subtotal')); ?></a></td>
          <td class="collapsing">
            <div class="f">
              <div class="c fs09"><?php echo \dash\fit::date_time(\dash\get::index($value, 'date')); ?>
              <div class="cauto os txtB pRa10"><?php echo \dash\fit::date_human(\dash\get::index($value, 'date')); ?></div>
            </div>
          </td>
          <?php if(!\dash\request::get('type')) {?>

          <td class="s0" ><a class="badge" href="<?php echo \dash\url::this(); ?>?type=<?php echo \dash\get::index($value, 'type'); ?>"><?php echo T_(ucfirst(\dash\get::index($value, 'type'))); ?></a></td>
          <?php } //endif ?>
          <td>
            <a href="<?php echo \dash\url::here(); ?>/chap/receipt?id=<?php echo \dash\get::index($value, 'id'); ?>&size=receipt8" class="btn primary outline sm"><?php echo T_("View"); ?></a>
          </td>
        </tr>
        <tr>
          <td colspan="<?php if(!\dash\request::get('type')) {echo 10;}else{echo 9;}?>" class="pTB0-f txtLa">

            <?php

            $productInFactor = [];
            if(isset($value['productInFactor']) && $value['productInFactor'] && is_array($value['productInFactor']))
            {
              $productInFactor = $value['productInFactor'];
            }

            $needMore    = false;
            $openKerkere = false;
            $counterI    = 0;

            ?>

            <?php foreach ($productInFactor as $myKey => $myValue) {?>

              <?php $counterI++; ?>

              <?php if($counterI == 7) {?>

                <?php $needMore = true; ?>


                <a data-kerkere='.openDetailFactor_<?php echo \dash\get::index($value, 'id'); ?>' class="badge primary outline"><?php echo T_("More"); ?> ... <span class="mLR5">+<?php echo \dash\fit::number(intval($value['item']) - 6); ?></span></a>
              <?php } //endif ?>

              <?php if($needMore) {?>

                <?php $openKerkere = true;  ?>
                <?php $needMore = false;  ?>


                <div class="openDetailFactor_<?php echo \dash\get::index($value, 'id'); ?>" data-kerkere-content='hide'>
              <?php } //endif ?>

                <a class="badge <?php if(\dash\request::get('product') == $myValue['id'])  {echo 'primary';}else{ echo 'secondary outline';}?> " href="<?php echo \dash\url::this(); ?>?product=<?php echo \dash\get::index($myValue, 'id'); ?>"><?php echo \dash\get::index($myValue, 'title'); ?> <span class="mLR5"><?php echo \dash\fit::number(\dash\get::index($myValue, 'count')); ?></span></a>

            <?php } //endfor ?>

              <?php if($openKerkere) {?>
                </div>
              <?php }//endif ?>

          </td>
        </tr>
      <?php } //endfor ?>
    </tbody>
  </table>

<?php \dash\utility\pagination::html(); ?>

<?php } // endfunction ?>




<?php function htmlFilter() {?>
<p class="f fs14 msg warn2 mT20">
  <span class="c"><?php echo \dash\data::filterBox(); ?></span>
  <a class="cauto" href="<?php echo \dash\url::this(); ?>"><?php echo T_("Clear filters"); ?></a>
</p>
<?php } // endfunction ?>


<?php function htmlFilterNoResult() {?>
<p class="f fs14 msg warn2">
  <span class="c"><?php echo T_("Result not found!"); ?> <?php echo T_("Search with new keywords."); ?></span>
  <a class="cauto" href="<?php echo \dash\url::this(); ?>"><?php echo T_("Clear filters"); ?></a>
</p>
<?php } // endfunction ?>


<?php function htmlStartAddNew() {?>
<p class="fs14 msg success2 pTB20"><?php echo T_("Hi!"); ?>
  <?php if(\dash\permission::check('factorSaleAdd')) {?><a href="<?php echo \dash\url::here(); ?>/sale"><?php echo T_("Try to start with add new sale!"); ?></a><?php } // endif ?>
  <?php if(\dash\permission::check('factorBuyAdd')) {?><a href="<?php echo \dash\url::here(); ?>/buy"><?php echo T_("Try to start with add new buy!"); ?></a><?php } // endif ?>
</p>
<?php } // endfunction ?>












<?php function iKerkere() {?>



<div class="ShowFilterResult"
<?php

if(
 !\dash\request::get('product') &&
 !\dash\request::get('customer') &&
 !\dash\request::get('weekday') &&
 !\dash\request::get('date') &&
 !\dash\request::get('time') &&
 !\dash\request::get('startdate') &&
 !\dash\request::get('enddate') &&

 !\dash\request::get('subpricelarger') &&
 !\dash\request::get('subpriceless') &&
 !\dash\request::get('subpriceequal') &&

 !\dash\request::get('itemlarger') &&
 !\dash\request::get('itemless') &&
 !\dash\request::get('itemequal') &&

 !\dash\request::get('subdiscountlarger') &&
 !\dash\request::get('subdiscountless') &&
 !\dash\request::get('subdiscountequal') &&

 !\dash\request::get('qtylarger') &&
 !\dash\request::get('qtyless') &&
 !\dash\request::get('qtyequal') &&

 !\dash\request::get('type')
)
{ echo "data-kerkere-content='hide'" ;}
?>>

    <h6 data-kerkere=".showFilterByproduct" data-kerkere-icon><?php echo T_("Filter by product"); ?></h6>
    <div class="showFilterByproduct" <?php if(!\dash\request::get('product')) { echo "data-kerkere-content='hide' ";} ?>>
      <?php iFilterproduct(); ?>
    </div>

    <h6 data-kerkere=".showFilterBycustomer" data-kerkere-icon><?php echo T_("Filter by customer"); ?></h6>
    <div class="showFilterBycustomer" <?php if(!\dash\request::get('customer')) { echo "data-kerkere-content='hide' ";} ?>>
      <?php iFiltercustomer(); ?>
    </div>

    <h6 data-kerkere=".showFilterByweekday" data-kerkere-icon><?php echo T_("Filter by weekday"); ?></h6>
    <div class="showFilterByweekday" <?php if(!\dash\request::get('weekday')) { echo "data-kerkere-content='hide' ";} ?>>
      <?php iFilterweekday(); ?>
    </div>

    <h6 data-kerkere=".showFilterBydate" data-kerkere-icon><?php echo T_("Filter by date"); ?></h6>
    <div class="showFilterBydate" <?php if(!\dash\request::get('date')) { echo "data-kerkere-content='hide' ";} ?>>
      <?php iFilterdate(); ?>
    </div>

    <h6 data-kerkere=".showFilterBytime" data-kerkere-icon><?php echo T_("Filter by time"); ?></h6>
    <div class="showFilterBytime" <?php if(!\dash\request::get('time')) { echo "data-kerkere-content='hide' ";} ?>>
      <?php iFiltertime(); ?>
    </div>

    <h6 data-kerkere=".showFilterBystartenddate" data-kerkere-icon><?php echo T_("Filter by start and end date"); ?></h6>
    <div class="showFilterBystartenddate"  <?php if(!\dash\request::get('enddate') && !\dash\request::get('startdate')) { echo "data-kerkere-content='hide' ";} ?>>
      <?php iFilterstartenddate(); ?>
    </div>

    <h6 data-kerkere=".showFilterByprice" data-kerkere-icon><?php echo T_("Filter by price"); ?></h6>
    <div class="showFilterByprice"  <?php if(!\dash\request::get('subpriceequal') && !\dash\request::get('subpriceless') && !\dash\request::get('subpricelarger')) { echo "data-kerkere-content='hide' ";} ?>>
      <?php iFilterprice(); ?>
    </div>


    <h6 data-kerkere=".showFilterByitem" data-kerkere-icon><?php echo T_("Filter by item"); ?></h6>
    <div class="showFilterByitem"  <?php if(!\dash\request::get('itemequal') && !\dash\request::get('itemlarger') && !\dash\request::get('itemless')) { echo "data-kerkere-content='hide' ";} ?>>
      <?php iFilteritem(); ?>
    </div>

    <h6 data-kerkere=".showFilterBydiscount" data-kerkere-icon><?php echo T_("Filter by discount"); ?></h6>
    <div class="showFilterBydiscount"  <?php if(!\dash\request::get('subdiscountequal') && !\dash\request::get('subdiscountless')) { echo "data-kerkere-content='hide' ";} ?>>
      <?php iFilterdiscount(); ?>
    </div>

    <h6 data-kerkere=".showFilterBysum" data-kerkere-icon><?php echo T_("Filter by count"); ?></h6>
    <div class="showFilterBysum"  <?php if(!\dash\request::get('qtyequal') && !\dash\request::get('qtylarger')  && !\dash\request::get('qtyless')) { echo "data-kerkere-content='hide' ";} ?>>
      <?php iFiltersum(); ?>
    </div>

    <h6 data-kerkere=".showFilterBytype" data-kerkere-icon><?php echo T_("Filter by type"); ?></h6>
    <div class="showFilterBytype" <?php if(!\dash\request::get('type')) { echo "data-kerkere-content='hide' ";} ?>>
      <?php iFiltertype(); ?>
    </div>



    <div class="mT10">
      <a href="<?php echo \dash\url::this(); ?>" class="btn "><?php echo T_("Clear filter"); ?></a>
      <button class="btn primary"><?php echo T_("Apply"); ?></button>
    </div>

</div>

<?php } // endfunction ?>




<?php function iFilterproduct() {?>
<select name="product" class="ui dropdown search" id="product" data-source='<?php echo \dash\url::here(); ?>/product?json=true&q={query}'>
  <option value="" readonly><?php echo T_("Please choose product"); ?></option>
</select>
<?php } // endfunction ?>



<?php function iFiltercustomer() {?>
<select name="customer" class="ui dropdown search" id="customer" data-source='<?php echo \dash\url::here(); ?>/thirdparty?json=true&q={query}'>
  <option value="" readonly><?php echo T_("Please choose product"); ?></option>
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
  <input class="datepicker" type="text" name="date" title='<?php echo T_("Date"); ?>' placeholder='<?php echo T_("Special date"); ?>' id="date"  value="<?php echo \dash\data::dateEn(); ?>" maxlength='20' data-format="YYYYMMDD"data-view="month">
</div>
<?php } // endfunction ?>

<?php function iFiltertime() {?>
<div class="input clockpicker" data-placement="top" data-align="left">
  <input type="text" name="time" id="time" placeholder='<?php echo T_("Time"); ?>' autocomplete="off">
</div>

<?php } // endfunction ?>


<?php function iFilterstartenddate() {?>

    <div class="f">

      <div class="c s12 mB5 pRa5">
        <div class="input ltr">
          <input class="datepicker" type="text" name="startdate" title='<?php echo T_("Start date"); ?>' placeholder='<?php echo T_("Start date"); ?>' id="startdate"  value="<?php echo \dash\data::startdateEn(); ?>" maxlength='20' data-format="YYYYMMDD"data-view="month">
        </div>
      </div>

      <div class="c s12 mB5 pRa5">
        <div class="input ltr">
          <input class="datepicker" type="text" name="enddate" title='<?php echo T_("End date"); ?>' placeholder='<?php echo T_("End date"); ?>' id="enddate"  value="<?php echo \dash\data::enddateEn(); ?>" maxlength='20' data-format="YYYYMMDD"data-view="month">
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




