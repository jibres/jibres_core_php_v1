
<form method="post" autocomplete="off" id="form1">
	<div class="box">
		<div class="pad">
			<label for="ititle"><?php echo T_("Title") ?> <small class="fc-red">* <?php echo T_("Required") ?></small></label>
			<div class="input">
				<input type="text" id="ititle" name="title" value="<?php echo \dash\data::dataRow_title(); ?>">
			</div>

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
</form>