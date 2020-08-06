<div class="avand">
	<?php if(\dash\data::dataTable()) {?>
		<table class="tbl1 v1">
			<thead>
				<tr>
					<th class="collapsing"><?php echo T_("Date") ?></th>
					<th class="collapsing"><?php echo T_("Number") ?></th>
					<th><?php echo T_("Description") ?></th>
					<th class="collapsing"><?php echo T_("Edit") ?></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach (\dash\data::dataTable() as $key => $value) {?>
					<tr>
						<td class="collapsing"><?php echo \dash\fit::date(\dash\get::index($value, 'date')) ?></td>
						<td class="collapsing"><?php echo \dash\fit::number(\dash\get::index($value, 'number')) ?></td>
						<td><?php echo \dash\get::index($value, 'title') ?></td>
						<td class="collapsing"><a class="btn link" href="<?php echo \dash\url::that(). '/edit?id='. \dash\get::index($value, 'id'); ?>"><?php echo T_("Edit") ?></a></td>
					</tr>
				<?php } //endif ?>
			</tbody>
		</table>
	<?php }else{ ?>
		<div class="msg fs14 success2"><?php echo T_("Hi!") ?> <a class="btn link" href="<?php echo \dash\url::that() ?>/add"><?php echo T_("Add new") ?></a></div>
	<?php } //endif ?>
</div>