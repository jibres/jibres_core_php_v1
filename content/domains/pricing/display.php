<div class="jibresBanner">
 <div class="avand impact">

  <h2 class="txtC"><?php echo T_('Search for your dream domain'); ?></h2>

  <div class="tblBox">
    <table class="tbl1 v4">
      <thead>
        <tr>
        <th class="collapsing"></th>
        <th><?php echo T_("Domain TLD") ?></th>
        <th><?php echo T_("Price") ?> <small><?php echo T_("Toman"); ?></small></th>
        <?php if(\dash\permission::supervisor()) {?>
          <th><?php echo T_("Price") ?> <small><?php echo T_("Dollar"); ?></small></th>
         <?php } //endif ?>
        </tr>
      </thead>
      <tbody>
        <?php foreach (\dash\data::dataTable() as $key => $value) {?>
          <tr>
            <td class="collapsing"><?php echo \dash\fit::number($key + 1); ?></td>
            <td class="ltr"><?php echo \dash\get::index($value, 'tld') ?></td>
            <td class="txtB"><?php echo \dash\fit::number(\dash\get::index($value, 'price')) ?></td>
            <?php if(\dash\permission::supervisor()) {?>
              <td class="txtB"><?php echo \dash\fit::text(\dash\get::index($value, 'dollar')) ?></td>
            <?php } //endif ?>

          </tr>
        <?php } // endfor ?>
      </tbody>
    </table>
  </div>
</div>
</div>
