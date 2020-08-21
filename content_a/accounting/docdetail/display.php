<div class="box">
  <div class="pad">
    <form method="get" autocomplete="off" data-patch action="<?php echo \dash\url::current() ?>">
    	<div class="row">
    		<div class="c-xs-12	c-sm">
		      <?php if(\dash\data::accountingYear()) {?>
		        <label for="parent"><?php echo T_("Accounting year") ?></label>
		        <select class="select22" name="year_id">
		          <option value=""><?php echo T_("Please choose year") ?></option>
		          <?php foreach (\dash\data::accountingYear() as $key => $value) {?>
		            <option value="<?php echo \dash\get::index($value, 'id') ?>" <?php if((!\dash\request::get('year_id') && \dash\get::index($value, 'isdefault')) || (\dash\get::index($value, 'id') === \dash\request::get('year_id'))) { echo 'selected';} ?>><?php echo \dash\get::index($value, 'title'); ?></option>
		          <?php } // endfor ?>
		        </select>
		      <?php } // endif ?>
    		</div>

    		<div class="c-xs-12	c-sm">
    			<?php if(\dash\data::groupList()) {?>
				  <label for="group"><?php echo T_("Group") ?></label>
				  <select class="select22" name="group">
				    <option value=""><?php echo T_("Please choose group") ?></option>
				    <?php foreach (\dash\data::groupList() as $key => $value) {?>
				      <option value="<?php echo \dash\get::index($value, 'id') ?>" <?php if(\dash\get::index($value, 'id') === \dash\request::get('group')) { echo 'selected';} ?>><?php echo \dash\get::index($value, 'full_title'); ?></option>
				    <?php } // endfor ?>
				  </select>
				<?php } // endif ?>
    		</div>


    		<div class="c-xs-12	c-sm">
    			<?php if(\dash\data::totalList()) {?>
				  <label for="total"><?php echo T_("Accounting total") ?></label>
				  <select class="select22" name="total">
				    <option value=""><?php echo T_("Please choose total") ?></option>
				    <?php foreach (\dash\data::totalList() as $key => $value) {?>
				      <option value="<?php echo \dash\get::index($value, 'id') ?>" <?php if(\dash\get::index($value, 'id') === \dash\request::get('total')) { echo 'selected';} ?>><?php echo \dash\get::index($value, 'full_title'); ?></option>
				    <?php } // endfor ?>
				  </select>
				<?php } // endif ?>
    		</div>

    		<div class="c-xs-12	c-sm">
    			  <?php if(\dash\data::assistantList()) {?>
				  <label for="assistant"><?php echo T_("Accounting assistant") ?></label>
				  <select class="select22" name="assistant">
				    <option value=""><?php echo T_("Please choose assistant") ?></option>
				    <?php foreach (\dash\data::assistantList() as $key => $value) {?>
				      <option value="<?php echo \dash\get::index($value, 'id') ?>" <?php if(\dash\get::index($value, 'id') === \dash\request::get('assistant')) { echo 'selected';} ?>><?php echo \dash\get::index($value, 'full_title'); ?></option>
				    <?php } // endfor ?>
				  </select>
				<?php } // endif ?>
    		</div>
    		<div class="c-xs-12	c-sm">
    			<?php if(\dash\data::detailsList()) {?>
				  <label for="details"><?php echo T_("Accounting details") ?></label>
				  <select class="select22" name="details">
				    <option value=""><?php echo T_("Please choose details") ?></option>
				    <?php foreach (\dash\data::detailsList() as $key => $value) {?>
				      <option value="<?php echo \dash\get::index($value, 'id') ?>" <?php if($value === \dash\request::get('details')) { echo 'selected';} ?>><?php echo $value; ?></option>
				    <?php } // endfor ?>
				  </select>
				<?php } // endif ?>
    		</div>
    	</div>








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
					<th><?php echo T_("Debtor") ?></th>
					<th><?php echo T_("Creditor") ?></th>
					<th><?php echo T_("Remain") ?></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach (\dash\data::dataTable() as $key => $value) {?>
					<tr class="font-12">
					<td><?php echo \dash\fit::number(\dash\get::index($value, 'id')) ?></td>
						<td class="font-14">
							<a class="link" href="<?php echo \dash\url::this(). '/doc/edit?id='. \dash\get::index($value, 'tax_document_id'); ?>">#<?php echo \dash\fit::number(\dash\get::index($value, 'number'), true, 'en'); ?></a>
						</td>

						<td><a href="<?php echo \dash\url::current(). '?'. \dash\request::fix_get(['group' => \dash\get::index($value, 'group_id'), 'total' => null, 'assistant' => null]); ?>"><?php echo \dash\get::index($value, 'group_title'); ?></a></td>
						<td><a href="<?php echo \dash\url::current(). '?'. \dash\request::fix_get(['group' => \dash\get::index($value, 'group_id'), 'total' => \dash\get::index($value, 'total_id'), 'assistant' => null]); ?>"><?php echo \dash\get::index($value, 'total_title'); ?></a></td>
						<td><a href="<?php echo \dash\url::current(). '?'. \dash\request::fix_get(['group' => \dash\get::index($value, 'group_id'), 'total' => \dash\get::index($value, 'total_id'), 'assistant' => \dash\get::index($value, 'assistant_id')]); ?>"><?php echo \dash\get::index($value, 'assistant_title'); ?></a></td>
						<td><a href="<?php echo \dash\url::current(). '?'. \dash\request::fix_get(['group' => \dash\get::index($value, 'group_id'), 'total' => \dash\get::index($value, 'total_id'), 'assistant' => \dash\get::index($value, 'assistant_id'), 'details' => \dash\get::index($value, 'details_id')]); ?>"><?php echo \dash\get::index($value, 'details_title'); ?></a></td>
						<td class="txtB"><?php echo \dash\fit::date(\dash\get::index($value, 'date')) ?></td>
						<td class=""><?php echo \dash\get::index($value, 'tstatus') ?></td>


						<td class="font-14 fc-red"><span class="txtR txtB"><?php echo \dash\fit::number_decimal(\dash\get::index($value, 'debtor'), 'en') ?></span></td>
						<td class="font-14 fc-green"><span class="txtR txtB"><?php echo \dash\fit::number_decimal(\dash\get::index($value, 'creditor'), 'en') ?></span></td>
						<td class="font-14"><span class="txtR txtB <?php if(\dash\get::index($value, 'remain') < 0) {echo 'fc-red';}else{echo 'fc-green'; } ?>"><?php echo \dash\fit::number_decimal(\dash\get::index($value, 'remain'), 'en') ?></span></td>
					</tr>
					<tr>
						<td class="pTB5-f" colspan="11"><?php echo \dash\get::index($value, 'desc'). ' '. \dash\get::index($value, 'doc_desc'); ?></td>
					</tr>
				<?php } //endif ?>
			</tbody>
		</table>
		<?php \dash\utility\pagination::html(); ?>
	<?php }else{ ?>
		<div class="msg fs14 success2"><?php echo T_("Hi!") ?></div>
	<?php } //endif ?>
