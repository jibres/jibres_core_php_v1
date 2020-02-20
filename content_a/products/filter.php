<?php function BoxProductFilter() {?>

<?php

$andQ = \dash\request::get('q') ? '&q='. \dash\request::get('q') : null;

?>

<p><?php echo T_("Show all products where"); ?></p>

<div class="f align-center">

  <div class="c">
    <a class='btn <?php if(\dash\request::get('duplicatetitle')) { echo 'primary2'; }else{ echo 'light';} ?>  mB5 ' href="<?php echo \dash\url::that(); ?>?filter=1&duplicatetitle=1<?php echo $andQ; ?>"><?php echo T_("Duplicate title"); ?></a>
    <a class='btn <?php if(\dash\request::get('hbarcode')) { echo 'primary2'; }else{ echo 'light';} ?> mB5 ' href="<?php echo \dash\url::that(); ?>?filter=1&hbarcode=1<?php echo $andQ; ?>"><?php echo T_("Have barcode"); ?></a>
    <a class='btn <?php if(\dash\request::get('hnotbarcode')) { echo 'primary2'; }else{ echo 'light';} ?> mB5' href="<?php echo \dash\url::that(); ?>?filter=1&hnotbarcode=1<?php echo $andQ; ?>"><?php echo T_("Have not barcode"); ?></a>
    <a class='btn <?php if(\dash\request::get('wbuyprice')) { echo 'primary2'; }else{ echo 'light';} ?> mB5' href="<?php echo \dash\url::that(); ?>?filter=1&wbuyprice=1<?php echo $andQ; ?>"><?php echo T_("Whithout buyprice"); ?></a>
    <a class='btn <?php if(\dash\request::get('wprice')) { echo 'primary2'; }else{ echo 'light';} ?> mB5' href="<?php echo \dash\url::that(); ?>?filter=1&wprice=1<?php echo $andQ; ?>"><?php echo T_("Whithout price"); ?></a>
    <a class='btn <?php if(\dash\request::get('wdiscount')) { echo 'primary2'; }else{ echo 'light';} ?> mB5' href="<?php echo \dash\url::that(); ?>?filter=1&wdiscount=1<?php echo $andQ; ?>"><?php echo T_("Whithout discount"); ?></a>
  </div>
</div>

<div class="txtRa fs12">
  <a class="btn outline" href="<?php echo \dash\url::that(); ?>"><?php echo T_("Clear filters"); ?></a>
  <button class="btn primary"><?php echo T_("Apply"); ?></button>
</div>
<?php } //endfunction ?>




<?php function htmlSearchBox() {?>
<form method="get" action="<?php echo \dash\url::that(); ?>">

  <?php if(\dash\request::get('filter')) {?><input type="hidden" name="filter" value="1"><?php } //endif ?>
  <?php if(\dash\request::get('duplicatetitle')) {?><input type="hidden" name="duplicatetitle" value="1"><?php } //endif ?>
  <?php if(\dash\request::get('hbarcode')) {?><input type="hidden" name="hbarcode" value="1"><?php } //endif ?>
  <?php if(\dash\request::get('hnotbarcode')) {?><input type="hidden" name="hnotbarcode" value="1"><?php } //endif ?>
  <?php if(\dash\request::get('wbuyprice')) {?><input type="hidden" name="wbuyprice" value="1"><?php } //endif ?>
  <?php if(\dash\request::get('wprice')) {?><input type="hidden" name="wprice" value="1"><?php } //endif ?>
  <?php if(\dash\request::get('wdiscount')) {?><input type="hidden" name="wdiscount" value="1"><?php } //endif ?>

  <div class="searchBox">
    <div class="f">
      <div class="cauto pRa10">
        <a class="btn light3 <?php if(\dash\request::get('filter')) { echo 'apply'; }?>" data-kerkere-icon="close" data-kerkere='.filterBox'><?php echo T_("Filter"); ?></a>
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
            <?php foreach (\dash\data::sortList() as $key => $value) {?>

              <option value="<?php echo \dash\url::that(). '?'. @$value['query_string']; ?>" <?php if(\dash\request::get('sort') == @$value['query']['sort'] && \dash\request::get('order') == @$value['query']['order']) { echo 'selected'; }?> ><?php echo @$value['title']; ?></a>
            <?php } //endfor ?>
        </select>
      </div>
    </div>
  </div>

<?php if(\dash\request::get('filter')) {?>

<div class="applyFilters">

  <?php if(\dash\request::get('duplicatetitle')) {?><a class="btn danger2 sm mRa5" href="<?php echo \dash\url::that(); ?>"><span><?php echo T_("Duplicate title"); ?></span><i class="fc-red pLa10 sf-times"></i></a><?php }// endif ?>
  <?php if(\dash\request::get('hbarcode')) {?><a class="btn danger2 sm mRa5" href="<?php echo \dash\url::that(); ?>"><span><?php echo T_("Have barcode"); ?></span><i class="fc-red pLa10 sf-times"></i></a><?php }// endif ?>
  <?php if(\dash\request::get('hnotbarcode')) {?><a class="btn danger2 sm mRa5" href="<?php echo \dash\url::that(); ?>"><span><?php echo T_("Have not barcode"); ?></span><i class="fc-red pLa10 sf-times"></i></a><?php }// endif ?>
  <?php if(\dash\request::get('wbuyprice')) {?><a class="btn danger2 sm mRa5" href="<?php echo \dash\url::that(); ?>"><span><?php echo T_("Whithout buyprice"); ?></span><i class="fc-red pLa10 sf-times"></i></a><?php }// endif ?>
  <?php if(\dash\request::get('wprice')) {?><a class="btn danger2 sm mRa5" href="<?php echo \dash\url::that(); ?>"><span><?php echo T_("Whithout price"); ?></span><i class="fc-red pLa10 sf-times"></i></a><?php }// endif ?>
  <?php if(\dash\request::get('wdiscount')) {?><a class="btn danger2 sm mRa5" href="<?php echo \dash\url::that(); ?>"><span><?php echo T_("Whithout discount"); ?></span><i class="fc-red pLa10 sf-times"></i></a><?php }// endif ?>

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
