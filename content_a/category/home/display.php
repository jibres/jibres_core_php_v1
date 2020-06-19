



<?php


if(\dash\data::dataTable())
{
  if(\dash\data::isFiltered())
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
  if(\dash\data::isFiltered())
  {

    htmlSearchBox();
    htmlFilter();



  }
  else
  {
    htmlStartAddNew();

  }

}
?>








<?php function htmlTable() {?>

<?php
$dataTable = \dash\data::dataTable();
if(!is_array($dataTable))
{
  $dataTable = [];
}
?>


<div class="tblBox">
 <table class="tbl1 v1 cbox fs12">
    <thead>
      <tr class="fs08">
        <th class="collapsing">&nbsp;</th>
        <th><?php echo T_("Title"); ?></th>
        <th class="s0"><?php echo T_("Slug"); ?></th>
        <th class="collapsing txtC"><?php echo T_("Count product"); ?></th>

      </tr>
    </thead>

    <tbody>
      <?php foreach ($dataTable as $key => $value) {?>

      <tr>
        <td class="collapsing">
          <?php if(isset($value['file']) && $value['file']) {?><img src="<?php echo \dash\get::index($value, 'file'); ?>" class="avatar"><?php } //endif ?>
        </td>
        <td ><a class="txtB" href="<?php echo \dash\url::here(); ?>/category/edit?id=<?php echo \dash\get::index($value, 'id'); ?>"><i class="sf-edit-write mRa10"></i><?php echo \dash\get::index($value, 'title'); ?></a>
          <br>
          <span class="fc-mute fs09"><?php echo \dash\get::index($value, 'parent_title'); ?></span>
        </td>
        <td class="s0 ltr txtL"><?php echo \dash\get::index($value, 'full_slug'); ?></td>
        <td class="collapsing txtC">
          <a href="<?php echo \dash\url::here(); ?>/products?catid=<?php echo \dash\get::index($value, 'id'); ?>"><?php echo \dash\fit::number(\dash\get::index($value, 'count')); ?> <small class="fc-mute"><?php echo T_("Product"); ?></small></a>
        </td>

      </tr>
      <?php } //endfor ?>
    </tbody>
  </table>

</div>

<?php \dash\utility\pagination::html(); ?>


<?php } //endfunction ?>









<?php function htmlSearchBox() {?>
  <form method="get" autocomplete="off">
    <div class="searchBox">
      <div class="f">
        <div class="c pRa10">
          <div>
            <div class="input search <?php if(\dash\request::get('q')) { echo 'apply'; }?>">
              <input type="search" name="q" placeholder='<?php echo T_("Search"); ?>' id="q" value="<?php echo \dash\request::get('q'). \dash\request::get('barcode'); ?>" class="barCode" data-default data-pass='submit' autocomplete='off' autofocus>
              <button class="addon btn light3 s0"><i class="sf-search"></i></button>
            </div>
          </div>
        </div>

        <div class="cauto">
          <select class="select22 <?php if(\dash\request::get('sort') || \dash\request::get('order')) { echo 'apply'; }?>" data-link>
            <option value="<?php echo \dash\url::this(); if(\dash\request::get('q')){ echo '?q='. \dash\request::get('q');} ?>"><i class="sf-sort mRa5"></i><span><?php echo T_("Sort"); ?></span></div>
              <option value="<?php echo \dash\url::this(). '?sort=title&order=asc'; if(\dash\request::get('q')){ echo '&q='. \dash\request::get('q');} ?>" <?php if(\dash\request::get('sort') === 'title' && \dash\request::get('order') === 'asc') { echo 'selected'; } ?>><?php echo T_("Sort by Title ASC") ?></option>
              <option value="<?php echo \dash\url::this(). '?sort=title&order=desc'; if(\dash\request::get('q')){ echo '&q='. \dash\request::get('q');} ?>" <?php if(\dash\request::get('sort') === 'title' && \dash\request::get('order') === 'desc') { echo 'selected'; } ?>><?php echo T_("Sort by Title DESC") ?></option>


            </select>
          </div>
        </div>
      </div>
    </form>

<?php } //endfunction ?>










<?php function htmlFilter() {?>
<p class="f fs14 msg warn2">
  <span class="c"><?php echo \dash\data::filterBox(); ?></span>

  <?php if(\dash\data::barcodeScaned()) {?>

    <a class="c" href="<?php echo \dash\url::this(); ?>/add<?php echo \dash\data::barcodeScaned(); ?>" data-shortkey="118"><?php echo T_("Add new product"); ?> <kbd>f7</kbd></a>

  <?php } //endif ?>

  <a class="cauto" href="<?php echo \dash\url::that(); ?>"><?php echo T_("Clear filters"); ?></a>
</p>

<?php } //endfunction ?>




<?php function htmlStartAddNew() {?>

<div class="fs14 msg info2 pTB20">
  <p><?php echo T_("Hi!"); ?></p>
  <p><?php echo T_("First step to set up your online store is add products."); ?> <?php echo T_("After add products, you can sell them to your customers."); ?></p>
  <p><a href="<?php echo \dash\url::that(); ?>/add"><?php echo T_("Try to start with add new product!"); ?></a></p>

</div>

<img class="banner" src="<?php echo \dash\url::cdn(); ?>/img/product/camera1.png" align='<?php echo T_("add new product"); ?>'>


<?php } //endfunction ?>

