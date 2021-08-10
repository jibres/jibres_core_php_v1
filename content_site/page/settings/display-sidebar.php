<?php
$currentPageDetail = \dash\data::currentPageDetail();



?>
<form method="post" autocomplete="off" data-patch>
	<input type="hidden" name="set_title" value="1">
	<label for="pagetitle"><?php echo T_("Page title") ?></label>
	<div class="input">
		<input type="text" name="title" value="<?php echo a($currentPageDetail, 'title'); ?>" id="<?php echo T_("Page title") ?>">
	</div>
</form>
