<div class="avand">
  <div class="msg hide">
    <div class="f fs14">
      <div class="cauto"><img class="avatar" src="<?php echo \dash\data::userDetail_avatar() ?>"></div>
      <div class="c"><?php echo \dash\data::userDetail_displayname(); ?></div>
      <div class="c"><?php echo \dash\fit::mobile(\dash\data::userDetail_mobile()); ?></div>

    </div>
  </div>

  <form method="post" autocomplete="off" data-refresh>
    <div class="cbox" id="searchInProducts">
      <p><?php echo T_("Search in product and add to user cart") ?></p>
      <div class="f">
        <div class="c">
          <select name="product" class="select22 barCode" id="productSearch"  data-model='html' <?php \dash\layout\autofocus::html() ?>  data-ajax--delay="250" data-ajax--url='<?php echo \dash\url::that(). '?user='. \dash\request::get('user'); ?>&json=true' data-shortkey-search data-placeholder='<?php echo T_("Search in list to add product"); ?> +'>
          </select>

        </div>
        <div class="cauto">
          <div class="input">
            <input type="number" name="count" placeholder="<?php echo T_("Count"); ?>" value="1">
          </div>
        </div>
        <div class="cauto">
          <button class="btn success"><?php echo T_("Add"); ?></button>
        </div>
      </div>
    </div>

  </form>




<?php
$sortLink  = \dash\data::sortLink();
$dataTable = \dash\data::dataTable();
if(!is_array($dataTable))
{
  $dataTable = [];
}
?>

<?php if($dataTable) {?>

   <table class="tbl1 v1 cbox fs12">
    <thead>
      <tr>
        <th class="collapsing"></th>
        <th><?php echo T_("Product"); ?></th>
        <th><?php echo T_("Count"); ?></th>
        <th><?php echo T_("Date"); ?></th>
        <th class="collapsing"><?php echo T_("Remove"); ?></th>
      </tr>
    </thead>

    <tbody>
      <?php foreach ($dataTable as $key => $value) {?>

      <tr class="">
        <td class="collapsing"><?php echo \dash\fit::number($key + 1) ?></td>
        <td><?php echo \dash\get::index($value, 'title'); ?></td>
        <td>
          <form method="post" autocomplete="off">
            <input type="hidden" name="type" value="edit_count">
            <input type="hidden" name="product" value="<?php echo \dash\get::index($value, 'product_id'); ?>">
            <div class="input w100">
              <input type="number" name="count" value="<?php echo \dash\get::index($value, 'count') ?>">
              <button class="addon btn primary"><i class="sf-edit"></i></button>
            </div>
          </form>
        </td>
        <td><?php echo \dash\fit::date_time(\dash\get::index($value, 'datecreated')); ?></td>
        <td class="collapsing"><div class="btn xs danger" data-confirm data-data='{"type": "remove", "product": "<?php echo \dash\get::index($value, 'product_id'); ?>"}'><?php echo T_("Remove") ?></div></td>
      </tr>
      <?php } //endfor ?>
    </tbody>
  </table>

<?php }else{ ?>
  <div class="msg info2 fs14 txtB"><?php echo T_("This cart is empty") ?></div>
<?php } ?>

</div>
