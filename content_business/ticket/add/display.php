<div class="avand">
	<div class="row">
		<div class="c-xs-0 c-sm-0 c-lg-4 d-lg-block c-xl-3">
			<?php require_once(root. 'content_business/profile/display-menu.php'); ?>
		</div>
		<div class="c-xs-12 c-sm-12 c-lg-8 c-xl-9">

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

		</div>
	</div>
</div>
