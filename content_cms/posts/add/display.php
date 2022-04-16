<div class="avand-md">
	<form method="post" autocomplete="off" id="formAddPost">
		<div class="box">
			<div class="body">
				<?php if(\dash\url::module() === 'posts') {?>
					<div class="">
						<div class="row">
							<div class="c-xs-6 c-sm-6 c-md-3">
								<div class="radio3 mb-2">
									<input type="radio" name="subtype" value="standard" id="standard" <?php if(\dash\request::get('subtype') === 'standard' || !\dash\request::get('subtype') ) {echo 'checked';} ?>>
									<label for="standard"><?php echo T_("Standard") ?></label>
								</div>
							</div>
							<div class="c-xs-6 c-sm-6 c-md-3">
								<div class="radio3 mb-2">
									<input type="radio" name="subtype" value="gallery" id="gallery" <?php if(\dash\request::get('subtype') === 'gallery') {echo 'checked';} ?>>
									<label for="gallery"><?php echo T_("Gallery") ?></label>
								</div>
							</div>
							<div class="c-xs-6 c-sm-6 c-md-3">
								<div class="radio3 mb-2">
									<input type="radio" name="subtype" value="video" id="video" <?php if(\dash\request::get('subtype') === 'video') {echo 'checked';} ?>>
									<label for="video"><?php echo T_("Video") ?></label>
								</div>
							</div>
							<div class="c-xs-6 c-sm-6 c-md-3">
								<div class="radio3 mb-2">
									<input type="radio" name="subtype" value="audio" id="audio" <?php if(\dash\request::get('subtype') === 'audio') {echo 'checked';} ?>>
									<label for="audio"><?php echo T_("Podcast") ?></label>
								</div>
							</div>
						</div>
					</div>
				<?php } //endif ?>
				<div class="mb-2">
					<div class="input">
						<input type="text" name="title" id="title" placeholder='<?php echo T_("Enter title here"); ?> *'  <?php \dash\layout\autofocus::html() ?> required maxlength='200' minlength="1" pattern=".{1,200}">
					</div>
				</div>
				<textarea class="txt mb-2" data-editor id='descInput' name="html" placeholder='<?php echo T_("Write your post ..."); ?>' maxlength='100000' rows="10"></textarea>
				<p class="text-gray-400 mB0-f s0"><?php echo T_("First type main text and save as draft, then complete and publish it."); ?></p>
			</div>
<?php if(!\dash\detect\device::detectPWA()) {?>
			<footer class="txtRa">
				<button class="btn master"><?php echo T_("Save as draft"); ?></button>
			</footer>
<?php } ?>
		</div>
	</form>
</div>
