<?php

?>
<form method="post" autocomplete="off">
	<div class="avand-md mb-4">
		<?php echo \lib\app\form\generator::master_form_page_html(); ?>
		<?php if (\dash\data::formDetail_inquiry()) { ?>
            <div class="box p-4">
                <p><?php echo T_("If you have already completed this form, you can check the status of your answer via the link below") ?></p>
                <div class="txtRa">

                    <a class="btn-secondary mt-2"
                       href="<?php echo \dash\data::formDetail_url() . '/inquiry' ?>"><?php echo T_("Search my answer") ?></a>
                </div>
            </div>
		<?php } //endif ?>

	</div>
</form>