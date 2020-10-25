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

				<?php if(\dash\data::formDetail_status() !== 'publish' && \dash\data::accessLoadItem()) {?>
					<div class="msg warn txtC txtB"><?php echo T_("Your form is not publish. Only you can view this form.") ?> <a class="btn link" href="<?php echo \lib\store::admin_url(). '/a/form/edit?id='. \dash\data::formDetail_id() ?>"><?php echo T_("Edit form") ?></a></div>
				<?php } //endif ?>
				<?php if(\dash\data::formDetail_file()) {?>
					<img class="mB10" src="<?php echo \dash\data::formDetail_file() ?>" alt="<?php echo \dash\data::formDetail_title(); ?>">
				<?php } // endif ?>
				<?php if(\dash\data::formDetail_desc()) {?>
					<div class="mB20"><?php echo \dash\data::formDetail_desc() ?></div>
				<?php } // endif ?>
				<?php if(\dash\data::accessLoadItem()) {\lib\app\form\generator::items($formItems);} ?>
			</div>
			<?php if(\dash\data::accessLoadItem()) {?>
			<footer class="txtRa">
				<button class="btn master"><?php echo T_("Submit") ?></button>
			</footer>
		<?php } //endif ?>
		</div>
	</div>
</form>

<?php if(\dash\data::formDetail_inquiry()) {?>

	<div class="avand-md">
		<div class="box">
			<div class="pad">

				<header class="c-xs-0"><h2><?php echo T_("Inquiry"); ?></h2></header>
				<div class="body" data-jform>
					<?php if(\dash\data::formDetail_inquirymsg()) {?>
						<div class="mB20"><?php echo \dash\data::formDetail_inquirymsg() ?></div>
					<?php } // endif ?>
					<?php \lib\app\form\inquiry::items(\dash\data::formDetail(), $formItems);?>
				</div>
				<?php if(\dash\data::tagList()) {?>
					<?php foreach (\dash\data::tagList() as $key => $value) {?>
						<div class="msg">
							<?php echo \dash\get::index($value, 'title') ?>
							<p><?php echo \dash\get::index($value, 'desc') ?></p>
						</div>
					<?php } //endfor ?>
				<?php } //endif ?>

				<?php if(\dash\data::commentList()) {?>
					<?php foreach (\dash\data::commentList() as $key => $value) {?>
						<div class="msg">
							<?php echo \dash\get::index($value, 'content') ?>
						</div>
					<?php } //endfor ?>
				<?php } //endif ?>
			</div>
			</div>
	</div>

<?php } //endif ?>
