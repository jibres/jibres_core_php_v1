<section class="f">
  <div class="c pRa10">
    <a href="" class="stat">
      <h3><?php echo T_("Last amount");?></h3>
      <div class="val"><?php echo \dash\fit::text(a(\dash\data::lastCredit(), 'amount'));?></div>
    </a>
  </div>
  <div class="c pRa10">
    <a href="" class="stat">
      <h3><?php echo T_("Balance");?></h3>
      <div class="val"><?php echo \dash\fit::text(a(\dash\data::lastCredit(), 'balance'));?></div>
    </a>
  </div>
</section>
<div class="msg fs14 txtB text-left"><b>Last credit description</b> <?php echo \dash\data::lastCredit_description() ?></div>


<div class="fs14">

  <?php if(\dash\data::dataTable()) {?>

    <div class="tblBox">
      <table class="tbl1 v1">
        <thead>


          <th class="collapsing">ROID</th>
          <th class="collapsing"><?php echo T_("Date"); ?></th>
          <th class="collapsing"><?php echo T_("Domain"); ?></th>
          <th class="collapsing">
            <?php echo T_("Amount"); ?>
            <a href="<?php echo \dash\url::that(). \dash\request::full_get(['order' => 'desc', 'sort' => 'amount']) ?>"><i class="sf-chevron-up"></i></a>
            <a href="<?php echo \dash\url::that(). \dash\request::full_get(['order' => 'asc', 'sort' => 'amount']) ?>"><i class="sf-chevron-down"></i></a>
          </th>
          <th class="collapsing"><?php echo T_("Balance"); ?></th>
          <th class="collapsing"><?php echo T_("Transaction"); ?></th>
          <th class="text-left"><?php echo T_("Description"); ?></th>


        </thead>
        <tbody>
          <?php foreach (\dash\data::dataTable() as $key => $value) {?>
            <tr>

              <td class="collapsing"><?php echo a($value, 'roid'); ?></td>
              <td class="collapsing"><?php echo \dash\fit::date_time(a($value, 'date')); ?></td>
              <td class="collapsing"><?php echo a($value, 'domain'); ?></td>
              <td class="collapsing"><?php echo \dash\fit::text(a($value, 'amount')); ?></td>
              <td class="collapsing"><?php echo \dash\fit::text(a($value, 'balance')); ?></td>
              <td class="collapsing"><?php echo a($value, 'refund_transaction_id'); if(a($value, 'meta')) { echo '<br>'. a($value,'meta');} ?></td>
              <td class="text-left"><?php echo a($value, 'description'); ?></td>

            </tr>
          <?php }// endfor ?>
        </tbody>
      </table>
    </div>
  <?php }else{ ?>

    <div class="msg warn2"><?php echo T_("No credit history founded"); ?></div>
  <?php } //endif ?>
</div>

<?php \dash\utility\pagination::html(); ?>

