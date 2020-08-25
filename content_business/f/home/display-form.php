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
				<?php if(\dash\data::formDetail_status() !== 'publish') {?>
					<div class="msg warn txtC txtB"><?php echo T_("Your form is not publish. Only you can view this form.") ?> <a class="btn link" href="<?php echo \lib\store::admin_url(). '/a/form/edit?id='. \dash\data::formDetail_id() ?>"><?php echo T_("Edit form") ?></a></div>
				<?php } //endif ?>
				<?php if(\dash\data::formDetail_file()) {?>
					<img class="mB10" src="<?php echo \dash\data::formDetail_file() ?>" alt="<?php echo \dash\data::formDetail_title(); ?>">
				<?php } // endif ?>
				<?php if(\dash\data::formDetail_desc()) {?>
					<div class="mB20"><?php echo \dash\data::formDetail_desc() ?></div>
				<?php } // endif ?>
				<?php \lib\app\form\generator::items($formItems); ?>
			</div>
			<footer class="txtRa">
				<button class="btn master"><?php echo T_("Submit") ?></button>
			</footer>
		</div>
	</div>
</form>
