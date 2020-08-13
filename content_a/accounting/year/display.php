<div class="avand">
	<?php if(\dash\data::dataTable()) {?>
		<table class="tbl1 v1 fs14">
			<thead>
				<tr>
					<th class="collapsing"><?php echo T_("Title") ?></th>
					<th class="collapsing"><?php echo T_("Start date") ?></th>
					<th class="collapsing"><?php echo T_("End date") ?></th>
					<th><?php echo T_("Status") ?></th>
					<th></th>
					<th class="collapsing"><?php echo T_("Edit") ?></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach (\dash\data::dataTable() as $key => $value) {?>
					<tr>
						<td class="collapsing"><?php echo \dash\get::index($value, 'title') ?></td>
						<td class="collapsing"><?php echo \dash\fit::date(\dash\get::index($value, 'startdate')) ?></td>
						<td class="collapsing"><?php echo \dash\fit::date(\dash\get::index($value, 'enddate')) ?></td>
						<td class="collapsing"><?php echo T_(\dash\get::index($value, 'status')) ?></td>
						<td>
							<?php if(\dash\get::index($value, 'isdefault')) {?>
								<div class="badge success"><?php echo T_("Current accounting year") ?></div>
							<?php }else{ ?>
								<div class="btn link" data-confirm data-data='{"setdefault": "setdefault", "id" : "<?php echo \dash\get::index($value, 'id') ?>"}'><?php echo T_("Set as default year") ?></div>
							<?php } //endif ?>
						</td>
						<td class="collapsing"><a class="btn link" href="<?php echo \dash\url::that(). '/edit?id='. \dash\get::index($value, 'id'); ?>"><?php echo T_("Edit") ?></a></td>
					</tr>
				<?php } //endif ?>
			</tbody>
		</table>
	<?php }else{ ?>
		<div class="msg fs14 success2"><?php echo T_("Hi!") ?> <a class="btn link" href="<?php echo \dash\url::that() ?>/add"><?php echo T_("Add new") ?></a></div>
	<?php } //endif ?>
</div>