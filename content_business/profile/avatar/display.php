
<div class="avand">
	<div class="row">
		<div class="c-xs-12 c-sm-12 c-lg-4 d-lg-block c-xl-3">
			  <?php require_once(root. 'content_business/profile/display-menu.php'); ?>
		</div>
		<div class="c-xs-12 c-sm-12 c-lg-8 c-xl-9">
			<div class="box">
				<div class="body">
					<form method="post" autocomplete="off" enctype="multipart/form-data">


						<div data-uploader data-name='avatar' data-ratio="1" data-final='#finalImage' data-file-max-size='<?php echo \dash\data::maxFileSize() ?>' data-preview-circle data-autoSend data-uploader-circle>
							<input type="file" accept="image/jpeg, image/png" id="image1">
							<label for="image1"><?php echo T_('Drag &amp; Drop your picture or Browse'); ?></label>

							<?php if(\dash\data::dataRow_avatar()) {?>
								<label for="image1">
									<img id='finalImage' src="<?php echo \dash\data::dataRow_avatar() ?>" alt='<?php echo T_("Your avatar") ?>'>
								</label>
							<?php }?>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>