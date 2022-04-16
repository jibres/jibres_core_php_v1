<?php require_once(root. 'content_a/accounting/filter.php'); ?>

<?php if(in_array(\dash\request::get('template'), ['cost', 'income', 'asset', 'costasset'])) {?>
<?php $myData = \dash\data::summaryDetail(); ?>
<section class="row">
  <div class="c">
    <a class="stat x70">
      <h3><?php echo T_("Count");?></h3>
      <div class="val"><?php echo \dash\fit::number(a($myData, 'count'));?></div>
    </a>
  </div>
  <div class="c">
    <a class="stat x70">
      <h3><?php echo T_("Total pay");?></h3>
      <div class="val"><?php echo \dash\fit::number(a($myData, 'total'));?></div>
    </a>
  </div>
   <div class="c">
    <a class="stat x70">
      <h3><?php echo T_("Sum vat");?></h3>
      <div class="val"><?php echo \dash\fit::number(a($myData, 'totalvat'));?></div>
    </a>
  </div>
  <div class="c">
    <a class="stat x70">
      <h3><?php echo \dash\fit::text("6%");?></h3>
      <div class="val"><?php echo \dash\fit::number(a($myData, 'totalvat6'));?></div>
    </a>
  </div>
  <div class="c">
    <a class="stat x70">
      <h3><?php echo \dash\fit::text("3%");?></h3>
      <div class="val"><?php echo \dash\fit::number(a($myData, 'totalvat3'));?></div>
    </a>
  </div>
</section>
<?php } //endif ?>



  <?php if(\dash\data::dataTable()) {?>
    <div class="tblBox">
      <table class="tbl1 v6  minimal text-sm">
        <thead>
          <tr>
            <th><?php echo T_("Number") ?></th>
            <th><?php echo T_("Date") ?></th>
            <th><?php echo T_("Status") ?></th>
            <th><?php echo T_("Item count") ?></th>
            <th><?php echo T_("Template") ?></th>
            <th><?php echo T_("Total") ?></th>
            <th><?php echo T_("Total discount") ?></th>
            <th><?php echo T_("Total vat") ?></th>
            <th><?php echo T_("Final") ?></th>
            <th class="collapsing"><?php echo T_("Quarter report") ?></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach (\dash\data::dataTable() as $key => $value) {?>
            <tr class="text-sm">
              <td class="font-14">
                <a class="link" href="<?php echo \dash\url::that(). '/edit?id='. a($value, 'id'); ?>">#<?php echo \dash\fit::number(a($value, 'number'), true, 'en'); ?></a>
              </td>
              <td class="font-bold"><a href="<?php echo \dash\url::that(). \dash\request::full_get(['startdate' => \dash\fit::date_en(a($value, 'date')), 'enddate' => \dash\fit::date_en(a($value, 'date'))]) ?>"><?php echo \dash\fit::date(a($value, 'date')) ?></a></td>
              <td class="">
                <?php if(a($value, 'status') === 'lock') { echo '<i class="inline-block sf-lock text-red-800 mRa10"></i>';} else { echo '<i class="inline-block sf-unlock text-green-700 mRa10"></i>';}  ?>
                <a href="<?php echo \dash\url::that(). '?status='. a($value, 'status'); ?>"><?php echo T_(a($value, 'tstatus')) ?></a>
                <?php if(a($value, 'type') === 'opening') { echo '<i class="fc-mute font-bold">'. T_("Opening Document"). '</i>';} ?>
              </td>
              <td class=""><?php echo \dash\fit::number(a($value, 'item_count')) ?></td>
              <td class=""><?php echo T_(a($value, 'template_title')) ?></td>

              <td class="font-14 text-green-700"><span class="text-right font-bold"><?php echo \dash\fit::number_decimal(a($value, 'total'), 'en') ?></span></td>
              <td class="font-14 text-red-800"><span class="text-right font-bold"><?php echo \dash\fit::number_decimal(a($value, 'totaldiscount'), 'en') ?></span></td>
              <td class="font-14 text-red-800"><span class="text-right font-bold"><?php echo \dash\fit::number_decimal(a($value, 'totalvat'), 'en') ?></span></td>
              <td class="font-14 text-red-800"><span class="text-right font-bold"><?php echo \dash\fit::number_decimal(floatval(a($value, 'total')) - floatval(a($value, 'discount')) + floatval(a($value, 'totalvat')), 'en') ?></span></td>
              <td class="txtRa"><?php if(a($value, 'quarterlyreport') === 'yes') { echo '<a href="'.\dash\url::that(). \dash\request::full_get(['quarterlyreport' => 'yes']). '"><i class="sf-check text-green-700"></i></a>'; }else{ echo '<a href="'.\dash\url::that(). \dash\request::full_get(['quarterlyreport' => 'no']). '"><i class="sf-times text-red-800"></i></a>'; } //endif ?></td>
            </tr>
            <tr>
              <td class="pTB5-f" colspan="10"><?php if(a($value, 'gallery')) { echo '<i class="inline-block mRa10 sf-attach"></i>';} ?><?php echo a($value, 'desc') ?></td>
            </tr>
          <?php } //endif ?>
        </tbody>
      </table>
    </div>
    <?php \dash\utility\pagination::html(); ?>
  <?php }else{ ?>
    <div class="alert-success"><?php echo T_("Hi!") ?> <a class="btn-link" href="<?php echo \dash\data::action_link() ?>"><?php echo T_("Add new") ?></a></div>
  <?php } //endif ?>

