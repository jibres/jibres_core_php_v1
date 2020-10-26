<?php $inquerySetting = \dash\data::dataRow_inquirysetting() ?>
<div class="row">
	<div class="c-xs-0 c-sm-0 c-lg-4 d-lg-block">
		<?php require_once(root. 'content_a/form/itemLink.php');?>
	</div>
	<div class="c-xs-12 c-sm-12 c-lg-8">
		<form method="post" autocomplete="off" id="form1">
			<div class="box">
				<div class="pad">
					<p><?php echo T_("The query feature allows you to inform the recipient of your result or response by referring to the form and entering your information.") ?></p>
					<div class="switch1 mB20">
						<input type="checkbox" name="inquiry" id="inquiry" <?php if(\dash\data::dataRow_inquiry()){ echo 'checked'; } ?>>
						<label for="inquiry"></label>
						<label for="inquiry"><?php echo T_("Enable inquiry") ?></label>
					</div>

					<div data-response="inquiry" <?php if(\dash\data::dataRow_inquiry()){/*nothing*/}else{ echo 'data-response-hide'; } ?> data-response-effect='slide'>

						<?php if(!\dash\data::formItems()) {?>
							<div class="msg warn2"><?php echo T_("You have not any inquiry question in your form. Questions that are mobile or national code can be used in the inquiry process") ?></div>
						<?php }else{ ?>
							<p class="mB0-f"><?php echo T_("Which question to ask?") ?></p>
							<?php foreach (\dash\data::formItems() as $key => $value) { $myId =  \dash\get::index($value, 'id'); ?>

								<div class="switch1">
									<input type="checkbox" name="question[]" value="<?php echo \dash\get::index($value, 'id') ?>" id="<?php echo $myId ?>" <?php if(is_array(\dash\get::index($inquerySetting, 'question')) && in_array($myId, $inquerySetting['question'])) {echo 'checked';} ?>>
									<label for="<?php echo $myId ?>"></label>
									<label for="<?php echo $myId ?>"><?php echo \dash\get::index($value, 'title') ?></label>
								</div>

							<?php } //endif ?>
						<?php } //endif ?>

						<div class="mB10">
							<label for="inquirymsg"><?php echo T_("Inquiry Message") ?></label>
							<textarea name="inquirymsg" data-editor class="txt" rows="3" id="inquirymsg" placeholder="<?php echo T_("Inquiry Message") ?>"><?php echo \dash\data::dataRow_inquirymsg(); ?></textarea>
						</div>


					<div class="mB10">
						<div data-uploader data-name='file' data-final='#finalImagefile1'>
							<input type="file" accept="image/*" id="file1">
							<label for="file1"><?php echo T_('Drag &amp; Drop your files or Browse'); ?></label>
							<label for="file1"><img id="finalImagefile1" <?php if(\dash\data::dataRow_inquiryimage()) {?>src="<?php echo \dash\data::dataRow_inquiryimage(); ?>" <?php } //endif ?> alt="<?php echo T_("File") ?>"></label>
						</div>
					</div>
					</div>

				</div>
			</div>
		</form>
	</div>
</div>
