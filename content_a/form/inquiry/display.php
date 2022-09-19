<?php $inquerySetting = \dash\data::dataRow_inquirysetting() ?>
<div class="row">
	<div class="c-xs-0 c-sm-0 c-lg-4 d-lg-block">
		<?php require_once(root. 'content_a/form/itemLink.php');?>
	</div>
	<div class="c-xs-12 c-sm-12 c-lg-8">
		<?php require_once(root . 'content_a/form/formTitle.php'); ?>
		<form method="post" autocomplete="off" id="form1">
			<div class="box">
				<div class="pad">
					<p><?php echo T_("The query feature allows you to inform the recipient of your result or response by referring to the form and entering your information.") ?></p>
					<div class="switch1 mb-4 mt-4">
						<input type="checkbox" name="inquiry" id="inquiry" <?php if(\dash\data::dataRow_inquiry()){ echo 'checked'; } ?>>
						<label for="inquiry"></label>
						<label for="inquiry"><?php echo T_("Enable inquiry") ?></label>
					</div>
					<?php if(\dash\data::dataRow_inquiry()){ ?>
							<span><?php echo T_("inquiry page address") ?></span>
						<div class="alert-secondary ltr text-left f">
							<div class="text-left ltr"><a target="_blank" href="<?php echo \dash\data::dataRow_url(). '/inquiry'; ?>"><?php echo \dash\data::dataRow_url(). '/inquiry'; ?></a></div>
							<div class="text-right" data-copy="<?php echo \dash\data::dataRow_url(). '/inquiry'; ?>"><?php echo \dash\utility\icon::svg('link') ?></div>
						</div>
					<?php } // endif ?>

					<div data-response="inquiry" <?php if(\dash\data::dataRow_inquiry()){/*nothing*/}else{ echo 'data-response-hide'; } ?>>

						<?php if(!\dash\data::formItems()) {?>
							<div class="alert-warning"><?php echo T_("You have not any inquiry question in your form. Questions that are mobile or national code can be used in the inquiry process") ?></div>
						<?php }else{ ?>
							<p class="mB0-f"><?php echo T_("Which question to ask?") ?></p>
							<?php foreach (\dash\data::formItems() as $key => $value) { $myId =  a($value, 'id'); ?>

								<div class="switch1">
									<input type="checkbox" name="question[]" value="<?php echo a($value, 'id') ?>" id="<?php echo $myId ?>" <?php if(is_array(a($inquerySetting, 'question')) && in_array($myId, $inquerySetting['question'])) {echo 'checked';} ?>>
									<label for="<?php echo $myId ?>"></label>
									<label for="<?php echo $myId ?>"><?php echo a($value, 'title') ?></label>
								</div>

							<?php } //endif ?>
						<?php } //endif ?>




						<label for="messagef"><?php echo T_("Message if result founded") ?></label>
						<div class="input">
							<input type="text" id="messagef" name="inquiry_msg_founded" value="<?php echo a($inquerySetting, 'inquiry_msg_founded'); ?>">
						</div>

						<label for="messagenf"><?php echo T_("Message if result not founded") ?></label>
						<div class="input">
							<input type="text" id="messagenf" name="inquiry_msg_not_founded" value="<?php echo a($inquerySetting, 'inquiry_msg_not_founded'); ?>">
						</div>

						<div class="mb-2">
							<label for="inquirymsg"><?php echo T_("Inquiry Message") ?></label>
							<textarea name="inquirymsg" class="txt" rows="3" id="inquirymsg" placeholder="<?php echo T_("Inquiry Message") ?>"><?php echo \dash\data::dataRow_inquirymsg(); ?></textarea>
						</div>



					<div class="mb-2">
						<span><?php echo T_("Inquiry page image") ?></span>
						<div data-uploader data-name='file' data-final='#finalImagefile1'>
							<input type="file" accept="image/*" id="file1" data-file-max-size='<?php echo \dash\data::maxFileSize() ?>'>
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
