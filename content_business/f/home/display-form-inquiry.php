<?php

$formItems = \dash\data::formItems();
if(!is_array($formItems))
{
	$formItems = [];
}

?>


<?php if(\dash\data::formDetail_inquiry()) {?>

	<div class="avand-md">
			<?php if(\dash\data::inquiryExec()) {?>
				<div class="font-18 txtC txtB">
					<?php \dash\notif::get_in_html() ?>
				</div>
			<?php if(\dash\data::inquiryExecHaveResult()) {?>
				<div class="box">

					<div class="pad">

						<?php if(\dash\data::answerID()) {?>
							<div class="msg minimal">
								<?php echo T_("Your tracking numbert is") ?> <code><?php echo \dash\data::answerID() ?></code>
							</div>
						<?php } //endif ?>


					<?php if(\dash\data::tagList()) {?>
						<?php foreach (\dash\data::tagList() as $key => $value) {?>
							<div class="msg minimal <?php echo \dash\get::index($value, 'class') ?>">
								<?php if(\dash\get::index($value, 'desc')) {?><p><?php echo \dash\get::index($value, 'desc') ?></p><?php } //endif ?>
							</div>
						<?php } //endfor ?>
					<?php } //endif ?>

					<?php if(\dash\data::commentList()) {?>
						<?php foreach (\dash\data::commentList() as $key => $value) {?>
							<div class="msg f">
								<div class="c"><?php echo \dash\get::index($value, 'content') ?></div>
								<div class="cauto"><?php echo \dash\fit::date_time(\dash\get::index($value, 'datecreated')) ?></div>

							</div>
						<?php } //endfor ?>
					<?php } //endif ?>

					</div>
				</div>
			<?php } //endif ?>

			<?php } //endif ?>
		<div class="box">
			<div class="pad">

				<div class="body" data-jform>
					<?php if(\dash\data::formDetail_inquirymsg()) {?>
						<div class="mB20"><?php echo \dash\data::formDetail_inquirymsg() ?></div>
					<?php } // endif ?>
					<?php \lib\app\form\inquiry::items(\dash\data::formDetail(), $formItems);?>
				</div>
			</div>
			</div>
	</div>

<?php } //endif ?>
