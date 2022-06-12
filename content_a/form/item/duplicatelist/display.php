<div class="avand-md">
  <form method="post" autocomplete="off">
    <div class="box">
      <div class="body">
<?php $itemDetail = \dash\data::itemDetail(); ?>
  <label for="item_uniquelist_<?php echo a($itemDetail, 'id') ?>">
<?php
switch ($itemDetail['type'])
{
  case 'nationalcode':
    $title = T_("Prohibition of registration for the following nationalcode");
    $input = '<input type="tel" name="duplicateitem" id="duplicateitem" placeholder="'.T_("Enter nationalcode").'" data-format="nationalCode" >';
    break;

  case 'mobile':
    $title = T_("Prohibition of registration for the following mobile phone number");
    $input = '<input type="tel" name="duplicateitem" id="duplicateitem" placeholder="'.T_("Enter mobile").'" data-format="mobile">';
    break;

  case 'email':
    $title = T_("Prohibition of registration for the following email address");
    $input = '<input type="email" name="duplicateitem" id="duplicateitem" placeholder="'.T_("Enter email").'">';
    break;

  default:
    $title = T_("Prohibition of registration for the following answer");
    $input = '<input type="text" name="duplicateitem" id="duplicateitem" placeholder="'.T_("Enter answer").'">';
    break;
}
echo $title;
?>
  </label>
  <div class="input">
    <?php echo $input ?>
    <button class="btn-primary addon"><?php echo T_("Add") ?></button>
  </div>
  <small class="text-gray-400"><?php echo T_('In addition to checking the non-duplication of this item in the list of previous answers, you can manually enter the list of items that you think are duplicate so that they are not registered.') ?></small>
      </div>
    </div>
  </form>

<?php if(a($itemDetail, 'uniquelist')) {
  $uniqueList = explode(',', $itemDetail['uniquelist']);
?>
    <form method="post" autocomplete="off">
      <input type="hidden" name="sortable" value="sortable">
      <div class="tblBox font-14">
        <table class="tbl1 v4">
          <tbody data-sortable>
            <?php foreach ($uniqueList as $key => $value) {?>
              <tr>
                <td>
                  <?php echo $value ?>
                </td>
                <td class="collapsing">
                    <div class="btn-link-danger" data-confirm data-data='{"remove": "remove", "value" : "<?php echo $value ?>"}'><?php echo \dash\utility\icon::svg_delete() ?></div>
                </td>
              </tr>
            <?php } //endfor ?>
          </tbody>
        </table>
      </div>
    </form>
  <?php } //endif ?>
</div>
