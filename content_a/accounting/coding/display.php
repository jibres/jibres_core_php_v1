<div class="avand">
	<?php if(\dash\data::dataTable()) {?>
		<table class="tbl1 v1">
			<thead>
				<tr>
					<th class="collapsing"><?php echo T_("code") ?></th>
					<th><?php echo T_("title") ?></th>
					<th class="collapsing"><?php echo T_("Edit") ?></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach (\dash\data::dataTable() as $key => $value) {?>
					<tr>
						<td class="collapsing"><span class="txtB"><?php echo \dash\fit::text(\dash\get::index($value, 'code')) ?></span></td>
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