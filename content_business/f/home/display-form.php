<?php

$formItems = \dash\data::formItems();
if(!is_array($formItems))
{
	$formItems = [];
}

?>
<form method="post" autocomplete="off">
	<div class="avand-md">
		<div class="box">
			<header class="c-xs-0"><h2><?php echo \dash\data::formDetail_title(); ?></h2></header>
			<div class="body" data-jform>
				<input type="hidden" name="startdate" value="<?php echo date("Y-m-d H:i:s"); ?>">
				<?php echo \dash\csrf::html(); ?>
				<?php echo \dash\captcha\recaptcha::html(); ?>
				<?php if(\dash\data::formDetail_status() !== 'publish' && \dash\data::accessLoadItem()) {?>
					<div class="alert-warning text-center font-bold"><?php echo T_("Your form is not publish. Only you can view this form.") ?> <a class="btn-link" href="<?php echo \lib\store::admin_url(). '/a/form/edit?id='. \dash\data::formDetail_id() ?>"><?php echo T_("Edit form") ?></a></div>
				<?php } //endif ?>
				<?php if(\dash\data::formDetail_file()) {?>
					<img class="mb-2" src="<?php echo \dash\data::formDetail_file() ?>" alt="<?php echo \dash\data::formDetail_title(); ?>">
				<?php } // endif ?>
				<?php if(\dash\data::formDetail_desc()) {?>
					<div class="mb-4 leading-loose"><?php echo nl2br(\dash\data::formDetail_desc()) ?></div>
				<?php } // endif ?>
				<?php if(\dash\data::accessLoadItem()) {echo \lib\app\form\generator::items($formItems);} ?>
			</div>
			<?php if(\dash\data::accessLoadItem()) {?>
			<footer class="txtRa">
				<button class="btn master"><?php echo T_("Submit") ?></button>
			</footer>
			<?php } //endif ?>
		</div>

			<?php if(\dash\data::formDetail_inquiry()) { ?>
		<div class="box p-4">
				<p><?php echo T_("If you have already completed this form, you can check the status of your answer via the link below") ?></p>
				<a class="btn-link" href="<?php echo \dash\data::formDetail_url(). '/inquiry' ?>"><?php echo T_("Inquiry your answer") ?></a>
		</div>
			<?php } //endif ?>
	</div>
</form>