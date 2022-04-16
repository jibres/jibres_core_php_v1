<?php if(\dash\data::messgeGroupBy()) {?>
  <div class="box">
    <div class="pad">
    <table class="tbl1 v4">

      <tbody>
        <tr class="positive">
          <td><?php echo T_("Count all") ?></td>
          <td><?php echo \dash\fit::number(array_sum(array_column(\dash\data::messgeGroupBy(), 'count'))) ?>
          <?php if(\dash\permission::supervisor()) {?>
            <div class="btn-link-danger" data-confirm data-data='{"emptytable": "emptytable"}'><?php echo T_("Delete all") ?></div>
          <?php } //endif ?>
          </td>

        </tr>

<?php foreach (\dash\data::messgeGroupBy() as $key => $value) {?>
  <tr>
    <td><?php echo a($value, 'message') ?></td>
    <td><?php echo \dash\fit::number(a($value, 'count')) ?></td>
  </tr>
<?php } //endif ?>
      </tbody>
    </table>
    </div>
  </div>

<?php } //endif ?>


<nav class="items pwaMultiLine">
  <ul>
    <?php foreach (\dash\data::dataTable() as $key => $value) {?>
      <li>
        <a class="f align-center">
          <div class="key">
            <div class="line1"><?php echo a($value, 'type'); ?></div>
            <div class="line2 f font-bold">
              <div class="c">
                <?php echo a($value, 'message'); ?>

              </div>
              <?php if(\dash\permission::supervisor()) {?>
              <div class="cauto text-red-800">
                <?php echo a($value, 'urlkingdom'). '/'. a($value, 'urldir'); ?>
              </div>
            <?php } //endif ?>
            </div>
          </div>

          <div class="value datetime s0"><?php echo \dash\fit::date_time($value['datecreated']); ?></div>
          <div class="go detail s0"></div>
        </a>
      </li>
    <?php } //endfor ?>
  </ul>
</nav>

<?php \dash\utility\pagination::html(); ?>

