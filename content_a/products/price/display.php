<?php require_once(root. 'content_a/products/home/display.php'); ?>




<?php function htmlTablePrice() {?>

  <table class="tbl1 v1 cbox fs12">
    <thead>
      <tr class="fs08">
        <th class="collapsing"></th>
        <th><?php echo T_("Title"); ?></th>
        <th><?php echo T_("Buy price"); ?></th>
        <th><?php echo T_("Price"); ?></th>
        <th><?php echo T_("Discount"); ?></th>
        <th><?php echo T_("Discount percent"); ?></th>
        <th><?php echo T_("Final price"); ?></th>
      </tr>
    </thead>

    <tbody>
      <?php foreach (\dash\data::dataTable() as $key => $value) {?>


      <tr>
        <td class="collapsing"><img src="<?php echo @$value['thumb']; ?>" class="avatar fs14"></td>
        <td>
          <div><a href="<?php echo \dash\url::this(); ?>/edit?id=<?php echo @$value['id']; ?>"><i class="sf-edit-write mRa10"></i><?php echo @$value['title']; ?></a></div>
          <?php if(isset($value['optionvalue1']) && $value['optionvalue1']) {?>
            <div><?php echo @$value['optionname1']; ?> <b><?php echo @$value['optionvalue1']; ?></b></div>
          <?php } //endif ?>

          <?php if(isset($value['optionvalue2']) && $value['optionvalue2']) {?>
            <div><?php echo @$value['optionname2']; ?> <b><?php echo @$value['optionvalue2']; ?></b></div>
          <?php } //endif ?>

          <?php if(isset($value['optionvalue3']) && $value['optionvalue3']) {?>
            <div><?php echo @$value['optionname3']; ?> <b><?php echo @$value['optionvalue3']; ?></b></div>
          <?php } //endif ?>
        </td>

        <td><?php echo \dash\fit::number(@$value['buyprice']); ?></td>
        <td><?php echo \dash\fit::number(@$value['price']); ?></td>
        <td><?php echo \dash\fit::number(@$value['discount']); ?></td>
        <td><?php echo \dash\fit::number(@$value['discountpercent']); ?></td>
        <td><?php echo \dash\fit::number(@$value['finalprice']); ?></td>

      </tr>
      <?php } //endfor ?>
    </tbody>
  </table>

<?php \dash\utility\pagination::html(); ?>

<?php } //endfunction ?>

