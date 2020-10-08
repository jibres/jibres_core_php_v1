<?php

function BoxProductFilter()
{

  $andQ = \dash\request::get('q') ? '&q='. \dash\request::get('q') : null;
  if(\dash\data::productFilterList()) {?>


  <p><?php echo T_("Show all products where"); ?></p>
    <div class="mB20">

    <?php foreach (\dash\data::productFilterList() as $key => $value) {?>
      <a class='btn <?php if(\dash\get::index($value, 'is_active')) { echo 'primary2'; }else{ echo 'light';} ?>  mB5 ' href="<?php echo \dash\url::that(). '?'. \dash\get::index($value, 'query_string'); ?>"><?php echo \dash\get::index($value, 'title'); ?></a>
    <?php } //endfor ?>
    </div>

<div class="txtRa fs12">
  <?php if(\dash\request::get()) {?>
    <a class="btn outline" href="<?php echo \dash\url::that(); ?>"><?php echo T_("Clear filters"); ?></a>
  <?php }//endif ?>

  <button class="btn primary"><?php echo T_("Apply"); ?></button>
</div>
<?php } // endif ?>
<?php } //endfunction ?>




<?php function htmlSearchBox() {?>
<form method="get" action="<?php echo \dash\url::that(); ?>">

  <?php  if(\dash\data::productFilterList()) {?>
    <?php foreach (\dash\data::productFilterList() as $key => $value) {?>
      <?php if(\dash\get::index($value, 'is_active')) {?>
        <?php foreach ($value['query'] as $k => $v) {?>
          <input type="hidden" name="<?php echo $k ?>" value="<?php echo $v ?>">
        <?php } //endfor ?>
      <?php } //endif ?>
    <?php } //endfor ?>
  <?php } //endif ?>


  <div class="searchBox">
    <div class="f">
      <div class="cauto pRa10">
        <a class="btn light3 <?php if(\dash\data::isFiltered()) { echo 'apply'; }?>" data-kerkere-icon="close" data-kerkere='.filterBox'><?php echo T_("Filter"); ?></a>
      </div>
      <div class="c pRa10">
        <div>
          <div class="input search <?php if(\dash\request::get('q')) { echo 'apply'; }?>">
            <input type="search" name="q" placeholder='<?php echo T_("Search products"); ?>' id="q" value="<?php echo \dash\request::get('q'). \dash\request::get('barcode'); ?>" class="barCode" data-default data-pass='submit' autocomplete='off' autofocus>
            <button class="addon btn light3 s0"><i class="sf-search"></i></button>
          </div>
        </div>
      </div>

      <div class="cauto">
        <select class="select22 <?php if(\dash\request::get('sort') || \dash\request::get('order')) { echo 'apply'; }?>" data-link>
          <option><i class="sf-sort mRa5"></i><span><?php echo T_("Sort"); ?></span></div>
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

<?php if(\dash\request::get('filter')) {?>

<div class="applyFilters">

  <?php if(\dash\request::get('duplicatetitle')) {?><a class="btn danger2 sm mRa5" href="<?php echo \dash\url::that(); ?>"><span><?php echo T_("Duplicate title"); ?></span><i class="fc-red pLa10 sf-times"></i></a><?php }// endif ?>
  <?php if(\dash\request::get('hbarcode')) {?><a class="btn danger2 sm mRa5" href="<?php echo \dash\url::that(); ?>"><span><?php echo T_("Have barcode"); ?></span><i class="fc-red pLa10 sf-times"></i></a><?php }// endif ?>
  <?php if(\dash\request::get('hnotbarcode')) {?><a class="btn danger2 sm mRa5" href="<?php echo \dash\url::that(); ?>"><span><?php echo T_("Have not barcode"); ?></span><i class="fc-red pLa10 sf-times"></i></a><?php }// endif ?>
  <?php if(\dash\request::get('wbuyprice')) {?><a class="btn danger2 sm mRa5" href="<?php echo \dash\url::that(); ?>"><span><?php echo T_("Without buyprice"); ?></span><i class="fc-red pLa10 sf-times"></i></a><?php }// endif ?>
  <?php if(\dash\request::get('wprice')) {?><a class="btn danger2 sm mRa5" href="<?php echo \dash\url::that(); ?>"><span><?php echo T_("Without price"); ?></span><i class="fc-red pLa10 sf-times"></i></a><?php }// endif ?>
  <?php if(\dash\request::get('wdiscount')) {?><a class="btn danger2 sm mRa5" href="<?php echo \dash\url::that(); ?>"><span><?php echo T_("Without discount"); ?></span><i class="fc-red pLa10 sf-times"></i></a><?php }// endif ?>

  <?php if(false) {?>
    <a class="btn primary outline sm mLa10 floatRa s0" href="<?php echo \dash\url::that(); ?>"><span class="">Save Search</span><i class="pLa10 sf-save"></i></a>
  <?php } //endif ?>

</div>
<?php } //endif ?>

  <?php if(\dash\permission::check('productAdvanceSearchView')) {?>

  <div class="filterBox" data-kerkere-content='hide'>
    <?php BoxProductFilter(); ?>
  </div>
  <?php } //endif ?>

</form>
<?php } //endfunction ?>
