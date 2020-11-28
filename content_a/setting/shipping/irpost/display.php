<form method="get" autocomplete="off" action="<?php echo \dash\url::current(); ?>">
	<div class="avand-md">
		<div class="box">

			<div class="body">
				<label for="weight"><?php echo T_("Weight") ?></label>
				<div class="input">
					<input type="tel" id="weight" name="weight" value="<?php echo \dash\request::get('weight') ?>" data-format='weight' maxlength="7">
					<button class="addon btn primary"><?php echo T_("Calcuate"); ?></button>
				</div>


				<?php if(\dash\data::irpostResult()) { $result = \dash\data::irpostResult(); ?>
					<table class="tbl1 v5">
						<thead>
							<tr>
								<th><?php echo T_("Type") ?></th>
								<th><?php echo T_("In Province"); ?></th>
								<th><?php echo T_("Neighbor Province"); ?></th>
								<th><?php echo T_("Other province"); ?></th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td><?php echo T_("Sefareshi") ?></td>
								<td><?php echo \dash\fit::number(\dash\get::index($result, 'sefareshi', 'province')) ?></td>
								<td><?php echo \dash\fit::number(\dash\get::index($result, 'sefareshi', 'neighbor')) ?></td>
								<td><?php echo \dash\fit::number(\dash\get::index($result, 'sefareshi', 'country')) ?></td>
							</tr>
							<tr>
								<td><?php echo T_("Pishtaz") ?></td>
								<td><?php echo \dash\fit::number(\dash\get::index($result, 'pishtaz', 'province')) ?></td>
								<td><?php echo \dash\fit::number(\dash\get::index($result, 'pishtaz', 'neighbor')) ?></td>
								<td><?php echo \dash\fit::number(\dash\get::index($result, 'pishtaz', 'country')) ?></td>
							</tr>
						</tbody>
					</table>

				<?php } //endif ?>
			</div>

		</div>
	</div>

</form>