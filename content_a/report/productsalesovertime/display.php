<?php

$starttime = '<label for="starttime">'. T_("Start time"). '</label>';
$starttime .= '<div class="input">';
{
  $starttime .= '<input type="tel" name="starttime" value="'. \dash\data::myArgs_starttime().'" data-format="time" id="starttime">';
}
$starttime .= '</div>';


$endtime = '<label for="endtime">'. T_("End time"). '</label>';
$endtime .= '<div class="input">';
{
  $endtime .= '<input type="tel" name="endtime" value="'. \dash\data::myArgs_endtime().'" data-format="time" id="endtime">';
}
$endtime .= '</div>';

?>

<form method="get" autocomplete="off" action="<?php echo \dash\url::that() ?>"  data-timeout="0">
  <?php if(\dash\request::get('type')) {?>
    <input type="hidden" name="type" value="<?php echo \dash\request::get('type') ?>">
  <?php } //endif ?>
  <div class="box">
    <div class="pad">

      <p><?php echo T_("Choose spcial product") ?></p>
          <div class="mb-2">
            <select name="product" class="select22" id="productSearch"  data-model='html' <?php \dash\layout\autofocus::html() ?>  data-ajax--delay="250" data-ajax--url='<?php echo \dash\url::here(). '/products/api'; ?>?json=true' data-shortkey-search data-placeholder='<?php echo T_("Choose spcial product"); ?> +'>
              <?php if(\dash\data::summaryDetail_producttitle()) {?>
                <option value="<?php echo \dash\data::summaryDetail_productid() ?>" selected><?php echo \dash\data::summaryDetail_producttitle() ?></option>
              <?php } ?>
            </select>
          </div>

      <?php if(\dash\data::myArgs_type() === 'date') {?>
        <div class="row">
          <div class="c-xs-12 c-sm-4">
            <label for="date"><?php echo T_("Date"); ?></label>
            <div class="input">
              <input type="tel" name="date" value="<?php echo \dash\data::myArgs_date() ?>" data-format="date" id="date">
            </div>
          </div>
          <div class="c-xs-12 c-sm-4"><?php echo $starttime ?></div>
          <div class="c-xs-12 c-sm-4"><?php echo $endtime ?></div>
        </div>
    <?php } //endif ?>
    <?php if(\dash\data::myArgs_type() === 'period') {?>
      <div class="row">
        <div class="c">
          <label for="startdate"><?php echo T_("Start Date"); ?></label>
          <div class="input">
            <input type="tel" name="startdate" value="<?php echo \dash\data::myArgs_startdate() ?>" data-format="date" id="startdate">
          </div>
        </div>
        <div class="c">
          <label for="enddate"><?php echo T_("End Date"); ?></label>
          <div class="input">
            <input type="tel" name="enddate" value="<?php echo \dash\data::myArgs_enddate() ?>" data-format="date" id="enddate">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="c"><?php echo $starttime ?></div>
        <div class="c"><?php echo $endtime ?></div>
      </div>
    <?php } //endif ?>
    <?php if(\dash\data::myArgs_type() === 'year') {?>
      <label for="year"><?php echo T_("Year") ?></label>
      <select name="year" class="select22">
        <?php foreach (\dash\data::yearList() as $key => $value) {?>
          <option value="<?php echo $value['year'] ?>" <?php if(intval($value['year']) === intval(\dash\data::myArgs_year())) {echo 'selected';} ?>><?php echo $value['title']; ?></option>
        <?php }  //endif ?>
      </select>
    <?php } //endif ?>
    <?php if(\dash\data::myArgs_type() === 'month') {?>
      <div class="row">
        <div class="c">
          <label for="year"><?php echo T_("Year") ?></label>
          <select name="year" class="select22">
            <?php foreach (\dash\data::yearList() as $key => $value) {?>
              <option value="<?php echo $value['year'] ?>" <?php if(intval($value['year']) === intval(\dash\data::myArgs_year())) {echo 'selected';} ?>><?php echo $value['title']; ?></option>
            <?php }  //endif ?>
          </select>
        </div>
        <div class="c">
          <label for="month"><?php echo T_("Month") ?></label>
          <select name="month" class="select22">
            <?php for ($i=1; $i <= 12 ; $i++) { ?>
              <option value="<?php echo $i ?>" <?php if(intval($i) === intval(\dash\data::myArgs_month())) {echo 'selected';} ?>><?php echo \dash\fit::number($i); ?></option>
            <?php }  //endif ?>
          </select>
        </div>
      </div>
    <?php } //endif ?>

      <div class="row">
        <div class="c-auto">
          <div class="w-64">
            <label for="sort"><?php echo T_("Sort by") ?></label>
            <select name="sort" class="select22">
              <?php foreach (\dash\data::sortList() as $key => $value) {?>
                <option value="<?php echo $value['key']; ?>" <?php if($value['key'] === \dash\data::myArgs_sort()) {echo 'selected';} ?>><?php echo $value['title']; ?></option>
              <?php }  //endif ?>
            </select>
          </div>
        </div>
        <div class="c"></div>
        <div class="c-auto">
            <button class="btn-primary mt-6"><?php echo T_("Report") ?></button>
        </div>
      </div>

    </div>
  </div>
</form>
<?php if(\dash\data::summaryDetail()) { ?>
<div class="row mb-2">
  <?php if(floatval(\dash\data::summaryDetail_count())) {?>
    <div class="c-xs-12 c-sm-12 c-md-6 c-lg-4">
      <div class="bg-blue-100 p-5 m-1 rounded-lg text-center">
        <?php echo T_("Product") ?>
        <div class="font-bold text-xl"><?php echo \dash\fit::number_decimal(\dash\data::summaryDetail_count()); ?></div>
      </div>
  </div>
  <?php } //endif ?>
  <?php if(floatval(\dash\data::summaryDetail_countorder())) {?>
    <div class="c-xs-12 c-sm-12 c-md-6 c-lg-4">
      <div class="bg-blue-100 p-5 m-1 rounded-lg text-center">
        <?php echo T_("Orders") ?>
        <div class="font-bold text-xl"><?php echo \dash\fit::number_decimal(\dash\data::summaryDetail_countorder()); ?></div>
      </div>
  </div>
  <?php } //endif ?>
  <?php if(floatval(\dash\data::summaryDetail_price())) {?>
    <div class="c-xs-12 c-sm-12 c-md-6 c-lg-4">
      <div class="bg-blue-100 p-5 m-1 rounded-lg text-center">
        <?php echo T_("Gross sales") ?>
        <div class="font-bold text-xl"><?php echo \dash\fit::number_decimal(\dash\data::summaryDetail_price()); ?></div>
      </div>
  </div>
  <?php } //endif ?>
  <?php if(floatval(\dash\data::summaryDetail_vat())) {?>
    <div class="c-xs-12 c-sm-12 c-md-6 c-lg-4">
      <div class="bg-blue-100 p-5 m-1 rounded-lg text-center">
        <?php echo T_("Vat") ?>
        <div class="font-bold text-xl"><?php echo \dash\fit::number_decimal(\dash\data::summaryDetail_vat()); ?></div>
      </div>
  </div>
  <?php } //endif ?>
  <?php if(floatval(\dash\data::summaryDetail_discount())) {?>
    <div class="c-xs-12 c-sm-12 c-md-6 c-lg-4">
      <div class="bg-blue-100 p-5 m-1 rounded-lg text-center">
        <?php echo T_("Discounts") ?>
        <div class="font-bold text-xl"><?php echo \dash\fit::number_decimal(\dash\data::summaryDetail_discount()); ?></div>
      </div>
  </div>
  <?php } //endif ?>
  <?php if(floatval(\dash\data::summaryDetail_shipping())) {?>
    <div class="c-xs-12 c-sm-12 c-md-6 c-lg-4">
      <div class="bg-blue-100 p-5 m-1 rounded-lg text-center">
        <?php echo T_("Shipping") ?>
        <div class="font-bold text-xl"><?php echo \dash\fit::number_decimal(\dash\data::summaryDetail_shipping()); ?></div>
      </div>
  </div>
  <?php } //endif ?>
  <?php if(floatval(\dash\data::summaryDetail_total())) {?>
    <div class="c-xs-12 c-sm-12 c-md-6 c-lg-4">
      <div class="bg-blue-100 p-5 m-1 rounded-lg text-center">
        <?php echo T_("Total sales") ?>
        <div class="font-bold text-xl"><?php echo \dash\fit::number_decimal(\dash\data::summaryDetail_total()); ?></div>
      </div>
  </div>
  <?php } //endif ?>
</div>

<?php } // endif ?>


<?php if(\dash\data::dataTable()) {
$currency = \lib\store::currency();
?>
<div class="tblBox">
  <table class="tbl1 v1">
    <thead>
      <tr>
        <th><?php echo T_("Product") ?></th>
        <th><?php echo T_("Orders") ?></th>
        <th><?php echo T_("Gross sales") ?></th>
        <?php if(!\dash\data::hiddenVat()) {?>
          <th><?php echo T_("Vat") ?></th>
        <?php } //endif ?>
        <th><?php echo T_("Discounts") ?></th>
        <th><?php echo T_("Ordered quantity") ?></th>
        <th><?php echo T_("Total sales") ?></th>

      </tr>
    </thead>
    <tbody>
      <?php foreach (\dash\data::dataTable() as $key => $value) { ?>
        <tr>
          <td><a class="link-primary" href="<?php echo \dash\url::here(). '/products/edit?id='. a($value, 'product_id') ?>"><?php echo a($value, 'product_title') ?></a></td>
          <td><?php echo \dash\fit::number_decimal(a($value, 'count')) ?></td>
          <td><?php echo \dash\fit::number_decimal(a($value, 'price')); if(floatval(a($value, 'price'))){ echo ' <small class="text-gray-400">'. $currency. '</small>'; }?></td>
          <?php if(!\dash\data::hiddenVat()) {?>
            <td><?php echo \dash\fit::number_decimal(a($value, 'vat')); if(floatval(a($value, 'vat'))){ echo ' <small class="text-gray-400">'. $currency. '</small>'; }?></td>
          <?php }  // endif ?>
          <td><?php echo \dash\fit::number_decimal(a($value, 'discount')); if(floatval(a($value, 'discount'))){ echo ' <small class="text-gray-400">'. $currency. '</small>'; }?></td>
          <td><?php echo \dash\fit::number_decimal(a($value, 'qty'));  if(floatval(a($value, 'qty'))){ echo ' <small class="text-gray-400">'. a($value, 'product_unit'). '</small>'; } ?></td>
          <td><?php echo \dash\fit::number_decimal(a($value, 'sum')); if(floatval(a($value, 'sum'))){ echo ' <small class="text-gray-400">'. $currency. '</small>'; }?></td>
        </tr>
      <?php } //endfor ?>
    </tbody>
  </table>
</div>
<?php echo \dash\utility\pagination::html(); ?>
<?php }else{ ?>
  <div class="alert-info text-center"><?php echo T_("No product was sale in this date") ?></div>
<?php } //endif ?>