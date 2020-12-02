<?php require_once(root. 'content_crm/member/userDetail.php'); ?>
<div class="avand-sm">
	<div class="box">
		<div class="body">

			<form method="post" autocomplete="off">
				<input type="hidden" name="editdisplayname" value="editdisplayname">
				<div class="input mB10">
					<input type="text" name="displayname" value="<?php echo \dash\data::dataRowMember_displayname() ?>" maxlength="50">
					<button class="btn master addon"><?php echo T_("Save") ?></button>
				</div>
				<p class="fc-mute mB0-f"><?php echo T_("You can change customer name as many times as you want.") ?></p>
			</form>

		</div>
	</div>
	<div class="box">
		<div class="body">
			<form method="post" autocomplete="off" enctype="multipart/form-data">
				<div data-uploader data-name='avatar' data-ratio="1" data-final='#finalImage' data-preview-circle data-autoSend data-uploader-circle>
					<input type="file" accept="image/jpeg, image/png" id="image1">
					<label for="image1"><?php echo T_('Drag &amp; Drop your picture or Browse'); ?></label>
					<?php if(\dash\data::dataRowMember_avatar()) {?>
						<label for="image1">
							<img id='finalImage' src="<?php echo \dash\data::dataRowMember_avatar() ?>" alt='<?php echo T_("Your avatar") ?>'>
						</label>
					<?php }?>
				</div>
			<p class="fc-mute mB0-f"><?php echo T_("Drag & Drop your avatar or click on click on photo to browse") ?></p>
			</form>
			<?php if(\dash\data::dataRowMember_avatar_raw()) {?>
				<div class="txtL font-18">
					<div class="linkDel" data-confirm data-data='{"btn": "remove"}'><i class="sf-trash"></i></div>
				</div>
			<?php } //endif ?>
		</div>
	</div>
</div>