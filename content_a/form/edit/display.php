
<form method="post" autocomplete="off">
	<div class="box">
		<div class="pad">
			<label for="title"><?php echo T_("Title") ?></label>
			<div class="input">
				<input type="text" name="title" value="<?php echo \dash\data::dataRow_title(); ?>">
				<div data-kerkere='.showAdvanceOption' class="addon"><i class="sf-plus"></i> <span><?php echo T_("Advance option") ?></span></div>
			</div>

			<div class="showAdvanceOption" data-kerkere-content='hide'>
				<label for="slug"><?php echo T_("Slug") ?></label>
				<div class="input">
					<input type="text" name="slug" value="<?php echo \dash\data::dataRow_slug(); ?>">
				</div>
			</div>





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

									<div class="input">
										<input type="text" name="item_title_<?php echo $myKey ?>" placeholder="<?php echo T_("Title") ?>" value="<?php echo \dash\get::index($value, 'title'); ?>">
									</div>
								</td>

								<td>

									<select name="item_type_<?php echo $myKey ?>" class="select22">
										<option value="text" <?php if(\dash\get::index($value, 'type') === 'text') {echo 'selected';} ?>><?php echo T_("Text") ?></option>
										<option value="textarea" <?php if(\dash\get::index($value, 'type') === 'textarea') {echo 'selected';} ?>><?php echo T_("Textarea") ?></option>
										<option value="checkbox" <?php if(\dash\get::index($value, 'type') === 'checkbox') {echo 'selected';} ?>><?php echo T_("checkbox") ?></option>
										<option value="dropdown" <?php if(\dash\get::index($value, 'type') === 'dropdown') {echo 'selected';} ?>><?php echo T_("dropdown") ?></option>
										<option value="radio" <?php if(\dash\get::index($value, 'type') === 'radio') {echo 'selected';} ?>><?php echo T_("radio") ?></option>
										<option value="mobile" <?php if(\dash\get::index($value, 'type') === 'mobile') {echo 'selected';} ?>><?php echo T_("mobile") ?></option>
										<option value="tel" <?php if(\dash\get::index($value, 'type') === 'tel') {echo 'selected';} ?>><?php echo T_("tel") ?></option>
										<option value="email" <?php if(\dash\get::index($value, 'type') === 'email') {echo 'selected';} ?>><?php echo T_("email") ?></option>
										<option value="url" <?php if(\dash\get::index($value, 'type') === 'url') {echo 'selected';} ?>><?php echo T_("url") ?></option>
										<option value="password" <?php if(\dash\get::index($value, 'type') === 'password') {echo 'selected';} ?>><?php echo T_("password") ?></option>
									</select>
								</td>

								<td>

									<div class="check1">
										<input type="checkbox" name="item_require_<?php echo $myKey ?>" id="check1<?php echo $myKey; ?>" <?php if(\dash\get::index($value, 'require')) { echo 'checked';} ?>>
										<label for="check1<?php echo $myKey; ?>"><?php echo T_("Required"); ?></label>
									</div>
								</td>
								<td class="collapsing"><div data-kerkere='.showOptionItem<?php echo $myKey; ?>'><i class="sf-cogs fc-blue fs14"></i></div></td>
								<td class="collapsing"><div data-confirm data-data='{"removeitem": "removeitem", "id" : "<?php echo $myKey; ?>"}'><i class="sf-trash fc-red fs12"></i></div></td>
							</tr>
							<tr data-kerkere-content='hide' class="showOptionItem<?php echo $myKey; ?>">
								<td colspan="6">
									<?php settingRecord($value); ?>
								</td>
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
									<option value="text"><?php echo T_("Text") ?></option>
									<option value="textarea"><?php echo T_("Textarea") ?></option>
									<option value="checkbox"><?php echo T_("checkbox") ?></option>
									<option value="dropdown"><?php echo T_("dropdown") ?></option>
									<option value="radio"><?php echo T_("radio") ?></option>
									<option value="mobile"><?php echo T_("mobile") ?></option>
									<option value="tel"><?php echo T_("tel") ?></option>
									<option value="email"><?php echo T_("email") ?></option>
									<option value="url"><?php echo T_("url") ?></option>
									<option value="password"><?php echo T_("password") ?></option>
								</select>
							</td>

							<td>

								<div class="check1">
									<input type="checkbox" name="new_require" id="check1" value="<?php echo \dash\data::dataRowd_title(); ?>">
									<label for="check1"><?php echo T_("Required"); ?></label>
								</div>
							</td>
							<td class="collapsing"></td>
							<td class="collapsing"></td>
						</tr>

					</tbody>
				</table>
			</div>

		</div>
		<footer class="txtRa">
			<button class="btn master"><?php if(\dash\data::editMode()) {echo T_("Save"); }else{ echo T_("Add");} ?></button>
		</footer>
	</div>


</form>



<?php

function settingRecord($value)
{
	if(!isset($value['type']))
	{
		return;
	}

	switch ($value['type'])
	{
		case 'text':
			settingText($value);
			break;

		default:
			# code...
			break;
	}

}
?>


<?php function settingText($value) {?>
<label for="maxlen"><?php echo T_("Maximum len") ?></label>
<div class="input">
	<input type="text" name="item_maxlen_<?php echo \dash\get::index($value, 'id') ?>" value="<?php echo \dash\get::index($value, 'maxlen'); ?>">
</div>

<?php } //endif ?>





