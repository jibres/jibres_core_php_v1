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
				<div class="font-18 text-center font-bold">
					<?php \dash\notif::get_in_html() ?>
				</div>
			<?php if(\dash\data::inquiryExecHaveResult()) {?>
				<div class="box">

					<div class="pad">

						<?php if(\dash\data::answerID()) {?>
							<div class="p-2 mb-4 rounded-sm alert-success">
								<?php echo T_("Your tracking numbert is") ?> <code><?php echo \dash\data::answerID() ?></code>
							</div>
						<?php } //endif ?>


					<?php if(\dash\data::tagList()) {?>
						<?php foreach (\dash\data::tagList() as $key => $value) {?>
							<div class="p-2 rounded-sm alert <?php echo a($value, 'class') ?>">
								<?php if(a($value, 'desc')) {?><p><?php echo a($value, 'desc') ?></p><?php } //endif ?>
							</div>
						<?php } //endfor ?>
					<?php } //endif ?>

					<?php if(\dash\data::commentList()) {?>
						<?php foreach (\dash\data::commentList() as $key => $value) {?>
							<div class="p-2 mt-2 rounded-sm <?php if(a($value, 'color')) { echo 'alert-'. $value['color'];}else{echo 'alerty-primary';} ?> f">
								<div class="c"><?php echo a($value, 'content') ?></div>
								<div class="cauto"><?php echo \dash\fit::date_time(a($value, 'datecreated')) ?></div>

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
						<div class="mb-4"><?php echo \dash\data::formDetail_inquirymsg() ?></div>
					<?php } // endif ?>
					<?php \lib\app\form\inquiry::items(\dash\data::formDetail(), $formItems);?>
				</div>
			</div>
			</div>
	</div>

<?php } //endif ?>
