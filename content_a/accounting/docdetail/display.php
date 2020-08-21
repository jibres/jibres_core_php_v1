<div class="box">
  <div class="pad">
    <form method="get" autocomplete="off" data-patch action="<?php echo \dash\url::current() ?>">
      <?php if(\dash\data::accountingYear()) {?>
        <label for="parent"><?php echo T_("Accounting year") ?></label>
        <select class="select22" name="year_id">
          <option value=""><?php echo T_("Please choose year") ?></option>
          <?php foreach (\dash\data::accountingYear() as $key => $value) {?>
            <option value="<?php echo \dash\get::index($value, 'id') ?>" <?php if((!\dash\request::get('year_id') && \dash\get::index($value, 'isdefault')) || (\dash\get::index($value, 'id') === \dash\request::get('year_id'))) { echo 'selected';} ?>><?php echo \dash\get::index($value, 'title'); ?></option>
          <?php } // endfor ?>
        </select>
      <?php }else{ ?>
        <div class="msg warn2"><a class="btn link" href="<?php echo \dash\url::here(). '/accounting/year/add' ?>"><?php echo T_("Add new accounting year") ?></a></div>
      <?php } // endif ?>
    </form>
  </div>
</div>

	<?php if(\dash\data::dataTable()) {?>
		<table class="tbl1 v6  minimal font-12">
			<thead>
				<tr>
					<td>#</td>
					<th><?php echo T_("Number") ?></th>
					<th><?php echo T_("Group") ?></th>
					<th><?php echo T_("Accounting total") ?></th>
					<th><?php echo T_("Accounting assistant") ?></th>
					<th><?php echo T_("Accounting details") ?></th>

					<th><?php echo T_("Date") ?></th>
					<th><?php echo T_("Status") ?></th>
					<th><?php echo T_("Description") ?></th>
					<th><?php echo T_("Debtor") ?></th>
					<th><?php echo T_("Creditor") ?></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach (\dash\data::dataTable() as $key => $value) {?>
					<tr class="font-12">
					<td><?php echo \dash\fit::number(\dash\get::index($value, 'id')) ?></td>
						<td class="font-14">
							<a class="link" href="<?php echo \dash\url::this(). '/doc/edit?id='. \dash\get::index($value, 'tax_document_id'); ?>">#<?php echo \dash\fit::number(\dash\get::index($value, 'number'), true, 'en'); ?></a>
						</td>

						<td><?php echo \dash\get::index($value, 'group_title'); ?></td>
						<td><?php echo \dash\get::index($value, 'total_title'); ?></td>
						<td><?php echo \dash\get::index($value, 'assistant_title'); ?></td>
						<td><?php echo \dash\get::index($value, 'details_title'); ?></td>
						<td class="txtB"><?php echo \dash\fit::date(\dash\get::index($value, 'date')) ?></td>
						<td class=""><?php echo \dash\get::index($value, 'tstatus') ?></td>
						<td class=""><?php echo \dash\get::index($value, 'desc') ?></td>


						<td class="font-14 fc-red"><span class="txtR txtB"><?php echo \dash\fit::number_decimal(\dash\get::index($value, 'debtor'), 'en') ?></span></td>
						<td class="font-14 fc-green"><span class="txtR txtB"><?php echo \dash\fit::number_decimal(\dash\get::index($value, 'creditor'), 'en') ?></span></td>
					</tr>
					<tr>
						<td class="pTB5-f" colspan="11"><?php echo \dash\get::index($value, 'desc') ?></td>
					</tr>
				<?php } //endif ?>
			</tbody>
		</table>
		<?php \dash\utility\pagination::html(); ?>
	<?php }else{ ?>
		<div class="msg fs14 success2"><?php echo T_("Hi!") ?></div>
	<?php } //endif ?>
