
<form method="post" autocomplete="off" id="form1">
	<div class="box">
		<div class="pad">
			<label for="title"><?php echo T_("Title") ?></label>
			<div class="input">
				<input type="text" name="title" value="<?php echo \dash\data::dataRow_title(); ?>">
				<div data-kerkere='.showAdvanceOption' class="addon"><i class="sf-plus"></i> <span><?php echo T_("Advance option") ?></span></div>
			</div>

			<div class="showAdvanceOption" data-kerkere-content='hide'>
				<div class="example">
					<div class="row">
						<div class="c-xs-12 c-sm-6">
							<label for="redirect"><?php echo T_("Redirect after submit") ?></label>
							<div class="input">
								<input type="url" name="redirect" value="<?php echo \dash\data::dataRow_redirect(); ?>">
							</div>
						</div>
						<div class="c-xs-12 c-sm-6">
							<label for="status"><?php echo T_("Status") ?></label>
							<select class="select22" name="status">
								<option value=""><?php echo T_("Please select on item") ?></option>
								<option value="draft" <?php if(\dash\data::dataRow_status() === 'draft') { echo 'selected';} ?>><?php echo T_("draft") ?></option>
								<option value="publish" <?php if(\dash\data::dataRow_status() === 'publish') { echo 'selected';} ?>><?php echo T_("publish") ?></option>
								<option value="expire" <?php if(\dash\data::dataRow_status() === 'expire') { echo 'selected';} ?>><?php echo T_("expire") ?></option>
								<option value="lock" <?php if(\dash\data::dataRow_status() === 'lock') { echo 'selected';} ?>><?php echo T_("lock") ?></option>
							</select>
						</div>
						<div class="c-xs-12 c-sm-12">
							<label for="desc"><?php echo T_("Description") ?></label>
							<textarea name="desc" data-editor class="txt" rows="3" id="desc" placeholder="<?php echo T_("Description") ?>"><?php echo \dash\data::dataRow_desc(); ?></textarea>
						</div>

						<div class="c-xs-12 c-sm-12">
							<label for="endmessage"><?php echo T_("End message") ?></label>
							<textarea name="endmessage" data-editor='simple' class="txt" rows="3" id="endmessage" placeholder="<?php echo T_("End message") ?>"><?php echo \dash\data::dataRow_endmessage(); ?></textarea>
						</div>


						<div class="c-xs-12 c-sm-12">
							<div data-uploader data-name='file' data-final='#finalImagefile1'>
								<input type="file" accept="image/*" id="file1">
								<label for="file1"><?php echo T_('Drag &amp; Drop your files or Browse'); ?></label>
								<label for="file1"><img id="finalImagefile1" src="<?php echo \dash\data::dataRow_file(); ?>" alt="<?php echo T_("File") ?>"></label>
							</div>
						</div>

					</div>
				</div>
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

									<div class="input">
										<input type="text" name="item_title_<?php echo $myKey ?>" placeholder="<?php echo T_("Title") ?>" value="<?php echo \dash\get::index($value, 'title'); ?>">
									</div>
								</td>

								<td>
									<select name="item_type_<?php echo $myKey ?>" class="select22"><?php foreach (\dash\data::itemType() as $type_key => $type_value) {?><optgroup label="<?php echo \dash\get::index($type_value, 'title'); ?>"><?php if(isset($type_value['list']) && is_array($type_value['list'])) { foreach ($type_value['list'] as $k => $v) {?><option value="<?php echo $v['key'] ?>" <?php if(\dash\get::index($value, 'type') === $v['key']) {echo 'selected';} ?>><?php echo $v['title']; ?></option><?php } /*endfor*/  } //endif?></optgroup><?php } //endif ?>
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



<?php



function settingRecord($value)
{
	if(!isset($value['type_detail']))
	{
		return;
	}

	echo "<div class='row'>";

	if(isset($value['type_detail']['choice']) && $value['type_detail']['choice'])
	{
		echo "<div class='c-xs-12 c-sm-12 c-md-12'>";
		settingChoice($value);
		echo "</div>";
	}

	echo "<div class='c-xs-12 c-sm-12 c-md-12'>";
	settingDesc($value);
	echo "</div>";

	if(isset($value['type_detail']['placeholder']) && $value['type_detail']['placeholder'])
	{
		echo "<div class='c-xs-12 c-sm-12 c-md-6'>";
		settingPlaceHolder($value);
		echo "</div>";
	}


	if(isset($value['type_detail']['maxlen']) && $value['type_detail']['maxlen'])
	{
		echo "<div class='c-xs-12 c-sm-12 c-md-6'>";
		settingMaxLen($value);
		echo "</div>";
	}

	if(isset($value['type_detail']['min']) && $value['type_detail']['min'])
	{
		echo "<div class='c-xs-12 c-sm-12 c-md-2'>";
		settingMin($value);
		echo "</div>";
	}

	if(isset($value['type_detail']['max']) && $value['type_detail']['max'])
	{
		echo "<div class='c-xs-12 c-sm-12 c-md-2'>";
		settingMax($value);
		echo "</div>";
	}



	if(isset($value['type_detail']['choiceinline']) && $value['type_detail']['choiceinline'])
	{
		echo "<div class='c-xs-12 c-sm-12 c-md-6'>";
		settingChoiceInline($value);
		echo "</div>";
	}


	if(isset($value['type_detail']['random']) && $value['type_detail']['random'])
	{
		echo "<div class='c-xs-12 c-sm-12 c-md-6'>";
		settingRandom($value);
		echo "</div>";
	}


	if(isset($value['type_detail']['check_unique']) && $value['type_detail']['check_unique'])
	{
		echo "<div class='c-xs-12 c-sm-12 c-md-6'>";
		settingCheckUnique($value);
		echo "</div>";
	}

	if(isset($value['type_detail']['filetype']) && $value['type_detail']['filetype'])
	{
		echo "<div class='c-xs-12 c-sm-12 c-md-6'>";
		settingFileType($value);
		echo "</div>";
	}

	if(isset($value['type_detail']['color']) && $value['type_detail']['color'])
	{
		echo "<div class='c-xs-12 c-sm-12 c-md-6'>";
		settingColor($value);
		echo "</div>";
	}

	if(isset($value['type_detail']['send_sms']) && $value['type_detail']['send_sms'])
	{
		echo "<div class='c-xs-12 c-sm-12 c-md-6'>";
		settingSendSms($value);
		echo "</div>";
	}


	if(isset($value['type_detail']['signup']) && $value['type_detail']['signup'])
	{
		echo "<div class='c-xs-12 c-sm-12 c-md-6'>";
		settingSignup($value);
		echo "</div>";
	}

	if(isset($value['type_detail']['defaultvalue']) && $value['type_detail']['defaultvalue'])
	{
		echo "<div class='c-xs-12 c-sm-12 c-md-6'>";
		settingDefaultvalue($value);
		echo "</div>";
	}

	if(isset($value['type_detail']['link']) && $value['type_detail']['link'])
	{
		echo "<div class='c-xs-12 c-sm-12 c-md-6'>";
		settingLink($value);
		echo "</div>";
	}






	echo "</div>";

}
?>

<?php function settingDesc($value) {?>
<label for="item_desc_<?php echo \dash\get::index($value, 'id') ?>"><?php echo T_("Description") ?></label>
<textarea class="txt" rows="2" name="item_desc_<?php echo \dash\get::index($value, 'id') ?>" id="item_desc_<?php echo \dash\get::index($value, 'id') ?>"><?php echo \dash\get::index($value, 'desc'); ?></textarea>

<?php } //endif ?>

<?php function settingMaxLen($value) {?>
<label for="item_maxlen_<?php echo \dash\get::index($value, 'id') ?>"><?php echo T_("Maximum len") ?></label>
<div class="input">
	<input type="text" name="item_maxlen_<?php echo \dash\get::index($value, 'id') ?>" id="item_maxlen_<?php echo \dash\get::index($value, 'id') ?>" value="<?php echo \dash\get::index($value, 'maxlen'); ?>">
</div>
<?php } //endif ?>




<?php function settingMin($value) {?>
<label for="item_min_<?php echo \dash\get::index($value, 'id') ?>"><?php echo T_("Minimum") ?></label>
<div class="input">
	<input type="text" name="item_min_<?php echo \dash\get::index($value, 'id') ?>" id="item_min_<?php echo \dash\get::index($value, 'id') ?>" value="<?php echo \dash\get::index($value, 'setting', \dash\get::index($value,'type') , 'min'); ?>">
</div>
<?php } //endif ?>


<?php function settingMax($value) {?>
<label for="item_max_<?php echo \dash\get::index($value, 'id') ?>"><?php echo T_("Maximum") ?></label>
<div class="input">
	<input type="text" name="item_max_<?php echo \dash\get::index($value, 'id') ?>" id="item_max_<?php echo \dash\get::index($value, 'id') ?>" value="<?php echo \dash\get::index($value, 'setting', \dash\get::index($value,'type') , 'max'); ?>">
</div>
<?php } //endif ?>





<?php function settingPlaceHolder($value) {?>
<label for="item_placeholder_<?php echo \dash\get::index($value, 'id') ?>"><?php echo T_("Placeholder") ?></label>
<div class="input">
	<input type="text" name="item_placeholder_<?php echo \dash\get::index($value, 'id') ?>" id="item_placeholder_<?php echo \dash\get::index($value, 'id') ?>" value="<?php echo \dash\get::index($value, 'setting', \dash\get::index($value,'type') , 'placeholder'); ?>">
</div>
<?php } //endif ?>





<?php function settingChoice($value) {?>
<label for="item_choice_<?php echo \dash\get::index($value, 'id') ?>"><?php echo T_("Choices") ?> <small><?php echo T_("Type choice and press Enter") ?></small></label>
<select name="item_choice_<?php echo \dash\get::index($value, 'id') ?>[]" id="item_choice_<?php echo \dash\get::index($value, 'id') ?>" class="select22" data-model="tag" multiple="multiple">
	<?php if(isset($value['choice']) && is_array($value['choice'])) {?>
  <?php foreach ($value['choice'] as $key => $value) {?>
    <option value="<?php echo $value['title']; ?>" selected><?php echo $value['title']; ?></option>
  <?php } //endfor ?>
  <?php } //endif ?>
</select>
<?php } // endfunction ?>



<?php function settingChoiceInline($value) {?>
<div class="check1 mT25">
	<input type="checkbox" name="item_choiceinline_<?php echo \dash\get::index($value, 'id') ?>" id="checkinline<?php echo \dash\get::index($value, 'id'); ?>" <?php if(\dash\get::index($value, 'setting', \dash\get::index($value,'type') , 'choiceinline')) { echo 'checked';} ?>>
	<label for="checkinline<?php echo \dash\get::index($value, 'id'); ?>"><?php echo T_("Put every choice in one line"); ?></label>
</div>
<?php } // endfunction ?>



<?php function settingRandom($value) {?>
<div class="check1 mT25">
	<input type="checkbox" name="item_random_<?php echo \dash\get::index($value, 'id') ?>" id="checkrandom<?php echo \dash\get::index($value, 'id'); ?>" <?php if(\dash\get::index($value, 'setting', \dash\get::index($value,'type') , 'random')) { echo 'checked';} ?>>
	<label for="checkrandom<?php echo \dash\get::index($value, 'id'); ?>"><?php echo T_("Random choice"); ?></label>
</div>
<?php } // endfunction ?>



<?php function settingCheckUnique($value) {?>
<div class="check1 mT25">
	<input type="checkbox" name="item_check_unique_<?php echo \dash\get::index($value, 'id') ?>" id="checkunique<?php echo \dash\get::index($value, 'id'); ?>" <?php if(\dash\get::index($value, 'setting', \dash\get::index($value,'type') , 'check_unique')) { echo 'checked';} ?>>
	<label for="checkunique<?php echo \dash\get::index($value, 'id'); ?>"><?php echo T_("Check unique"); ?></label>
</div>
<?php } // endfunction ?>



<?php function settingFileType($value) {
$saved_filetype = \dash\get::index($value, 'setting', \dash\get::index($value,'type') , 'filetype');
if(!is_array($saved_filetype))
{
	$saved_filetype = [];
}
?>
<label for="item_filetype_<?php echo \dash\get::index($value, 'id') ?>"><?php echo T_("Allow extention file"); ?></label>
<div>
<select class="select22" name="item_filetype_<?php echo \dash\get::index($value, 'id') ?>[]" multiple="multiple">
  <option value=""><?php echo T_("Any file"); ?></option>
  <?php foreach (\dash\data::allAllowFileExt() as $key => $value) {?>
  	<option value="<?php echo $key ?>" <?php if(in_array($key, $saved_filetype)) { echo 'selected';} ?>><?php echo $key; ?></option>
  <?php } //endfor ?>
</select>
</div>
<?php } // endfunction ?>



<?php function settingSendSms($value) {?>
<div class="check1 mT25">
	<input type="checkbox" name="item_send_sms_<?php echo \dash\get::index($value, 'id') ?>" id="send_sms<?php echo \dash\get::index($value, 'id'); ?>" <?php if(\dash\get::index($value, 'setting', \dash\get::index($value,'type') , 'send_sms')) { echo 'checked';} ?>>
	<label for="send_sms<?php echo \dash\get::index($value, 'id'); ?>"><?php echo T_("Send sms after complete form?"); ?></label>
</div>
<div data-response="item_send_sms_<?php echo \dash\get::index($value, 'id') ?>" <?php if(\dash\get::index($value, 'setting', \dash\get::index($value,'type') , 'send_sms')) {}else{ echo 'data-response-hide';} ?>>
<label for="item_sms_text_<?php echo \dash\get::index($value, 'id') ?>"><?php echo T_("Sms text") ?></label>
<textarea class="txt" rows="2" name="item_sms_text_<?php echo \dash\get::index($value, 'id') ?>" id="item_sms_text_<?php echo \dash\get::index($value, 'id') ?>"><?php echo \dash\get::index($value, 'setting', \dash\get::index($value,'type') , 'sms_text'); ?></textarea>
</div>
<?php } // endfunction ?>


<?php function settingSignup($value) {?>
<div class="check1 mT25">
	<input type="checkbox" name="item_signup_<?php echo \dash\get::index($value, 'id') ?>" id="signup<?php echo \dash\get::index($value, 'id'); ?>" <?php if(\dash\get::index($value, 'setting', \dash\get::index($value,'type') , 'signup')) { echo 'checked';} ?>>
	<label for="signup<?php echo \dash\get::index($value, 'id'); ?>"><?php echo T_("Signup user by this item?"); ?></label>
</div>
<?php } // endfunction ?>



<?php function settingDefaultvalue($value) {?>

<label for="item_defaultvalue_<?php echo \dash\get::index($value, 'id') ?>"><?php echo T_("Default value") ?></label>
<div class="input">
	<input type="text" name="item_defaultvalue_<?php echo \dash\get::index($value, 'id') ?>" id="item_defaultvalue_<?php echo \dash\get::index($value, 'id') ?>" value="<?php echo \dash\get::index($value, 'setting', \dash\get::index($value,'type') , 'defaultvalue'); ?>">
</div>
<?php } // endfunction ?>




<?php function settingColor($value) {?>
<label for="item_color_<?php echo \dash\get::index($value, 'id') ?>"><?php echo T_("Message Type"); ?></label>
<div>
<select class="select22" name="item_color_<?php echo \dash\get::index($value, 'id') ?>">
  <option value=""><?php echo T_("Default"); ?></option>
  <option value="red" <?php if(\dash\get::index($value, 'setting', \dash\get::index($value,'type') , 'color') === 'red') { echo 'selected';} ?>><?php echo T_("Red (For important warning message)") ?></option>
  <option value="green" <?php if(\dash\get::index($value, 'setting', \dash\get::index($value,'type') , 'color') === 'green') { echo 'selected';} ?>><?php echo T_("Green (For thank you message)") ?></option>
  <option value="blue" <?php if(\dash\get::index($value, 'setting', \dash\get::index($value,'type') , 'color') === 'blue') { echo 'selected';} ?>><?php echo T_("Blue (For information message)") ?></option>
  <option value="yellow" <?php if(\dash\get::index($value, 'setting', \dash\get::index($value,'type') , 'color') === 'yellow') { echo 'selected';} ?>><?php echo T_("Yellow (For warning message)") ?></option>
</select>
</div>

<?php } // endfunction ?>



<?php function settingLink($value) {?>
<label for="item_link_<?php echo \dash\get::index($value, 'id') ?>"><?php echo T_("Link"); ?></label>
<div class="input">
	<input type="text" name="item_link_<?php echo \dash\get::index($value, 'id') ?>" id="item_link_<?php echo \dash\get::index($value, 'id') ?>" value="<?php echo \dash\get::index($value, 'setting', \dash\get::index($value,'type') , 'link'); ?>">
</div>
<div class="check1 mT25">
	<input type="checkbox" name="item_targetblank_<?php echo \dash\get::index($value, 'id') ?>" id="targetblank<?php echo \dash\get::index($value, 'id'); ?>" <?php if(\dash\get::index($value, 'setting', \dash\get::index($value,'type') , 'targetblank')) { echo 'checked';} ?>>
	<label for="targetblank<?php echo \dash\get::index($value, 'id'); ?>"><?php echo T_("Open in blank page?"); ?></label>
</div>
<?php } // endfunction ?>

