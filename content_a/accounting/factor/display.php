<?php require_once(root. 'content_a/accounting/filter.php'); ?>

<?php if(in_array(\dash\request::get('template'), ['cost', 'income'])) {?>
<?php $myData = \dash\data::summaryDetail(); ?>
<section class="f">
  <div class="c pRa10">
    <a class="stat x70">
      <h3><?php echo T_("Count");?></h3>
      <div class="val"><?php echo \dash\fit::number(a($myData, 'count'));?></div>
    </a>
  </div>
  <div class="c pRa10">
    <a class="stat x70">
      <h3><?php echo T_("Total pay");?></h3>
      <div class="val"><?php echo \dash\fit::number(a($myData, 'total'));?></div>
    </a>
  </div>
   <div class="c pRa10">
    <a class="stat x70">
      <h3><?php echo T_("Sum vat");?></h3>
      <div class="val"><?php echo \dash\fit::number(a($myData, 'totalvat'));?></div>
    </a>
  </div>
  <div class="c pRa10">
    <a class="stat x70">
      <h3><?php echo \dash\fit::text("6%");?></h3>
      <div class="val"><?php echo \dash\fit::number(a($myData, 'totalvat6'));?></div>
    </a>
  </div>
  <div class="c pRa10">
    <a class="stat x70">
      <h3><?php echo \dash\fit::text("3%");?></h3>
      <div class="val"><?php echo \dash\fit::number(a($myData, 'totalvat3'));?></div>
    </a>
  </div>
</section>
<?php } //endif ?>



  <?php if(\dash\data::dataTable()) {?>
    <div class="tblBox">
      <table class="tbl1 v6  minimal font-12">
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
          </tr>
        </thead>
        <tbody>
          <?php foreach (\dash\data::dataTable() as $key => $value) {?>
            <tr class="font-12">
              <td class="font-14">
                <a class="link" href="<?php echo \dash\url::that(). '/edit?id='. a($value, 'id'); ?>">#<?php echo \dash\fit::number(a($value, 'number'), true, 'en'); ?></a>
              </td>
              <td class="txtB"><?php echo \dash\fit::date(a($value, 'date')) ?></td>
              <td class="">
                <?php if(a($value, 'status') === 'lock') { echo '<i class="compact sf-lock fc-red mRa10"></i>';} else { echo '<i class="compact sf-unlock fc-green mRa10"></i>';}  ?>
                <a href="<?php echo \dash\url::that(). '?status='. a($value, 'status'); ?>"><?php echo T_(a($value, 'tstatus')) ?></a>
                <?php if(a($value, 'type') === 'opening') { echo '<i class="fc-mute txtB">'. T_("Opening Document"). '</i>';} ?>
              </td>
              <td class=""><?php echo \dash\fit::number(a($value, 'item_count')) ?></td>
              <td class=""><?php echo T_(a($value, 'template_title')) ?></td>

              <td class="font-14 fc-green"><span class="txtR txtB"><?php echo \dash\fit::number_decimal(a($value, 'total'), 'en') ?></span></td>
              <td class="font-14 fc-red"><span class="txtR txtB"><?php echo \dash\fit::number_decimal(a($value, 'totaldiscount'), 'en') ?></span></td>
              <td class="font-14 fc-red"><span class="txtR txtB"><?php echo \dash\fit::number_decimal(a($value, 'totalvat'), 'en') ?></span></td>
            </tr>
            <tr>
              <td class="pTB5-f" colspan="8"><?php if(a($value, 'gallery')) { echo '<i class="compact mRa10 sf-attach"></i>';} ?><?php echo a($value, 'desc') ?></td>
            </tr>
          <?php } //endif ?>
        </tbody>
      </table>
    </div>
    <?php \dash\utility\pagination::html(); ?>
  <?php }else{ ?>
    <div class="msg success2"><?php echo T_("Hi!") ?> <a class="btn link" href="<?php echo \dash\data::action_link() ?>"><?php echo T_("Add new") ?></a></div>
  <?php } //endif ?>

