<div class="jibresBanner">
 <div class="avand impact">

  <h2 class="txtC"><?php echo T_('Search for your dream domain'); ?></h2>

  <div class="tblBox">
    <table class="tbl1 v4">
      <thead>
        <tr>
        <th><?php echo T_("Domain TLD") ?></th>
        <th><?php echo T_("Price") ?> <small><?php echo T_("Toman"); ?></small></th>

        </tr>
      </thead>
      <tbody>
        <?php foreach (\dash\data::dataTable() as $key => $value) {?>
          <tr>
            <td class="ltr"><?php echo \dash\get::index($value, 'tld') ?></td>
            <td class="txtB"><?php echo \dash\fit::number(\dash\get::index($value, 'price')) ?></td>
          </tr>
        <?php } // endfor ?>
      </tbody>
    </table>
  </div>
</div>
</div>
