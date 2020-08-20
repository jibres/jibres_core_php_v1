
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
									<input type="checkbox" name="new_required" id="check1" value="<?php echo \dash\data::dataRowd_title(); ?>">
									<label for="check1"><?php echo T_("Required"); ?></label>
								</div>
							</td>
							<td class="collapsing"><div data-kerkere='.showOptionItem'><i class="sf-cogs fc-blue fs14"></i></div></td>
							<td class="collapsing"><div><i class="sf-trash fc-red fs12"></i></div></td>
						</tr>
						<tr data-kerkere-content='hide' class="showOptionItem">
							<td colspan="6">
								<?php echo 'salam'; ?>
							</td>
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
