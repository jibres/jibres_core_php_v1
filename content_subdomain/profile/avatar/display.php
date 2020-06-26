<div class="avand">
	<div class="row justify-center">
		<div class="c-xs-12 c-md-6">
			<div class="box">
				<div class="body">
					<form method="post" autocomplete="off" enctype="multipart/form-data">


						<div data-uploader data-name='avatar' data-ratio="1" data-final='#finalImage' data-preview-circle data-autoSend data-uploader-circle>
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

