<section class="f">
  <div class="c pRa10">
    <a href="" class="stat">
      <h3><?php echo T_("Last amount");?></h3>
      <div class="val"><?php echo \dash\fit::text(\dash\get::index(\dash\data::lastCredit(), 'amount'));?></div>
    </a>
  </div>
  <div class="c pRa10">
    <a href="" class="stat">
      <h3><?php echo T_("Balance");?></h3>
      <div class="val"><?php echo \dash\fit::text(\dash\get::index(\dash\data::lastCredit(), 'balance'));?></div>
    </a>
  </div>
</section>
<div class="msg fs14 txtB txtL"><b>Last credit description</b> <?php echo \dash\data::lastCredit_description() ?></div>

<div class="f justify-center">
 <div class="c11 m12 s12">
    <div class="fs14">

    <?php if(\dash\data::dataTable()) {?>

    <div class="tblBox">
        <table class="tbl1 v1">
            <thead>


                <th class="collapsing"><?php echo T_("Date"); ?></th>
                <th class="collapsing"><?php echo T_("Balance"); ?></th>
                <th class="collapsing"><?php echo T_("Amount"); ?></th>
                <th class="txtL"><?php echo T_("Description"); ?></th>

            </thead>
            <tbody>
              <?php foreach (\dash\data::dataTable() as $key => $value) {?>
                <tr>

                    <td class="collapsing"><?php echo \dash\fit::date_time(\dash\get::index($value, 'date')); ?></td>
                    <td class="collapsing"><?php echo \dash\fit::text(\dash\get::index($value, 'balance')); ?></td>
                    <td class="collapsing"><?php echo \dash\fit::text(\dash\get::index($value, 'amount')); ?></td>
                    <td class="txtL"><?php echo \dash\get::index($value, 'description'); ?></td>

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

</div>
