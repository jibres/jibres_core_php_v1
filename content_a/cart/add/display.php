
<?php
$sortLink  = \dash\data::sortLink();
$dataTable = \dash\data::dataTable();
if(!is_array($dataTable))
{
  $dataTable = [];
}
?>

<div class="avand-xl">


<?php if(isset($dataTable[0]['user_id']) && $dataTable[0]['user_id']) {?>
  <div class="msg">
    <div class="f fs14">
      <div class="cauto"><img class="avatar" src="<?php echo \dash\data::userDetail_avatar() ?>"></div>
      <div class="c"><?php echo \dash\data::userDetail_displayname(); ?></div>
      <div class="c"><?php echo \dash\fit::mobile(\dash\data::userDetail_mobile()); ?></div>
    </div>
  </div>
<?php } //endif ?>

<form method="post" autocomplete="off" data-refresh>
  <div class="box">
    <div class="pad">
      <p><?php echo T_("Search in product and add to user cart") ?></p>
      <div class="mB10">

        <select name="product" class="select22 barCode" id="productSearch"  data-model='html' <?php \dash\layout\autofocus::html() ?>  data-ajax--delay="250" data-ajax--url='<?php echo \dash\url::here(). '/products/api'; ?>?json=true' data-shortkey-search data-placeholder='<?php echo T_("Search in list to add product"); ?> +'>
        </select>
      </div>

      <label for="count"><?php echo T_("Count") ?></label>
      <div class="input">
        <input type="number" name="count" placeholder="<?php echo T_("Count"); ?>" value="1" id="count">
      </div>

    </div>
    <footer class="txtRa">
      <button class="btn success"><?php echo T_("Add"); ?></button>
    </footer>
  </div>

</form>




<?php if($dataTable) {?>
<div class="tblBox">

   <table class="tbl1 v6 cbox fs12">
    <thead>
      <tr>
        <th class="collapsing s0"></th>
        <th class="txtC"><?php echo T_("Product"); ?></th>
        <th class="collapsing"><?php echo T_("Count"); ?></th>
        <th class="s0"><?php echo T_("Date"); ?></th>
      </tr>
    </thead>

    <tbody>
      <?php foreach ($dataTable as $key => $value) {?>

      <tr class="">
        <td class="collapsing s0"><?php echo \dash\fit::number($key + 1) ?></td>
        <td>
          <?php echo \dash\get::index($value, 'title'); ?>
            <div class="btn linkDel" data-confirm data-data='{"type": "remove", "product": "<?php echo \dash\get::index($value, 'product_id'); ?>"}'><?php echo T_("Remove") ?></div>
          </td>
        <td class="collapsing">
          <form method="post" autocomplete="off">
            <input type="hidden" name="type" value="edit_count">
            <input type="hidden" name="product" value="<?php echo \dash\get::index($value, 'product_id'); ?>">
            <div class="input w150">
              <input type="number" name="count" value="<?php echo \dash\get::index($value, 'count') ?>">
              <button class="addon btn primary"><i class="sf-edit"></i></button>
            </div>
          </form>
        </td>
        <td class="s0"><?php echo \dash\fit::date_time(\dash\get::index($value, 'datecreated')); ?></td>

      </tr>
      <?php } //endfor ?>
    </tbody>
  </table>
</div>

<?php }else{ ?>
  <div class="msg info2 fs14 txtB"><?php echo T_("This cart is empty") ?></div>
<?php } ?>


</div>