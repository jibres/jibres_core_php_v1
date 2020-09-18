
<form method="post" autocomplete="off" id="form1">
	<div class="box">
		<div class="pad">
			<label for="title"><?php echo T_("Title") ?></label>
			<div class="input">
				<input type="text" name="title" value="<?php echo \dash\data::dataRow_title(); ?>">
				<a href="<?php echo \dash\url::this(). '/setting?id='. \dash\request::get('id'); ?>" class="addon"><i class="sf-plus"></i> <span><?php echo T_("Advance option") ?></span></a>
			</div>


			<?php if(\dash\data::editMode()) {?>

				<div class="tblBox">
				<table class="tbl1 v5">
			  		<tbody class="sortable" data-sortable>
						<?php if(\dash\data::formItems()) {?>
							<?php foreach (\dash\data::formItems() as $key => $value) { $myKey = \dash\get::index($value, 'id'); ?>

							<tr data-removeElement>
								<td class="collapsing">
									<?php echo \dash\fit::number($key + 1); ?>
									<i data-handle class="sf-sort p0"></i>
  									<input type="hidden" class="hide" name="sort[]" value="<?php echo \dash\get::index($value, 'id'); ?>">
								</td>
								<td>
									<?php echo \dash\get::index($value, 'title'); ?>
								</td>

								<td>

									<?php echo \dash\get::index($value, 'type_detail', 'title'); ?>
								</td>

								<td>
									<?php if(\dash\get::index($value, 'require')) {?><span class="fc-red"><?php echo T_("Required") ?></span><?php }else{?><span class="fc-green"><?php echo T_("Optional") ?></span><?php } ?>
								</td>
								<td class="collapsing"><a href="<?php echo \dash\url::this(). '/item?id='. \dash\request::get('id'). '&item='. \dash\get::index($value, 'id') ?>"><i class="sf-cogs fc-blue fs14"></i></a></td>
							</tr>

							<?php } //endif ?>
						<?php }// endif ?>
					</tbody>
					<tbody>
						<tr>
							<td class="collapsing"><i class="sf-asterisk fc-red"></i></td>
							<td>

								<div class="input">
									<input type="text" name="new_title" placeholder="<?php echo T_("Title") ?>" value="<?php echo \dash\data::dataRowd_title(); ?>">
								</div>
							</td>

							<td>

								<select name="new_type" class="select22">
									<?php foreach (\dash\data::itemType() as $type_key => $type_value) {?>
										<optgroup label="<?php echo \dash\get::index($type_value, 'title'); ?>">
											<?php if(isset($type_value['list']) && is_array($type_value['list'])) { foreach ($type_value['list'] as $k => $v) {?>
												<option value="<?php echo $v['key'] ?>"><?php echo $v['title']; ?></option>
											<?php } /*endfor*/  } //endif?>
										</optgroup>
									<?php } //endif ?>

								</select>
							</td>

							<td>

								<div class="check1">
									<input type="checkbox" name="new_require" id="check1">
									<label for="check1"><?php echo T_("Required"); ?></label>
								</div>
							</td>
							<td class="collapsing"></td>
							<td class="collapsing"></td>
						</tr>

					</tbody>
				</table>
			</div>
		<?php } //endif edit mode ?>

		</div>
		<footer class="txtRa">
			<button class="btn master save"><?php if(\dash\data::editMode()) {echo T_("Save"); }else{ echo T_("Add");} ?></button>
		</footer>
	</div>


</form>