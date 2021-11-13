<?php $myData = \dash\data::reportDetail(); ?>

<form method="get" autocomplete="off" action="<?php echo \dash\url::current(); ?>">
  <div class="box">
    <div class="pad">
      <input type="hidden" name="id" value="<?php echo \dash\request::get('id') ?>">
      <div class="msg info2 txtB font-14">
        <span class="mRa10 txtB"><?php echo \dash\fit::number(\dash\data::itemDetailQ1_sort()) ?>.</span>
        <?php echo \dash\data::itemDetailQ1_title() ?>
        <input type="hidden" name="q1" value="<?php echo \dash\request::get('q1') ?>">
      </div>

      <?php if(\dash\data::itemDetailQ2_title()) {?>
        <div class="msg info2 txtB font-14">
        <span class="mRa10 txtB"><?php echo \dash\fit::number(\dash\data::itemDetailQ2_sort()) ?>.</span>
          <?php echo \dash\data::itemDetailQ2_title() ?>
        <input type="hidden" name="q2" value="<?php echo \dash\request::get('q2') ?>">
        </div>
      <?php }else{ ?>
        <div>
          <?php if(\dash\data::formItems()) { ?>
            <label for="iq2"><?php echo T_("Compare with") ?></label>
            <select class="select22" name="q2">
              <option value=""><?php echo T_("Without item") ?></option>
              <?php foreach (\dash\data::formItems() as $key => $value) { $item_id = a($value, 'id'); ?>
              <?php if($item_id != \dash\request::get('q1')) {?>
                <option value="<?php echo a($value, 'id') ?>"><?php echo a($value, 'title') ?></option>
              <?php } //endif ?>
            <?php } //endif ?>
          </select>
        <?php } //endif ?>
      </div>
    <?php } //endif ?>


    <?php if(\dash\data::itemDetailQ3_title()) {?>
      <div class="msg info2 txtB font-14">
        <span class="mRa10 txtB"><?php echo \dash\fit::number(\dash\data::itemDetailQ3_sort()) ?>.</span>
        <?php echo \dash\data::itemDetailQ3_title() ?>
        <input type="hidden" name="q3" value="<?php echo \dash\request::get('q3') ?>">
      </div>
    <?php }else{ ?>
      <div>
        <?php if(\dash\data::formItems()) { ?>
          <label for="iq3"><?php echo T_("Compare with") ?></label>
          <select class="select22" name="q3">
            <option value=""><?php echo T_("Without item") ?></option>
            <?php foreach (\dash\data::formItems() as $key => $value) { $item_id = a($value, 'id'); ?>
            <?php if($item_id != \dash\request::get('q1') && $item_id != \dash\request::get('q2')) {?>
              <option value="<?php echo a($value, 'id') ?>"><?php echo a($value, 'title') ?></option>
            <?php } //endif ?>
          <?php } //endif ?>
        </select>
      <?php } //endif ?>
    </div>
  <?php } //endif ?>
</div>
<footer class="txtRa">
  <?php if(a($myData, 'chart')) {?>
    <a class="btn outline secondary" href="<?php echo \dash\url::current(). '?id='. \dash\request::get('id'). '&q1='. \dash\request::get('q1'); ?>"><?php echo T_("Try by another item") ?></a>
  <?php }//endif ?>
  <button class="btn master"><?php echo T_("Compare") ?></button>
</footer>
</div>
</form>
<?php if(a($myData, 'chart')) {?>
  <div id="chartdivcompare" class="box chart x600 notActive" data-abc='a/form_compare'></div>
<?php } //endif ?>

<?php if(a($myData, 'data_table')) {?>
  <div class="tblBox font-14">
    <table class="tbl1 v6 minimal">
      <thead class="text-xs">
        <tr>
          <th><?php echo \dash\data::itemDetailQ1_title() ?></th>
          <th><?php echo \dash\data::itemDetailQ2_title() ?></th>
          <?php if(\dash\data::itemDetailQ3_title()) {?>
            <th><?php echo \dash\data::itemDetailQ3_title() ?></th>
          <?php } //endif ?>
          <th class="collapsing text-left"><?php echo T_("Frequency") ?></th>
          <th class="collapsing text-left"><?php echo T_("Percent frequency") ?></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($myData['data_table'] as $key => $value) {?>
          <tr>
            <td><?php echo a($value, 'q1') ?></td>
            <td><?php echo a($value, 'q2') ?></td>
            <?php if(\dash\data::itemDetailQ3_title()) {?>
              <td><?php echo a($value, 'q3') ?></td>
            <?php } //endif ?>
            <td class="ltr text-left collapsing"><?php echo \dash\fit::number(a($value, 'count')) ?></td>
            <td class="ltr text-left collapsing"><?php echo T_("%"); ?> <b><?php echo \dash\fit::text(a($value, 'percent')); ?></b></td>
          </tr>
        <?php } //endfor ?>
      </tbody>
      <tfoot>
        <tr>
          <td><?php echo T_("Sum") ?></td>
          <td></td>
          <?php if(\dash\data::itemDetailQ3_title()) {?>
            <td></td>
          <?php } //endif ?>
          <td class="ltr text-left"><?php echo \dash\fit::number(array_sum(array_column($myData['data_table'], 'count'))) ?></td>
          <td class="ltr text-left"><?php echo T_("%"); ?> <b><?php echo \dash\fit::text(array_sum(array_column($myData['data_table'], 'percent'))); ?></b></td>
        </tr>
      </tfoot>
    </table>
  </div>
<?php } //endif ?>



<div class="hide">
  <div id="charttitle"><?php echo T_("Answer"); ?></div>
  <div id="chartitemtitle"></div>
  <div id="chartdata"><?php echo \dash\data::reportDetail_chart(); ?></div>
</div>