<form method="post">
	<div class="avand-md">
		<section class="box">
			<div data-uploader data-name='file' data-ratio=1  data-ratio-free data-final='#finalImage' data-file-max-size='<?php echo \dash\data::maxFileSize() ?>' data-autoSend>
				<input type="file" accept="*/*" id="image1">
				<label for="image1">
					<?php echo T_('Drag &amp; Drop your files or Browse'); ?>
					<small class="block"><?php echo T_("Maximum file size"); ?> <b><?php echo \dash\data::maxFileSizeTitle(); ?></b></small>
				</label>
				<label for="image1"><img id="finalImage"></label>
			</div>
		</section>
	</div>
</form>