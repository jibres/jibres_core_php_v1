<div class="avand">
	<div class="row">
		<div class="c-xs-12 c-sm-6">
			<?php echo \dash\data::dataTableAll(); ?>
		</div>
		<div class="c-xs-12 c-sm-6">
			<?php if(\dash\data::loadDetail()) {?>
				<div class="box">
					<header><h2><?php echo T_("Detail") ?></h2></header>
					<div class="body">
						<table class="tbl1 v4">
							<tr>
								<td class="collapsing"><?php echo T_("Type") ?></td>
								<td><?php echo T_(ucfirst(\dash\data::loadDetail_type())); ?></td>
							</tr>
							<tr>
								<td class="collapsing"><?php echo T_("Title") ?></td>
								<td><?php echo \dash\data::loadDetail_title(); ?></td>
							</tr>

							<tr>
								<td class="collapsing"><?php echo T_("Code") ?></td>
								<td><?php echo \dash\data::loadDetail_code(); ?></td>
							</tr>

						</table>

					</div>
					<footer class="txtRa">
						<a class="btn primary" href="<?php echo \dash\url::that(). '/edit?id='. \dash\data::loadDetail_id() ?>"><?php echo T_("Edit"); ?></a>
					</footer>
				</div>
			<?php } //endif ?>
		</div>
	</div>

</div>


