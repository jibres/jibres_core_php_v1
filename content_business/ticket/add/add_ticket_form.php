<form method="post" autocomplete="off" >
	<?php \dash\csrf::html(false); ?>
	<div class="box">
		<div class="pad">
			<label for="title"><?php echo T_("Subject") ?></label>
			<div class="input">
				<input  type="text" name="title" placeholder2="<?php echo T_("Subject") ?>" maxlength="100" <?php \dash\layout\autofocus::html() ?>>
			</div>

			<textarea class="txt" name="content" rows="4"  placeholder='<?php echo T_("Enter your message ...") ?>'></textarea>

			<div class="mT10" data-uploader data-name='file'>
				<input type="file"  id="file1">
				<label for="file1"><?php echo T_('Drag &amp; Drop your files or Browse'); ?></label>
			</div>

		</div>
		<footer class="txtRa">
			<button class="btn master"><?php echo T_("Add Ticket") ?></button>
		</footer>
	</div>
</form>