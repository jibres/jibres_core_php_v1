<form method="post" autocomplete="off" >
	<?php echo \dash\csrf::html(false); ?>
	<div class="box">
		<div class="pad">
			<?php if(\dash\request::get('title')) {?>
				<input type="hidden" name="title" value="<?php echo \dash\request::get('title') ?>">
			<?php }else{ ?>
				<label for="title"><?php echo T_("Subject") ?></label>
				<div class="input">
					<input  type="text" name="title"  maxlength="100" id="title" <?php \dash\layout\autofocus::html() ?>>
				</div>
			<?php } // endif ?>

			<textarea class="txt" name="content" rows="4"  placeholder='<?php echo T_("Enter your message ...") ?>'></textarea>

			<?php if(\dash\user::id()) {?>
			<div class="mt-2" data-uploader data-name='file' data-file-max-size='<?php echo \dash\data::maxFileSize() ?>'>
				<input type="file"  id="file1">
				<label for="file1"><?php echo T_('Drag &amp; Drop your files or Browse'); ?></label>
			</div>
			<?php } //endif ?>

		</div>
		<footer class="txtRa">
			<button class="btn master"><?php echo T_("Add Ticket") ?></button>
		</footer>
	</div>
</form>