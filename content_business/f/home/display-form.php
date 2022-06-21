<?php

?>
<form method="post" autocomplete="off">
	<div class="avand-md">
		<?php echo \lib\app\form\generator::master_form_page_html(); ?>
		<?php if(\dash\data::formDetail_inquiry()) { ?>
		<div class="box p-4">
				<p><?php echo T_("If you have already completed this form, you can check the status of your answer via the link below") ?></p>
				<a class="btn-link" href="<?php echo \dash\data::formDetail_url(). '/inquiry' ?>"><?php echo T_("Inquiry your answer") ?></a>
		</div>
			<?php } //endif ?>
	</div>
</form>